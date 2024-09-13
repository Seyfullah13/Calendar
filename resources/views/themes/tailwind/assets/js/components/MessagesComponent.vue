<template>
  <div class="flex h-[calc(100%-3.5rem)] antialiased text-gray-800">
    <div class="relative flex flex-row h-full w-full overflow-x-hidden">
      <div class="flex flex-col flex-auto h-full w-full">
        <div class="flex flex-col flex-auto flex-shrink-0 bg-white h-full">
          <div class="relative flex flex-row justify-center items-center card-header bg-gray-100 font-bold text-xl text-gray-500 w-full py-4 border-y border-y-gray-200">
            <button
              class="absolute top-1/2 left-2 -translate-y-1/2 inline-flex items-center p-1 text-gray-500 rounded-full text-sm hover:bg-gray-300"
              @click="toggleConversationsSidebar"
            >
              <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
              </svg>
            </button>
            <div
              class="flex items-center justify-center h-8 w-8 bg-gray-300 rounded-full overflow-hidden"
            >
              <!-- <svg
                class="w-6 h-6 text-gray-800"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                fill="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  fill-rule="evenodd"
                  d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                  clip-rule="evenodd"
                />
              </svg> -->
              <img
                :src="shown_conversation_has_booking ? shown_conversation.booking.guest.picture : shown_conversation.interlocutor.picture_url"
                alt=""
              >
            </div>
            <div class="flex gap-2 items-center ml-2 text-xl font-semibold">
              {{ shown_conversation_has_booking ? (shown_conversation.booking.guest.first_name + shown_conversation.booking.guest.last_name) : shown_conversation.interlocutor.full_name }}
              <template v-if="shown_conversation_has_booking">
                <img
                  :src="shown_conversation.booking.partenaire.icon"
                  alt=""
                  class="w-4 h-4 rounded-full"
                  v-if="shown_conversation.booking.partenaire"
                >
              </template>
            </div>
            <div
              class="absolute top-1/2 right-2 -translate-y-1/2 flex-shrink-0 p-4"
              v-if="shown_conversation_has_booking"
            >
              <button
                v-show="!is_rightbar_shown"
                @click="is_rightbar_shown = true"
                class="p-1 text-gray-500 font-black rounded-full bg-transparent hover:bg-gray-300 justify-self-end"
              >
                <span class="sr-only">Open conversation panel</span>
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
              </button>
            </div>
          </div>
          <div class="relative flex flex-col h-full overflow-x-hidden p-4 pt-0">
            <div class="flex flex-col flex-1 justify-end overflow-hidden">
              <div
                id="messages_block"
                class="grid w-full gap-y-2 max-h-full overflow-y-auto overscroll-none"
              >
                <div role="status" class="w-full flex justify-center items-center pt-2" v-if="is_scroll_loading">
                  <LoadingSpinner />
                  <span class="sr-only">Loading...</span>
                </div>
                <!-- <div class="border border-blue-300 shadow rounded-md p-4 max-w-sm w-full mx-auto">
                  <div class="animate-pulse flex space-x-4">
                    <div class="rounded-full bg-slate-700 h-10 w-10"></div>
                    <div class="flex-1 space-y-6 py-1">
                      <div class="h-2 bg-slate-700 rounded"></div>
                      <div class="space-y-3">
                        <div class="grid grid-cols-3 gap-4">
                          <div class="h-2 bg-slate-700 rounded col-span-2"></div>
                          <div class="h-2 bg-slate-700 rounded col-span-1"></div>
                        </div>
                        <div class="h-2 bg-slate-700 rounded"></div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <Message
                  :message="message"
                  :read_by="store.conversation(route.params.id).read_by"
                  v-for="(message, index) in conversation_messages"
                  :key="message.id"
                  :is_last_element="index === (conversation_messages.length - 1)"
                  :talk_in_private_loading="talk_in_private_loading"
                  @talk-in-private-event="talkInPrivate(message.sender.id)"
                  @scroll-to-replied-message="scrollToRepliedMessage"
                />
                <div
                  class="typing-message col-start-1 col-end-8 p-3 rounded-lg"
                  v-if="is_someone_typing"
                >
                  <div class="group relative flex flex-row items-end">
                    <div
                      class="flex items-center justify-center h-8 w-8 rounded-full bg-gray-200 flex-shrink-0"
                    >
                      <svg
                        class="w-6 h-6 text-gray-500"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                          clip-rule="evenodd"
                        />
                      </svg>
                    </div>
                    <div class="animate-pulse message-container flex flex-col text-start">
                      <div class="main-message-container relative flex-auto text-sm ml-3 bg-white py-2 px-4 shadow rounded-xl">
                        <!-- Typing... -->
                        {{ typing_message }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div
              id="go_to_last_message_btn"
              class="absolute bottom-24 left-1/2 -translate-x-1/2 animate-bounce bg-white hover:bg-gray-200 p-2 h-8 ring-1 ring-slate-900/5 shadow-lg rounded-full items-center justify-center cursor-pointer hidden transition-all duration-200"
              @click="scrollBot"
            >
              <svg class="w-4 h-4 text-indigo-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
              </svg>
            </div>
            <div class="sticky bottom-0 flex flex-col bg-white rounded-xl max-w-full">
              <div
                id="replied_message_block"
                class="relative py-2 px-4"
                v-if="store.is_replying"
              >
                <p class="text-sm font-semibold mb-2">
                  Reply to <span id="replied_user_name"> {{ store.replied_message_sender }}</span>
                </p>
                <p
                  id="replied_message_block_text"
                  class="text-sm text-gray-600 line-clamp-3"
                >
                  {{ store.replied_message_text }}
                </p>
                <span
                  id="replied_message_block_exit_btn"
                  class="absolute top-2 right-4 rounded-full border shadow-md hover:bg-gray-200 hover:border-gray-400"
                  @click="store.cancelReply"
                >
                  <svg class="w-6 h-6 p-1 text-gray-500 bg-transparent" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                  </svg>
                </span>
              </div>
              <div class="file-input-loader h-1 w-full bg-white" v-if="is_file_uploading">
                <div
                  class="h-full rounded-full bg-indigo-500 transition-all"
                  :style="{width: file.loading + '%'}"
                  v-for="(file, index) in files_uploading" :key="index"
                ></div>
              </div>
              <div
                id="send_message_loader"
                class="text-xs text-gray-500 w-full pt-4 text-center hidden"
              >
                <span>Loading...</span>
              </div>
              <form
                id="send_message_form"
                method="post"
                enctype="multipart/form-data"
                class="flex flex-row items-center rounded-xl bg-white w-full h-auto px-4 py-2 m-0"
              >
                <div>
                  <input type="file" id="file_upload_btn" name="u_files" class="hidden" @change="uploadFile">
                  <label
                    for="file_upload_btn"
                    class="cursor-pointer flex items-center justify-center text-gray-400 hover:text-gray-700"
                    data-tooltip-target="add-attachment-tooltip"
                    data-tooltip-placement="top"
                    v-if="store.u_files.length === 0"
                  >
                    <svg
                      class="w-5 h-5"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"
                      ></path>
                    </svg>
                  </label>
                  <div id="add-attachment-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white bg-gray-700 rounded-lg shadow-sm opacity-0 tooltip whitespace-nowrap">
                    Share files
                    <div class="tooltip-arrow" data-popper-arrow></div>
                  </div>
                </div>
                <div class="flex-grow mx-4">
                  <div
                    class="relative w-full mx-auto min-w-0 rounded-t-xl bg-gray-100 overflow-hidden"
                    v-if="store.u_files.length > 0"
                  >
                    <div class="overflow-x-auto flex p-4 gap-4">
                      <label for="file_upload_btn" class="flex flex-col items-center justify-center w-16 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 shadow shrink-0 hover:bg-gray-200 hover:border-gray-400">
                        <div class="flex flex-col items-center justify-center">
                          <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                          </svg>
                        </div>
                      </label>
                      <FileUploadPreview v-for="(u_file, index) in store.u_files" :key="index" :u_file="u_file" />
                    </div>
                  </div>
                  <div class="relative">
                    <textarea
                      id="u_message"
                      class="block bg-gray-100 p-2 w-full text-sm text-gray-900 border-none resize-none overflow-hidden focus:outline-transparent focus:border-transparent"
                      :class="store.u_files.length > 0 ? 'rounded-b-xl' : 'rounded-xl'"
                      name="u_message"
                      placeholder="Write your message..."
                      autocomplete="off"
                      rows="1"
                      v-model="u_message"
                    ></textarea>
                    <button
                      id="emoji_picker_btn"
                      type="button"
                      data-tooltip-target="add-emoji-tooltip"
                      data-tooltip-placement="top"
                      data-popover-target="emoji-picker-element"
                      data-popover-placement="top-end"
                      data-popover-trigger="click"
                      class="absolute flex items-center justify-center h-full w-8 rounded-xl right-0 top-0 text-gray-400 hover:text-gray-700"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 feather feather-smile" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                    </button>
                    <div
                      id="add-emoji-tooltip"
                      role="tooltip"
                      class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white bg-gray-700 rounded-lg shadow-sm opacity-0 tooltip whitespace-nowrap"
                    >
                      Choose an emoji
                      <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    <div
                      data-popover id="emoji-picker-element"
                      role="tooltip"
                      class="absolute z-20 invisible inline-block transition-opacity duration-300 border border-gray-200 rounded-lg shadow-sm opacity-0">
                        <div class="px-3 py-2 bg-white">
                          <emoji-picker class="message-form-emoji-picker light"></emoji-picker>
                        </div>
                      <div data-popper-arrow></div>
                    </div>
                  </div>
                </div>
                <div>
                </div>
                <div>
                  <button
                    id="send-message-submit-btn"
                    type="submit"
                    class="bg-indigo-500 hover:bg-indigo-600 flex items-center justify-center text-white p-2 rounded-full flex-shrink-0 cursor-not-allowed"
                    data-tooltip-target="send-message-tooltip"
                    data-tooltip-placement="top"
                    @click.prevent="saveMessage"
                    disabled
                  >
                    <svg
                      class="w-4 h-4 transform rotate-45 -mt-px"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                      ></path>
                    </svg>
                  </button>
                  <div
                    id="send-message-tooltip"
                    role="tooltip"
                    class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white bg-gray-700 rounded-lg shadow-sm opacity-0 tooltip whitespace-nowrap"
                  >
                    Send
                    <div class="tooltip-arrow" data-popper-arrow></div>
                  </div>
                </div>
                <div class="ml-2" v-if="u_message.trim().length > 0">
                                        <button type="button" @click="improveMessageWithAI"
                                            class="bg-indigo-500 hover:bg-indigo-600 text-white p-2 rounded-lg flex items-center justify-center">
                                            Improve with AI
                                        </button>
                                    </div>  
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section
      tabindex="-1"
      @keydown.escape="is_rightbar_shown = false"
      class="flex flex-col max-w-xs bg-white transition-all duration-200 border-l border-l-gray-200"
      :class="is_rightbar_shown ? 'w-full' : 'w-0'"
      v-if="shown_conversation_has_booking"
    >
      <div
        class="flex w-full items-center justify-end px-6 py-4 border-y border-y-gray-200"
      >
        <button @click="is_rightbar_shown = false" class="p-1 text-gray-500 font-black rounded-full bg-transparent hover:bg-gray-200">
          <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="h-full px-3 pt-4 pb-8 overflow-y-auto" v-if="shown_conversation_has_booking">
        <h2 class="text-center text-lg">{{ shown_conversation.booking.property.attribute.nickname }}</h2>
        <div class="booking-summary p-1 mx-5 mb-10">
          <span class="text-xs font-light ml-4">Their stay</span>
          <div class="flex flex-row items-center justify-center gap-2 text-2xs border-2 border-black rounded-lg px-10 pt-4 pb-2 mt-2">
            <div class="w-6">
              <span class="font-bold">
                {{ moment(shown_conversation.booking.check_in).format('MMM Do').toUpperCase() }}
              </span>
              <span class="font-light">
                after
                {{ moment(shown_conversation.booking.check_in).format('ha') }}
              </span>
            </div>
            <div class="relative flex-1 h-px bg-gray-300">
              <div class="absolute top-0 left-0 -translate-x-1/2 -translate-y-1/2 h-1 w-1 rounded-full bg-gray-300"></div>
              <div class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2 h-1 w-1 rounded-full bg-gray-300"></div>
            </div>
            <div class="w-6">
              <span class="font-bold">
                {{ moment(shown_conversation.booking.check_out).format('MMM Do').toUpperCase() }}
              </span>
              <span class="font-light">
                before
                {{ moment(shown_conversation.booking.check_out).format('hha') }}
              </span>
            </div>
          </div>
        </div>
        <div class="conversation-members">
          <button type="button" class="flex items-center w-full p-2 text-black font-medium text-lg transition duration-75 rounded-lg hover:bg-gray-100" aria-controls="booking-details-dropdown" data-collapse-toggle="booking-details-dropdown">
            <span class="flex-1 ms-1 text-left rtl:text-right whitespace-nowrap">View all members</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
          </button>
          <ul id="booking-details-dropdown" class="hidden py-2 space-y-2 border-b border-b-gray-200">
            <li v-for="(member, index) in shown_conversation.contacts" :key="index">
              <span href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 group rounded-lg">
                <img class="w-10 h-10 me-2 rounded-full" :src="'../storage/' + member.picture_url" alt="">
                <div class="flex flex-col flex-1 justify-center">
                  <span class="font-semibold text-sm">
                    {{ member.full_name }}
                  </span>
                  <span class="text-xs font-thin">
                    <template v-if="index === 0">Owner</template>
                    <template v-else-if="index === 1">Co-owner</template>
                    <template v-else>Traveler</template>
                  </span>
                </div>
                <button
                  :id="'member-' + member.id + '-dropdown-menu-button'"
                  :data-dropdown-toggle="'member-' + member.id + '-dropdown-menu'"
                  data-dropdown-placement="top-start"
                  class="p-1 text-gray-800 font-black rounded-full bg-white group-hover:bg-gray-100 group-hover:hover:bg-gray-300 justify-self-end"
                >
                  <span class="sr-only">Open member dropdown menu</span>
                  <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                </button>
                <div
                  :id="'member-' + member.id + '-dropdown-menu'"
                  class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-auto"
                >
                  <ul class="py-2 text-xs text-gray-700" :aria-labelledby="'member-' + member.id + '-dropdown-menu-button'">
                    <li>
                      <a href="#" class="block px-4 py-2 hover:bg-gray-100">View profile</a>
                    </li>
                    <li>
                      <span
                        :id="'copiable-email-' + member.id"
                        class="flex flex-row gap-1 items-center justify-center px-4 py-2 hover:bg-gray-100 cursor-pointer"
                        @click="copyEmailToClipboard(member.id, member.email)"
                      >
                        {{ member.email }}
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" stroke="currentColor" stroke-width="2"><path d="M384 336H192c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16l140.1 0L400 115.9V320c0 8.8-7.2 16-16 16zM192 384H384c35.3 0 64-28.7 64-64V115.9c0-12.7-5.1-24.9-14.1-33.9L366.1 14.1c-9-9-21.2-14.1-33.9-14.1H192c-35.3 0-64 28.7-64 64V320c0 35.3 28.7 64 64 64zM64 128c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H256c35.3 0 64-28.7 64-64V416H272v32c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192c0-8.8 7.2-16 16-16H96V128H64z"/></svg>
                      </span>
                    </li>
                    <template v-if="member.id !== store.contact_id">
                      <li @click="talkInPrivate(member.id)">
                        <span
                          class="flex items-center justify-between px-4 py-2 hover:bg-gray-100 cursor-pointer">
                          Talk in private

                          <svg aria-hidden="true" class="w-4 h-4 text-gray-200 animate-spin fill-indigo-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg" v-if="talk_in_private_loading"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                          <span class="sr-only">Loading...</span>
                        </span>
                      </li>
                      <li>
                        <a href="#" class="text-red-700 block px-4 py-2 hover:bg-gray-100">Report profile</a>
                      </li>
                    </template>
                  </ul>
                </div>
              </span>
            </li>
          </ul>
        </div>
        <div class="accomodation flex flex-row items-center justify-center gap-4 border-2 border-gray-300 rounded-lg px-6 p-4 my-6">
          <div>
            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
              <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
            </svg>
          </div>
          <div class="flex flex-col flex-1 items-start">
            <h2 class="text-center text-lg">Your accomodation</h2>
            <span class="text-xs font-light">
              {{ shown_conversation.booking.property.attribute.nickname }} •
              <a href="#" class="underline hover:text-gray-400">View details</a>
            </span>
          </div>
        </div>
        <div class="access-codes flex flex-col gap-6 text-xs my-6">
          <div class="flex flex-row items-start justify-between">
            <div class="flex flex-1 flex-col gap-2">
              <span>
                <ul>
                  <li class="flex flex-row items-center justify-between px-2 py-1">
                    <span class="font-bold">Access codes</span>
                    <a href="#" class="font-medium underline text-black hover:text-gray-700">Modify</a>
                  </li>
                  <li class="flex flex-row items-center justify-between px-2 py-1 border-b border-b-gray-200">
                    <span>Parking</span>
                    <span>9304</span>
                  </li>
                  <li class="flex flex-row items-center justify-between px-2 py-1 border-b border-b-gray-200">
                    <span>Key box</span>
                    <span>9304</span>
                  </li>
                  <li class="flex flex-row items-center justify-between px-2 py-1 ">
                    <span>Entrance door</span>
                    <span>9304</span>
                  </li>
                </ul>
              </span>
            </div>
          </div>
        </div>

        <hr class="h-0.5 bg-black my-6" />

        <div class="booking-details flex flex-col gap-6 text-xs">
          <h2 class="text-center text-lg mt-6">Booking details</h2>
          <div class="flex flex-row items-start justify-between">
            <div class="flex flex-1 flex-col gap-2">
              <span class="font-bold">Reservation code</span>
              <span>{{ shown_conversation.booking.token }}</span>
            </div>
            <div>
              <a href="#" class="font-medium underline text-black hover:text-gray-700">Modify</a>
            </div>
          </div>
          <!-- <div class="flex flex-row items-start justify-between">
            <div class="flex flex-1 flex-col gap-2">
              <span class="font-bold">Cancelling conditions</span>
              <span>If the traveler cancel before the scheduled arrival time of 11:00 on 16 May, he/she will be entitled to a partial refund. After this time, the booking is non-refundable.</span>
            </div>
            <div>
              <a href="#" class="font-medium underline text-black hover:text-gray-700">Modify</a>
            </div>
          </div> -->
          <div class="attachments flex flex-col items-center justify-center gap-2">
            <!-- <a href="#" class="flex flex-row items-center justify-between border-2 border-black rounded-lg px-4 py-2 w-full hover:bg-gray-100">
              <span class="font-bold">Download PDF for VISA</span>
              <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
              </svg>
            </a> -->
            <a href="#" class="flex flex-row items-center justify-between border-2 border-black rounded-lg px-4 py-2 w-full hover:bg-gray-100">
              <span class="font-bold">Download receipt</span>
              <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
              </svg>
            </a>
          </div>
        </div>

        <hr class="h-0.5 bg-black my-6" />

        <div class="instructions flex flex-col gap-6 text-xs">
          <h2 class="text-center text-lg mt-6">Instructions</h2>
          <div class="flex flex-row items-start justify-between">
            <!-- <div class="flex flex-1 flex-col gap-1">
              <span class="font-bold">House rules</span>
              <span>
                <ul>
                  <li>Maximum 4 travelers</li>
                  <li>No pets</li>
                  <li>No parties</li>
                </ul>
              </span>
            </div>
            <div>
              <a href="#" class="font-medium underline text-black hover:text-gray-700">Modify</a>
            </div> -->
          </div>
          <div class="attachments flex flex-col items-center justify-center gap-2">
            <a href="#" class="flex flex-row items-center justify-between border-2 border-black rounded-lg px-4 py-2 w-full hover:bg-gray-100">
              <span class="font-bold">Display the announce</span>
              <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
              </svg>
            </a>
          </div>
        </div>

        <hr class="h-0.5 bg-black my-6" />

        <div class="instructions flex flex-col items-center justify-center gap-2 text-xs">
          <h2 class="text-center text-lg mt-6">Your traveler</h2>
          <img :src="shown_conversation.booking.guest.picture" alt="" class="w-20 h-20 rounded-full">
          <span class="font-bold text-black text-2xs">{{ shown_conversation.booking.guest.first_name }}</span>
          <a href="#" class="font-medium underline text-black hover:text-gray-700">View profile</a>
        </div>

        <hr class="h-0.5 bg-black my-6" />

        <div class="payment flex flex-col gap-4 text-xs">
          <h2 class="text-center text-lg mt-6">Payment</h2>
          <span class="font-bold text-black text-2xs">Details</span>
          <div>
            <div class="flex flex-row items-center justify-between">
              <span>Already paid</span>
              <span>200€</span>
            </div>
            <div class="flex flex-row items-center justify-between font-bold">
              <span>Rest in charge</span>
              <span>1403€</span>
            </div>
          </div>
          <div class="flex flex-row items-center justify-between font-bold">
            <span>TOTAL</span>
            <span>1603€</span>
          </div>
        </div>

        <div class="flex flex-col items-center justify-center gap-2 font-medium text-xs mt-6">
          <a href="#" class="flex flex-row items-center justify-between border-2 border-gray-300 rounded-lg px-4 py-2 w-full hover:bg-gray-100">
            <span class="flex flex-row gap-2">
              <div class="w-4 h-4 rounded-full bg-gray-200"></div>
              Security deposit
            </span>
            <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
            </svg>
          </a>
          <a href="#" class="flex flex-row items-center justify-between border-2 border-gray-300 rounded-lg px-4 py-2 w-full hover:bg-gray-100">
            <span class="flex flex-row gap-2">
              <div class="w-4 h-4 rounded-full bg-lime-400"></div>
              Tourist taxes
            </span>
            <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
            </svg>
          </a>
          <a href="#" class="flex flex-row items-center justify-between border-2 border-gray-300 rounded-lg px-4 py-2 w-full hover:bg-gray-100">
            <span class="flex flex-row gap-2">
              <div class="w-4 h-4 rounded-full bg-gray-200"></div>
              <ul>
                <li>Upsells</li>
                <li class="text-gray-500">Flowers</li>
                <li class="text-gray-500">Event tickets</li>
                <li class="text-gray-500">Guided tour</li>
              </ul>
            </span>
            <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
            </svg>
          </a>

          <a href="#" class="flex flex-row items-center justify-between border-2 border-black rounded-lg px-4 py-2 mt-2 w-full hover:bg-gray-100">
            <span class="font-bold">Download receipt</span>
            <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
            </svg>
          </a>
          <a href="#" class="flex flex-row items-center justify-between border-2 border-black rounded-lg px-4 py-2 mt-2 w-full hover:bg-gray-100">
            <span class="font-bold">Help support</span>
            <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
            </svg>
          </a>
        </div>
      </div>
    </section>
  </div>


  <!-- Message image attachments carousel -->
    <!-- Carousel wrapper -->
    <Carousel
      id="attachments-carousel" class="absolute top-0 left-0 w-full h-screen bg-black bg-opacity-75 z-50 flex flex-col items-center justify-center"
      :items-to-show="1"
      :modelValue="store.attachments_carousel_shown[1]"
      v-if="store.attachments_carousel_shown[0]"
      @init="initAttachmentCarousel"
    >
      <slide v-for="image in store.attachments_carousel_items" :key="image.position">
        <img
          :src="'../storage/' + image.url"
          class="max-h-full"
          alt="..."
        >
        <!-- {{ image.url }} -->
      </slide>

      <template #addons>
        <Navigation />
        <Pagination />
        <div class="absolute top-4 left-0 start-0 z-30 flex items-center justify-center gap-4 w-full px-4 cursor-pointer focus:outline-none">
          <button
            class="inline-flex items-center justify-center w-10 h-10 rounded-full hover:bg-black/40 active:outline active:outline-2 active:outline-white"
            @click="downloadCurrentImage"
          >
            <svg class="w-5 h-5 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
              <path fill-rule="evenodd" d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z" clip-rule="evenodd"/>
              <path fill-rule="evenodd" d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z" clip-rule="evenodd"/>
            </svg>
            <span class="sr-only">Download</span>
          </button>
          <button
            class="inline-flex items-center justify-center w-10 h-10 rounded-full hover:bg-black/40 active:outline active:outline-2 active:outline-white"
            @click="closeMessageAttachmentsCarousel"
          >
            <svg class="w-5 h-5 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
            </svg>
            <span class="sr-only">Exit</span>
          </button>
        </div>
      </template>
    </Carousel>

  <!-- For form validation -->
  <button id="popup-modal-btn" data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="hidden" type="button">Toggle modal</button>

  <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 id="popup-modal-text" class="mb-5 text-lg font-normal text-gray-500"></h3>
                <button data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Got it
                </button>
            </div>
        </div>
    </div>
  </div>

  <!-- Delete message modal -->
  <span
    class="invisible hidden"
    data-modal-target="delete-message-modal"
    data-modal-toggle="delete-message-modal"
  ></span>
  <div
    id="delete-message-modal"
    data-modal-backdrop="static"
    tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
  >
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow">
        <button
          type="button"
          class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
          data-modal-hide="delete-message-modal"
          @click="store.cancelMessageDeletion"
        >
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
        <div class="p-4 md:p-5 text-center">
          <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
          </svg>
          <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete this message?</h3>
          <button
            data-modal-hide="delete-message-modal"
            @click="store.deleteMessage(route.params.id, store.prepared_message_deleted_id)"
            type="button"
            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"
          >
            Yes, I'm sure
          </button>
          <button
            data-modal-hide="delete-message-modal"
            @click="store.cancelMessageDeletion"
            type="button"
            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100"
          >
            No, cancel
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { watch, computed, onMounted, onUnmounted, ref, nextTick } from 'vue';
  import { useConversationsStore } from '../stores/conversations';
  import { useRoute, useRouter } from 'vue-router';
  import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
  import 'vue3-carousel/dist/carousel.css';
  import 'emoji-picker-element';
  import moment from 'moment';
  import insertTextAtCursor from 'insert-text-at-cursor';
  import Message from './partials/Message.vue';
  import FileUploadPreview from './partials/FileUploadPreview.vue';
  import LoadingSpinner from './partials/LoadingSpinner.vue';

  const store = useConversationsStore();
  const route = useRoute();
  const router = useRouter();

  const u_message = ref('');

  const messages_block    = ref('');
  const typing_message    = ref('');
  const is_someone_typing = ref(false);
  const is_scroll_loading = ref(false);
  const is_file_uploading = ref(false);
  const talk_in_private_loading = ref(false);
  const is_rightbar_shown  = ref(false);
  const files_uploading   = ref([]);

  const conversation_messages = computed(() => {
    return store.messages(route.params.id);
  });

  const conversation_messages_count = computed(() => {
    return store.conversation(route.params.id).messages_count;
  });

  const shown_conversation = computed(() => {
    return store.conversation(route.params.id);
  });

  const shown_conversation_has_booking = computed(() => {
    return shown_conversation.value.booking !== null;
  });

  const loadMessages = async function() {
    await store.loadMessages(route.params.id);

    if(conversation_messages.value.length < conversation_messages_count.value) {
      messages_block.value.addEventListener('scroll', handlePreviousMessagesLoading);
    }

    scrollBot();
  };

  const saveMessage = async function() {
    const submit_btn_loader = document.getElementById('send_message_loader');

    submit_btn_loader.classList.remove('hidden');

    if (u_message.value.length + store.u_files.length === 0) {
      showPopupModal('You cannot send an empty message.');
    }
    else {
      let response = await store.saveMessage(u_message.value, store.u_files, route.params.id);

      if(response.attachments) {
        let messages = []

        for (const key of Object.keys(response.attachments)) {
          messages.push(response.attachments[key]);
        }

        showPopupModal(messages.join(', '));
      }
    }
    const improveMessageWithAI = async function () {
    try {
        const response = await axios.post('http://localhost:8000/improve-message',
            {
                model: 'gpt-4o-mini',
                messages: [{ role: 'user', content: u_message }],
                temperature: 0.7,
                max_tokens: 150,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': window.csrf,
                    'Content-Type': 'application/json'
                }
            });

        u_message = response.data.choices[0].message.content;
    } catch (error) {
        console.error('Error while improving message with AI:', error);
    }
};

    u_message.value = '';
    store.u_files = [];
    submit_btn_loader.classList.add('hidden');
    document.getElementById('u_message').style.height = 'auto';

    focusOnMessageInput();
  };

  // one file at a time for now
  const uploadFile = function(e) {
    const files = e.target.files[0];

    if (files.size > 20971520) {
      showPopupModal('The selected file is too large. The maximum size should not exceed 20 MB.');
    }
    else {
      const file_name = files.name;
      const form_data = new FormData();
      form_data.append('file', files);

      files_uploading.value.push({
        name: file_name,
        loading: 0
      });
      is_file_uploading.value = true;

      // Utilisation de XMLHttpRequest pour suivre la progression de l'upload
      const xhr = new XMLHttpRequest();
      xhr.open('POST', '../api/conversations/' + route.params.id + '/upload', true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhr.setRequestHeader('X-CSRF-TOKEN', window.csrf);

      xhr.upload.onprogress = (event) => {
        if (event.lengthComputable) {
          const percentComplete = Math.floor((event.loaded / event.total) * 100);
          files_uploading.value[files_uploading.value.length - 1].loading = percentComplete;
        }
      };

      xhr.onload = () => {
        if (xhr.status === 200) {
          store.u_files.push(JSON.parse(xhr.response));
        } else {
          showPopupModal('Error uploading file: ' + xhr.statusText + '. ' + JSON.parse(xhr.response).message);
        }
        files_uploading.value = [];
        is_file_uploading.value = false;
      };

      xhr.onerror = () => {
        showPopupModal('Error uploading file: ' + xhr.statusText + '. ' + JSON.parse(xhr.response).message);
      };

      xhr.send(form_data);
    }

    focusOnMessageInput();
  };

  const showPopupModal = function(message) {
    document.getElementById('delete-message-modal-text').innerHTML = message;
    document.getElementById('delete-message-modal-btn').click();
  };

  const handlePreviousMessagesLoading = async function(e) {
    const messages_block = e.target;

    if(messages_block.scrollTop === 0) {
      is_scroll_loading.value = true;

      messages_block.removeEventListener('scroll', handlePreviousMessagesLoading);

      let previousScrollHeigth = messages_block.scrollHeight;

      await store.loadPreviousMessages(route.params.id);
      nextTick(() => {
        messages_block.scrollTop = messages_block.scrollHeight - previousScrollHeigth;
      });
      is_scroll_loading.value = false;

      if(conversation_messages.value.length < conversation_messages_count.value) {
        messages_block.addEventListener('scroll', handlePreviousMessagesLoading);
      }
    }
  }

  const handleGoToLastMessage = function(e) {
    const messages_block = e.target;
    const scroll_btn = document.getElementById('go_to_last_message_btn');

    if ((messages_block.scrollHeight - messages_block.offsetHeight) > (messages_block.scrollTop + 1)) {
      scroll_btn.classList.remove('hidden');
      scroll_btn.classList.add('flex');
    } else {
      scroll_btn.classList.add('hidden');
      scroll_btn.classList.remove('flex');
    }
  }

  const scrollBot = function() {
    nextTick(() => {
      messages_block.value.scrollTo({
        top: messages_block.value.scrollHeight,
        behavior: 'smooth'
      });
    });

    focusOnMessageInput();
  }

  const scrollToRepliedMessage = function(id) {
    let target = document.getElementById('message_' + id);
    let target_message_container = target.querySelector('.message-container');

    messages_block.value.scrollTo({
      top: target.offsetTop,
      behavior: 'smooth'
    });

    messages_block.value.addEventListener(
      'scrollend',
      function eventHandler(e) {
        target_message_container.classList.add('scale-105');
        setTimeout(function() {
          target_message_container.classList.remove('scale-105');
        }, 250)
        messages_block.value.removeEventListener('scrollend', eventHandler);
      }
    );
  }

  const focusOnMessageInput = function() {
    document.getElementById('u_message').focus();
  }

  const toggleConversationsSidebar = function () {
    const sidebar = document.getElementById('inbox-sidebar');
    const mainContent = document.getElementById('conversation');

    if (sidebar.classList.contains('w-64')) {
      sidebar.style.width = '4rem';
      mainContent.style.marginLeft = '4rem';
      sidebar.classList.remove('text-left', 'px-6', 'w-64');
      sidebar.classList.add('text-center', 'px-0', 'w-16');
    } else {
      sidebar.style.width = '16rem';
      mainContent.style.marginLeft = '16rem';
      sidebar.classList.add('text-left', 'px-6', 'w-64');
      sidebar.classList.remove('text-center', 'px-0', 'w-16');
    }

    const labels = sidebar.querySelectorAll('span, .inbox-sidebar__label');
    labels.forEach(label => label.classList.toggle('hidden'));
  }

  const copyEmailToClipboard = function(id, email) {
    const target = document.getElementById('copiable-email-' + id);
    const original_content = target.innerHTML;

    navigator.clipboard.writeText(email);
    target.innerHTML = 'Copied to clipboard !';

    setTimeout(() => {
      target.innerHTML = original_content;
    }, 2000);
  }

  const talkInPrivate = function(id) {
    talk_in_private_loading.value = true;

    store.talkInPrivate(id, router);
  };

  const initAttachmentCarousel = function() {
    window.addEventListener('keyup', handleKeyup);
  }

  const closeMessageAttachmentsCarousel = function() {
    store.attachments_carousel_shown = [false, 0];
  };

  const downloadCurrentImage = function() {
    let current_image_index = store.attachments_carousel_shown[1];
    let current_image_url = '../storage/' + store.attachments_carousel_items[current_image_index].url;

    const link = document.createElement('a');
    link.href = current_image_url;
    link.download = current_image_url.substring(current_image_url.lastIndexOf('/') + 1);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  };

  const handleKeyup = function(e) {
    if (e.key === "Escape") {
      closeMessageAttachmentsCarousel();
    }
  };

  const improveMessageWithAI = async function() {
    try {
      const response = await axios.post('/api/improve-message', {
        model: 'gpt-4o-mini',
        messages: [{ role: 'user', content: u_message }],
        temperature: 0.7,
        max_tokens: 150
      });

      u_message = response.data.choices[0].message.content;
    } catch (error) {
      console.error('Error while improving message with AI:', error);
    }
  };

  watch(() => route.params.id, (newValue) => {
    loadMessages();
    document.getElementById('u_message').focus();

    store.shownConversationId(newValue);
    store.readConversation(newValue);
  });

  watch(() => store.conversation(route.params.id).last_message, (newValue, oldValue) => {
    scrollBot();
  });

  watch(() => u_message.value.length + store.u_files.length, (sum) => {
    const submit_btn = document.getElementById('send-message-submit-btn');

    if (sum === 0) {
      submit_btn.setAttribute('disabled', 'disabled');
      submit_btn.classList.add('cursor-not-allowed');
    }
    else {
      submit_btn.removeAttribute('disabled');
      submit_btn.classList.remove('cursor-not-allowed');
    }
  });

  watch(() => store.attachments_carousel_shown[0], (newValue) => {
    if (newValue) {
      initAttachmentCarousel();
    } else {
      window.removeEventListener('keyup', handleKeyup);
    }
  });

  onMounted(function() {
    store.shownConversationId(route.params.id);

    loadMessages();
    focusOnMessageInput();

    messages_block.value = document.getElementById('messages_block');
    messages_block.value.addEventListener('scroll', handlePreviousMessagesLoading);
    messages_block.value.addEventListener('scroll', handleGoToLastMessage);

    if (store.attachments_carousel_shown[0]) {
      initAttachmentCarousel();
    }

    // const echo = new Echo({
    //   broadcaster: 'socket.io',
    //   host: window.location.hostname + ':6001'
    // });

    // watch(() => u_message.value, (newValue, oldValue) => {
    //   echo.private('App.conversation.' + store.shown_conversation_id)
    //       .whisper('typing', {
    //         name: store.user_name,
    //       });
    // });

    // echo.private('App.conversation.' + store.shown_conversation_id)
    //     .listenForWhisper('typing', (e) => {
    //         is_someone_typing.value = true;
    //         typing_message.value = `${e.name} is typing...`;
    //     });

    const message_input = document.getElementById('u_message');

    const tx = document.getElementsByTagName("textarea");
    const maxHeight = 96;

    for (let i = 0; i < tx.length; i++) {
      tx[i].setAttribute("style", "height:" + Math.min(tx[i].scrollHeight, maxHeight) + "px;overflow-y:auto;");
      tx[i].addEventListener("input", OnInput, false);
    }

    function OnInput() {
      this.style.height = 'auto';
      this.style.height = Math.min(this.scrollHeight, maxHeight) + "px";
    }

    document.querySelector('.message-form-emoji-picker').addEventListener('emoji-click', e => {
      insertTextAtCursor(message_input, e.detail.unicode);
    });
  });

  onUnmounted(() => {
    window.removeEventListener('keyup', handleKeyup);
  });

</script>

<style>

  .carousel {
    position: absolute !important;
  }

  .carousel__viewport {
    height: 80% !important;
  }

  .carousel__pagination {
    margin-block: 10px;
  }

  .carousel__track {
    height: 100%;
  }

  .carousel__prev,
  .carousel__next {
    color: white;
  }

  .carousel__prev--disabled,
  .carousel__next--disabled {
    display: none;
  }
</style>
