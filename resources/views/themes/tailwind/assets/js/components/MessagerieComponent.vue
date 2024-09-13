<template>
  <div class="relative flex h-screen antialiased text-gray-800 overflow-y-hidden">
    <div class="flex flex-row h-full w-full overflow-x-hidden">
      <div id="inbox-sidebar" class="absolute top-0 left-0 flex flex-col px-4 pt-14 pb-8 bg-white flex-shrink-0 overflow-y-auto w-16 h-full transition-all duration-200 ease-in-out border-t border-t-gray-200 border-r border-r-gray-200">
        <div class="flex flex-col h-full">
          <div 
            class="flex flex-col space-y-1 mt-4 -mx-2 overflow-y-auto h-full"
            v-if="Object.keys(store.conversations).length === 0"
          >
            <div 
              class="relative flex flex-col text-gray-300 hover:bg-gray-100 rounded-xl p-2 max-w-full animate-pulse"
              v-for="n in 4" :key="n"
            >
              <div class="flex flex-row items-center max-w-full">
                <div class="relative flex items-center justify-center h-8 w-8 bg-gray-300 rounded-md shrink-0"></div>
                <div class="inbox-sidebar__label relative flex flex-row shrink grow min-w-0 items-center justify-between text-wrap transition-all duration-200 hidden">
                  <div class="relative flex flex-col justify-start gap-1 max-w-full pl-4 font-semibold shrink-0">
                    <span class="flex gap-2 items-center text-md max-w-full truncate transition-all duration-200 hidden">
                      <div class="w-20 h-4 bg-gray-300 rounded-full"></div>
                      <div class="w-4 h-4 rounded-full"></div>
                    </span>
                    <span class="text-sm max-w-full truncate transition-all duration-200 hidden">
                      <div class="w-20 h-2 bg-gray-300 rounded-full"></div>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div 
            class="flex flex-col space-y-1 mt-4 -mx-2 overflow-y-auto h-full"
            v-else
          >
            <RouterLink
              v-for="conversation in store.conversations"
              :key="conversation.id"
              :to="{name: 'inbox.show', params: { id: conversation.id }}"
              class="relative flex flex-col hover:bg-gray-100 rounded-xl p-2 max-w-full"
              :class="{
                'border-x-2 border-blue-400 bg-blue-100 hover:bg-blue-200': !conversation.is_read,
                'text-gray-500': conversation.is_read,
                'bg-gray-200': (conversation.id === parseInt(route.params.id))
              }"
            >
              <div 
                class="flex flex-row items-center max-w-full"
                v-if="conversation.booking !== null"
              >
                <!-- {{-- @if(user_has_profile_pic)
                  <img src="path/to/user/profile/pic.png" alt="user_initials">
                @else
                  <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                  </svg>
                @endif --}} -->
                <!-- <div class="relative flex items-center justify-center h-8 w-8 bg-indigo-200 rounded-md shrink-0">
                  <img src="/storage/bookings/1/modele-maison-physalis-villas-club-comment-amenager-exterieur.jpg" alt="">
                  <div class="absolute top-3/4 right-0 -translate-x-1/4 flex items-center justify-center h-5 w-5 border-2 border-white rounded-full shrink-0 overflow-hidden">
                    <img src="https://wave.devdojo.com/themes/tailwind/images/profile.png" alt="">
                  </div>
                  <div class="absolute bottom-0 left-3/4 -translate-x-1/4 flex items-center justify-center h-5 w-5 border-2 border-white rounded-full shrink-0 overflow-hidden">
                    <img src="https://wave.devdojo.com/themes/tailwind/images/profile.png" alt="">
                  </div>
                </div> -->
                <div class="relative flex items-center justify-center h-8 w-8 bg-indigo-200 rounded-md shrink-0">
                  <img src="/storage/bookings/1/modele-maison-physalis-villas-club-comment-amenager-exterieur.jpg" alt="">
                  <div class="absolute bottom-0 right-0 translate-x-1/4 translate-y-1/4 flex items-center justify-center h-5 w-5 border-2 border-white rounded-full shrink-0 overflow-hidden">
                    <img :src="conversation.booking.guest.picture" alt="">
                  </div>
                </div>
                <div class="inbox-sidebar__label relative flex flex-row shrink grow min-w-0 items-center justify-between text-wrap transition-all duration-200 hidden">
                  <div class="relative flex flex-col justify-start max-w-full pl-4 font-semibold shrink-0">
                    <span class="flex gap-2 items-center text-md max-w-full truncate transition-all duration-200 hidden">
                      {{ conversation.booking.guest.first_name + ' ' + conversation.booking.guest.last_name }}
                      <img :src="conversation.booking.partenaire.icon" alt="" class="w-4 h-4 rounded-full">
                    </span>
                    <span class="text-sm max-w-full truncate transition-all duration-200 hidden">
                      <template 
                        v-if="
                          (parseInt(conversation.last_message[0]) === store.contact_id) 
                          && (conversation.last_message[1] !== '')
                          && (conversation.last_message[2] !== 'notification')"
                      >
                        You : 
                      </template>
                      {{ lastMessageText(conversation) }}
                    </span>
                  </div>
                </div>
              </div>
              <div 
                class="flex flex-row items-center max-w-full"
                v-else
              >
                <div class="relative flex items-center justify-center h-8 w-8 bg-indigo-200 rounded-full shrink-0 overflow-hidden">
                  <img :src="'../storage/' + conversation.interlocutor.picture_url" alt="">
                </div>
                <div class="inbox-sidebar__label relative flex flex-row shrink grow min-w-0 items-center justify-between text-wrap transition-all duration-200 hidden">
                  <div class="relative flex flex-col justify-start max-w-full pl-4 font-semibold shrink-0">
                    <span class="flex gap-2 items-center text-md max-w-full truncate transition-all duration-200 hidden">
                      {{ conversation.interlocutor.full_name }}
                    </span>
                    <span class="text-sm max-w-full truncate transition-all duration-200 hidden">
                      <template 
                        v-if="
                          (parseInt(conversation.last_message[0]) === store.contact_id) 
                          && (conversation.last_message[1] !== '')
                          && (conversation.last_message[2] !== 'notification')"
                      >
                        You : 
                      </template>
                      {{ lastMessageText(conversation) }}
                    </span>
                  </div>
                </div>
              </div>
            </RouterLink>
          </div>
        </div>
      </div>

      <div id="conversation" :data-id="parseInt(route.params.id)" class="w-[calc(100%-16rem)] sm:ml-64 flex-1 transition-all duration-200" style="margin-left: 4rem;">
        <RouterView />
      </div>
    </div>
  </div>
</template>

<script setup>
  import { onMounted } from 'vue';
  import { useConversationsStore } from '../stores/conversations';
  import { useRoute } from 'vue-router';

  const store = useConversationsStore();
  const route = useRoute();

  const lastMessageText = function(conversation) {
    let result = conversation.last_message[1];
    let sent_or_received = (conversation.last_message[0] === store.contact_id) ? 'sent' : 'received';
    let attachment_word = (conversation.last_message[3] > 1) ? 'attachments' : 'attachment';

    if(conversation.last_message[1] === '' && conversation.last_message[3] > 0) {
      result = 'You ' + sent_or_received + ' ' + conversation.last_message[3] + ' ' + attachment_word + '.';
    }
    
    return result;
  }

  onMounted(function() {
    store.loadCurrentUser();
  });
</script>