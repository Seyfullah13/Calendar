import { defineStore } from 'pinia';
import Echo from 'laravel-echo';

const initial_document_title = document.title;
const useFetch = async function (url, options = {}) { 
  let response = await fetch(url, {
    credentials: 'same-origin',
    headers: {
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': window.csrf,
      'Content-Type': 'application/json'
    },
    ...options
  });

  if (response.ok) {
    const contentType = response.headers.get('content-type');
    
    if (contentType && contentType.includes('application/json')) {
      return response.json();
    } else {
      return response.text();
    }
  } else {
    let error = await response.json();

    return error;
  }
};
const updateDocumentTitle = function(unread_conversations_number) {
  if (unread_conversations_number === 0) {
    document.title = initial_document_title;
  } else {
    document.title = `(${unread_conversations_number}) ${initial_document_title}`;
  }
}

export const useConversationsStore = defineStore('conversations', {
  state: () => {
    return {
      contact_id: null,
      user_name: '',
      conversations: {},
      unread_conversations_number: 0,
      shown_conversation_id: null,
      is_replying: false,
      m_reply_id: null,
      prepared_message_deleted_id: null,
      u_files: [],
      text_message_replied: '',
      sender_message_replied: '',
      attachments_carousel_items: [],
      attachments_carousel_shown: [false, 0],
    }
  },
  getters: {
    conversation() {
      return function(conversation_id) {
        return this.conversations[conversation_id] || {messages: [], count: 0, booking: {guest: {name:'',nickname:''}, property: {attribute: {}}}};
      }
    },
    messages() {
      return function(conversation_id) {
        let conversation = this.conversations[conversation_id];

        if(conversation && conversation.messages) {
          return conversation.messages;
        }
        else {
          return [];
        }
      }
    }
  },
  actions: {
    addConversations: function(conversations) {
      for(var key in conversations) {
        let conversation = this.conversations[key] || {};
        let conversation_bis = conversations[key];

        conversation = {
          ...conversation,
          ...conversation_bis
        };
        
        this.conversations[conversation.id] = conversation;
      }
    },
    prependMessages: function(conversation_id, messages) {
      let conversation = this.conversations[conversation_id] || {messages: [], count: 0};

      conversation.messages = [...messages, ...conversation.messages];

      this.conversations = {...this.conversations, ...{[conversation_id]: conversation}}
    },
    addMessages: function(messages, messages_count, conversation_id) {
      let conversation = this.conversations[conversation_id] || {messages: [], count: 0};

      conversation.messages = messages;
      conversation.messages_count = messages_count;
      conversation.loaded_messages = true;

      this.conversations = {...this.conversations, ...{[conversation_id]: conversation}}
    },
    addReaction: function(message_id, ascii_code, conversation_id) {
      useFetch(`/api/conversations/${conversation_id}/add_reaction`, {
        method: 'POST',
        body: JSON.stringify({
          message_id: message_id,
          ascii_code : ascii_code
        })
      })
    },
    removeReaction: function(message_id, ascii_code, conversation_id) {
      useFetch(`/api/conversations/${conversation_id}/remove_reaction`, {
        method: 'POST',
        body: JSON.stringify({
          message_id: message_id,
          ascii_code : ascii_code
        })
      })
    },
    addMessage: function(messages, conversation_id) {
      let conversation = this.conversations[conversation_id] || {messages: [], count: 0};
      let last_message = messages[messages.length - 1];
            
      conversation.messages = [...conversation.messages, ...messages];
      conversation.messages_count += messages.length;
      conversation.last_message = [
        last_message.contact_id, 
        this.trimHtml(last_message.message_text),
        last_message.message_type,
        last_message.attachments.length
      ];

      if((conversation_id !== this.shown_conversation_id) && conversation.is_read) {
        conversation.is_read = false;
        this.unread_conversations_number++;
      }
      else {
        this.readConversation(conversation_id, true);
      }

      updateDocumentTitle(this.unread_conversations_number);
      this.conversations = {...this.conversations, ...{[conversation_id]: conversation}}
    },
    loadCurrentUser: async function() {
      let response = await useFetch('/api/user/contact');

      this.contact_id = response.id;
      this.user_name = response.full_name.split(' ')[0];
    },
    loadConversations: async function() {
      let response = await useFetch('/api/conversations');
      
      this.addConversations(response.conversations);
      this.unread_conversations_number = response.unread_conversations_number;
    },
    shownConversationId: function(conversation_id) {
      this.shown_conversation_id = conversation_id;

      if(!this.conversation(conversation_id).loaded_messages) {
        new Echo({
          broadcaster: 'socket.io',
          host: window.location.hostname + ':6001'
        }).private('App.Conversation.' + this.shown_conversation_id)
          .listen('NewMessageEvent', (e) => {
            this.addMessage(e.messages, conversation_id);
          })
          .listen('DeletedMessageEvent', (e) => {
            let deleted_message_index = this.conversation(e.conversation_id).messages.findIndex(
              (message) => (message.id === e.message.id)
            );
  
            if(deleted_message_index !== -1) {
              this.conversation(conversation_id).messages[deleted_message_index].deleted_at = e.message.deleted_at;
            }
  
            this.prepared_message_deleted_id = null;
          })
          .listen('ReadConversationEvent', (e) => {
            let read_by = this.conversation(e.conversation_id).read_by;

            if((e.user_name !== this.user_name) && !read_by.includes(e.user_name)) {
              read_by.push(e.user_name);
            }
          }).listen('NewReactionEvent', (e) => {
              this.conversation(e.conversation_id).messages = this.conversation(e.conversation_id).messages
              .map((message) => message.id === e.reaction.id
                  ? e.reaction 
                  : message)
          }).listen('RemoveReactionEvent', (e) => {
              this.conversation(e.conversation_id).messages = this.conversation(e.conversation_id).messages
              .map((message) => message.id === e.reaction.id
                  ? e.reaction 
                  : message)
          });
      }
    },
    loadMessages: async function(conversation_id) {

      if(!this.conversation(conversation_id).loaded_messages) {
        let response = await useFetch('/api/conversations/' + conversation_id);

        this.addMessages(response.messages, response.messages_count, conversation_id);
      }

      this.readConversation(conversation_id);
    },
    loadPreviousMessages: async function(conversation_id) {
      let last_message = this.messages(conversation_id)[0];

      if(last_message) {
        let url = '/api/conversations/' + conversation_id + '?before=' + last_message.sent_at;
        let response = await useFetch(url);

        this.prependMessages(conversation_id, response.messages);
      }
    },
    removeUploadedFile: async function(file, conversation_id) {
      let response = await useFetch('../api/conversations/' + conversation_id + '/upload', {
        method: 'POST',
        body: JSON.stringify({
          delete: true,
          file
        })
      });

      if(response.success) {
        this.u_files = this.u_files.filter((u_file) => (u_file.url !== file.url));
      }
    },
    saveMessage: async function(message, files, conversation_id) {
      let response = await useFetch('/api/conversations/' + conversation_id, {
        method: 'POST',
        body: JSON.stringify({
          message_text: message,
          reply_to_id : this.m_reply_id,
          attachments: files
        })
      });
      
      this.cancelReply();
      this.conversation(conversation_id).read_by = [];

      return response;
      // if (response.errors) {
      //   // var error = new Error(response.statusText)
      //   // error.response = response
      //   // throw error
      //   return (response.errors);
      // } else {
      //   this.addMessage(response.message, conversation_id);
      // }
      // this.addMessage(response.message, conversation_id);
    },
    replyTo: function(id, message_text, sender_name) {
      this.is_replying = true;

      this.m_reply_id = id;
      this.replied_message_text = this.trimHtml(message_text);
      this.replied_message_sender = sender_name;
    },
    cancelReply: function() {
      this.is_replying = false;

      this.m_reply_id = null;
      this.text_message_replied = '';
      this.sender_message_replied = '';
    },
    prepareMessageDeletion: function(id) {
      this.prepared_message_deleted_id = id;
    },
    cancelMessageDeletion: function() {
      this.prepared_message_deleted_id = null;
    },
    deleteMessage: async function(conversation_id, message_id = null) {
      if (message_id !== null) {
        let response = await useFetch('/api/conversations/' + conversation_id + '/messages/delete', {
            method: 'POST',
            body: JSON.stringify({
              message_id: message_id
            })
          }
        );
      }
    },
    readConversation: async function(conversation_id, read_new_message = false) {
      if ((!this.conversation(conversation_id).is_read) || read_new_message) {
        let response = await useFetch(`/api/conversations/${conversation_id}/read`);
      }

      let conversation = this.conversations[conversation_id];
      
      if(!conversation.is_read) {
        conversation.is_read = true;
        this.unread_conversations_number--;
      }

      updateDocumentTitle(this.unread_conversations_number);
    },
    trimHtml: function(str) {
      return str.replace(/<\/?[^>]+>/g, '');
    },
    talkInPrivate: async function(contact_id, router) {
      let response = await useFetch(`../api/conversations/talk-in-private/${contact_id}`, {
        method: 'POST',
      });

      if(response) {
        // router.push({
        //   name: 'inbox.show',
        //   params: { id: response }
        // });

        window.location.href = `/inbox/${response}`;
      }
    }
  }
})