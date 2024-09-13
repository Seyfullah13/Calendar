<template>
  <div 
    :id="'message_' + message.id" 
    class="group p-1 rounded-3xl grid grid-cols-12"
    v-if="message.message_type === 'message'"
  >
    <div 
      class="relative flex gap-3"
      :class="[cls.block, cls.text_position]"
    >
      <div
        class="relative flex items-center justify-center h-8 w-8 rounded-full bg-indigo-500 flex-shrink-0 mt-1 group/sender"
      >
        <img class="w-full h-full rounded-full" :src="'../storage/' + message.sender.picture_url" alt="" v-if="message.sender.picture_url !== ''">
          <!-- <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
          </svg> -->
        <template v-else>
          {{ message.sender.first_name[0] }}
        </template>
      </div>
      <div 
        class="message-container flex flex-col transition-all"
        :class="cls.message_position"
        v-if="message.deleted_at !== null"
      >
        <div 
          class="main-message-container relative flex-auto text-sm text-gray-400 mt-1 py-1 px-4 shadow rounded-xl bg-gray-100 border-dashed border-2 border-gray-400"
        >
          <span>
            {{ `${isMe ? 'You' : message.sender.first_name} deleted a message` }}
          </span>
        </div>
        <div
          class="message-details text-2xs mx-2 mt-1 text-gray-500"
          :class="cls.details_position + '-14'"
        >
          Deleted {{ deletedDate }}
          <span class="message-sender" v-if="!isMe">
            {{ ' • ' + message.sender.first_name }} 
            <br>
          </span>
        </div>
      </div>
      <div 
        class="message-container flex flex-col transition-all"
        :class="cls.message_position"
        v-else
      >
        <div 
          class="replied_message_text text-sm bg-gray-200 text-gray-400 -mb-2 px-3 pt-2 pb-4 rounded-xl cursor-default transition-all active:scale-105" 
          :class="cls.replied_style"
          v-html="(message.reply_to.message_text !== '') ? message.reply_to.message_text : 'Attachments'"
          v-if="message.reply_to !== null"
          @click="$emit('scrollToRepliedMessage', message.reply_to_id)"
        ></div>
        <div 
          class="main-message-container relative flex-auto text-sm py-2 px-4 shadow rounded-xl max-w-lg break-words"
          :class="cls.message_bg"
        >
          <span v-html="message.message_text"></span>
          <MessageAttachment :attachments="message.attachments" v-if="message.attachments.length > 0"/>

          <!-- {{-- Link Previews --}}
          {{-- <div class="flex flex-col w-full max-w-[320px] leading-1.5 border-gray-200 bg-gray-100 rounded-xl bg-transparent">
            <a href="#" class="bg-gray-50 rounded-xl p-4 hover:bg-gray-200">
              <img src="https://flowbite.com/docs/images/og-image.png" class="rounded-lg mb-2" />
              <span class="text-sm font-medium text-gray-900 mb-2">GitHub - themesberg/flowbite: The most popular and open source libra ...</span>
              <span class="text-xs text-gray-500 font-normal">github.com</span>
            </a>
          </div> --}} -->
          <div class="flex flex-row flex-wrap max-w-72 w-fit gap-y-2  gap-x-2" :class="message.reactions.length && 'mt-2'">
            <div v-for="(reaction, index) in message.reactions" 
              class="w-fit py-1 px-1.5 rounded-md cursor-pointer" 
              :class="hasReacted(reaction) 
                ? 'border-2 border-blue-500 bg-blue-200' 
                : 'border-2 border-stone-100 bg-stone-100'"
              @click="hasReacted(reaction) 
                ? removeReaction(message.id, reaction.reaction_unicode) 
                : addReaction(message.id, reaction.reaction_unicode)"
              :data-tooltip-target="'message-' + message.id + '-' + index + '-persons-tooltip'" 
              data-tooltip-placement="top"
            >
              <span class="pr-1" >{{getEmoji(reaction)}}</span>
              <span class="" >{{reaction.times}}</span>
            </div>
          </div>
          <div 
            class="absolute top-1/2 -translate-y-1/2 flex items-center justify-center gap-2 invisible group-hover:visible group-focus:visible mx-3"
            :class="cls.details_position + '-full'"
          >
            <button 
              :id="'message-' + message.id + '-dropdown-menu-button'" 
              :data-dropdown-toggle="'message-' + message.id + '-dropdown-menu'" 
              :data-dropdown-placement="cls.dropdown_placement" 
              :data-tooltip-target="'message-' + message.id + '-menu-tooltip'" 
              data-tooltip-placement="top" 
              type="button"
            >
              <svg class="w-7 h-7 rounded-full p-1 text-gray-500 bg-transparent border shadow-md hover:bg-gray-200 hover:border-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
            </button>
            <button 
              :id="'message-' + message.id + '-dropdown-emojis-button'" 
              :data-popover-target="'message-' + message.id + '-emojis'" 
              :data-popover-placement="cls.dropdown_placement"
              data-popover-trigger="click"
              :data-tooltip-target="'message-' + message.id + '-emojis-tooltip'" 
              data-tooltip-placement="top" 
              type="button"
              class="box-border"
            >
            <svg id="emoji" class="w-7 h-7 rounded-full p-1 text-gray-500 bg-transparent border shadow-md hover:bg-gray-200 hover:border-gray-400" viewBox="0 0 72 72" xmlns="http://www.w3.org/2000/svg">
              <g id="line">
                <circle cx="36" cy="36" r="23" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                <path fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M45.8147,45.2268a15.4294,15.4294,0,0,1-19.6294,0"/>
                <path fill="none" stroke="#000" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M31.6941,33.4036a4.7262,4.7262,0,0,0-8.6382,0"/>
                <path fill="none" stroke="#000" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M48.9441,33.4036a4.7262,4.7262,0,0,0-8.6382,0"/>
              </g>
            </svg>
            </button>
            <div 
              :id="'message-' + message.id + '-dropdown-menu'" 
              class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-32"
            >
              <ul class="py-2 text-xs text-gray-700" :aria-labelledby="'message-' + message.id + '-dropdown-menu-button'">
                <li 
                  v-if="!isMe"
                  @click="$emit('talkInPrivateEvent')"
                >
                  <span class="flex items-center justify-between gap-2 px-4 py-2 hover:bg-gray-100 cursor-pointer">
                    Talk in private

                    <svg aria-hidden="true" class="w-4 h-4 text-gray-200 animate-spin fill-indigo-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg" v-if="talk_in_private_loading"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                          <span class="sr-only">Loading...</span>
                  </span>
                </li>
                <li v-if="isMe">
                  <span 
                    class="text-red-700 block px-4 py-2 hover:bg-gray-100 cursor-pointer"
                    data-modal-target="delete-message-modal" 
                    data-modal-toggle="delete-message-modal" 
                    @click="store.prepareMessageDeletion(message.id)"
                  >
                    Delete message
                  </span>
                </li>
              </ul>
            </div>
            <div 
              :id="'message-' + message.id + '-emojis'" 
              class="absolute z-40 invisible inline-block transition-opacity duration-300 border border-gray-200 rounded-lg shadow-sm opacity-0" :aria-labelledby="'message-' + message.id + '-emojis'">
                <div class="px-3 py-2 bg-white">
                  <emoji-picker class="light relative z-100" 
                    @emojiClick="(e) => addReactionFromPicker(e, message.id)">
                  </emoji-picker>
                </div>
              <div data-popper-arrow></div>
            </div>
            <div :id="'message-' + message.id + '-menu-tooltip'" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white bg-gray-700 rounded-lg shadow-sm opacity-0 tooltip whitespace-nowrap">
              More options
              <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <div :id="'message-' + message.id + '-emojis-tooltip'" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white bg-gray-700 rounded-lg shadow-sm opacity-0 tooltip whitespace-nowrap">
              Add a reaction
              <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            
            <div v-for="(reaction, index) in message.reactions" :id="'message-' + message.id + '-' + index + '-persons-tooltip'" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white bg-gray-700 rounded-lg shadow-sm opacity-0 tooltip whitespace-nowrap">
                <span>{{ message.reactions.length && reaction.persons.map((person) => person.full_name).join(", ") }}</span>
              <div v-if="message.reactions.length" class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <span 
              :data-id="message.id" 
              :data-tooltip-target="'reply-tooltip-' + message.id" 
              data-tooltip-placement="top" 
              class="reply_message_btn cursor-pointer" 
              @click="replyTo(message.id)"
            >
              <svg 
                class="w-7 h-7 rounded-full p-1 text-gray-500 bg-transparent border shadow-md hover:bg-gray-200 hover:border-gray-400" 
                aria-hidden="true" 
                xmlns="http://www.w3.org/2000/svg" 
                width="24" 
                height="24" 
                fill="none" 
                viewBox="0 0 24 24"
              >
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.5 8.046H11V6.119c0-.921-.9-1.446-1.524-.894l-5.108 4.49a1.2 1.2 0 0 0 0 1.739l5.108 4.49c.624.556 1.524.027 1.524-.893v-1.928h2a3.023 3.023 0 0 1 3 3.046V19a5.593 5.593 0 0 0-1.5-10.954Z"/>
              </svg>
            </span>
            <div :id="'reply-tooltip-' + message.id" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white bg-gray-700 rounded-lg shadow-sm opacity-0 tooltip whitespace-nowrap">
              Reply to {{ (isMe) ? 'You' : message.sender.first_name }} 
              <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
          </div>
        </div>
        <div
          class="message-details text-2xs mx-2 mt-1 text-gray-500"
          :class="cls.details_position + '-14'"
        >
            <!-- {{ string_read_by !== '' ? 'text-right' : '' }} -->
          <!-- @if (Carbon::parse($message->sent_at)->diffInMonths() >= 2)
            {{ date('M j, Y, g:i A', strtotime($message->sent_at)) }}
          @else
            {{ Carbon::parse($message->sent_at)->diffForHumans() }}
          @endif -->

          {{ sentDate }}
          <span class="message-sender">
            {{ (isMe) ? '' : ' • ' + message.sender.first_name }} 
          </span>
          <br>

          <div v-if="is_last_element && (message.contact_id === store.contact_id)">
            <div 
              class="flex items-center gap-1 justify-end" 
              v-if="read_by.length > 0"
            >
              <span 
                data-tooltip-target="'read-by-tooltip'" 
                data-tooltip-placement="top" 
                type="button"
                class="cursor-default"
              >Read by {{ string_read_by }}</span>
              <div 
                id="'read-by-tooltip'" 
                role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 max-w-16 text-xs font-medium text-white bg-gray-700 rounded-lg shadow-sm opacity-0 tooltip"
              >
                {{ read_by.join(', ') }}
                <div class="tooltip-arrow" data-popper-arrow></div>
              </div>
            </div>
            <div class="flex items-center gap-1 justify-end" v-else>
              <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
              </svg>
              Sent
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div 
    class="grid grid-cols-12"
    v-else
  >
    <div
      class="col-start-4 col-end-10 p-3 rounded-lg"
    >
      <div class="relative flex m-auto">
        <div class="notification-container flex flex-col w-full text-gray-500 text-center">
          <div
            class="notification-details text-xs text-center bottom-0 mb-2"
          >
            {{ sentDate }}
          </div>
          <div class="main-notification-container bg-gray-200 text-sm font-semibold py-1 px-4 shadow rounded-2xl flex items-center justify-center">
            <svg class="w-4 h-4 mr-2 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5.464V3.099m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175C19 17.4 19 18 18.462 18H5.538C5 18 5 17.4 5 16.807c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 12 5.464ZM6 5 5 4M4 9H3m15-4 1-1m1 5h1M8.54 18a3.48 3.48 0 0 0 6.92 0H8.54Z"/>
            </svg>
            <label v-html="message.message_text"></label>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { computed, onMounted } from 'vue';
  import { useRoute } from 'vue-router';
  import moment from 'moment';
  import { useConversationsStore } from '../../stores/conversations';
  import MessageAttachment from './MessageAttachment.vue';
  import 'emoji-picker-element';
  import { initFlowbite } from 'flowbite';

  const store = useConversationsStore();
  const route = useRoute();

  const props = defineProps({
    message: Object,
    is_last_element: Boolean,
    talk_in_private_loading: Boolean,
    read_by: Array
  });

  const string_read_by = computed(() => {
    let conversation = store.conversation(route.params.id);
    let conversation_members_number = conversation.total_members_number;
    let read_by_length = props.read_by.length;
    let result = '';

    if (conversation.booking === null) {
      result = conversation.interlocutor.first_name;
    } else {
      if(read_by_length === (conversation_members_number - 1)) {
        result = 'all';
      }
      else if(read_by_length === 1) {
        result = props.read_by[0];
      }
      else {
        result = props.read_by[0] + ' and ' + (read_by_length - 1) + ' others';
      }
    }

    return result;
  });

  const messageClasses = {
    me: {
      block: 'col-start-4 col-end-13',
      message_position: 'items-end',
      text_position: 'justify-start flex-row-reverse',
      message_bg: 'bg-indigo-100',
      replied_style: 'rounded-br-none',
      details_position: 'right',
      dropdown_placement: 'top-end'
    },
    other: {
      block: 'col-start-1 col-end-10',
      message_position: 'items-start',
      text_position: 'flex-row',
      message_bg: 'bg-white',
      replied_style: 'rounded-bl-none',
      details_position: 'left',
      dropdown_placement: 'top-start'
    }
  };

  const isMe = computed(() => {
    return props.message.contact_id === store.contact_id;
  });

  const isANotification = computed(() => {
    return props.message.message_type === 'notification';
  });

  const cls = computed(() => {
    return isMe.value ? messageClasses.me : messageClasses.other;
  });

  const sentDate = computed(() => {
    const sentAt = moment(props.message.sent_at);

    let result = `${sentAt.format('MMM D, YYYY')} • ${sentAt.format('h:mm A')}`;

    if((!isANotification.value) && moment().diff(sentAt, 'months') < 2) {
      return capitalizeFirstLetter(sentAt.fromNow());
    }

    return result;
  });

  const deletedDate = computed(() => {
    const deletedAt = moment(props.message.deleted_at);

    let result = `at ${deletedAt.format('MMM D, YYYY')} • ${deletedAt.format('h:mm A')}`;

    if((!isANotification.value) && moment().diff(deletedAt, 'months') < 2) {
      return deletedAt.fromNow();
    }

    return result;
  });

  const replyTo = function(id) {
    const replied_message_text = (props.message.message_text === '') ? 'Attachments' : props.message.message_text;
    const replied_message_sender = (isMe) ? 'You' : props.message.sender.first_name;

    document.getElementById('u_message').focus();

    store.replyTo(id, replied_message_text, replied_message_sender);
  }

  function getAsciiCode(unicode){
    return unicode.split("").map((char) => char.charCodeAt(0)).join("/")
  }

  function addReactionFromPicker(e, message_id){
    store.addReaction(message_id, getAsciiCode(e.detail.unicode), route.params.id)
  }

  function addReaction(message_id, ascii_code){
    store.addReaction(message_id, ascii_code, route.params.id)
  }

  function removeReaction(message_id, ascii_code){
    store.removeReaction(message_id, ascii_code, route.params.id)
  }

  function getEmoji(reaction){
    return reaction.reaction_unicode.split("/").map((char) => String.fromCharCode(char)).join("")
  }

  function hasReacted(reaction){
    return reaction.persons.filter((person) => person.contact_id === store.contact_id).length
  }

  function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }

  onMounted(() => {
    initFlowbite();
  });
</script>
