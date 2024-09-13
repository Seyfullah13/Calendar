<template>
  <div 
    class="grid gap-4 my-2 items-center"
    :class="attachments.length > 1 ? 'grid-cols-2' : ''"
    v-if="attachments[0].mime_type.includes('image')"
  >
    <div 
      class="relative overflow-hidden" 
      :class="attachments.length > 1 ? 'h-48' : ''"
      v-for="(attachment, index) in attachments" :key="index"
    >
      <img 
        :src="attachmentsUrl(attachment.stored_name)" 
        class="w-full h-full object-cover rounded-lg cursor-pointer"  
        @click="openMessageAttachmentsCarousel($parent.$props.message.attachments, attachment.stored_name)"
      />
    </div>
    <div 
      class="flex justify-between items-center col-span-2 mt-4"
      v-if="attachments.length > 1"
    >
      <button class="text-sm text-blue-700 font-medium inline-flex items-center hover:underline">
        <svg class="w-3 h-3 mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 18">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3"/>
        </svg>
        Save all
        <!-- Triggers a .zip download of all the images -->
      </button>
    </div>
  </div>
  <div class="group relative my-2" v-else-if="attachments[0].mime_type.includes('video')">
    <video :src="attachmentsUrl(attachments[0].stored_name)" controls></video>
  </div>
  <template v-else>
    <div 
      class="message-attachment-container flex flex-col gap-2 my-2" 
      v-for="(attachment, index) in attachments" :key="index"
    >
      <a :href="attachmentsUrl(attachment.stored_name)" target="_blank" class="flex items-start bg-gray-100 hover:bg-gray-200 rounded-xl p-2 cursor-pointer">
        <div class="me-2">
          <span class="flex items-center gap-2 text-sm font-medium text-gray-900 pb-2">
            <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 3v4a1 1 0 0 1-1 1H5m4 8h6m-6-4h6m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z"/>
            </svg>
            {{ attachment.original_name }}
          </span>
          <span class="flex text-xs font-normal text-gray-500 gap-2">
            {{ attachmentSize(attachment.size) }}  
            • 
            {{ attachment.extension.toUpperCase() }}
          </span>
        </div>
      </a>
    </div>
  </template>
</template>

<script setup>
  import { useConversationsStore } from '../../stores/conversations';

  const store = useConversationsStore();
  const props = defineProps({
    attachments: Array
  });

  const attachmentSize = function(size) {
    if (size < 1024) {
      return parseInt(size + ' B');
    } 
    else if (size >= 1024 && size < (1024*1024)) {
      return parseInt(size / 1024) + ' kB';
    } else {
      return parseInt(size / 1024 / 1024) + ' MB';
    }
  }

  const attachmentsUrl = function(storedName) {
    return `${window.URL}/storage/${storedName}`;
  }

  const openMessageAttachmentsCarousel = function(attachments, activeAttachmentUrl) {
    let attachment_urls = [];
    let active_index = 0;

    for (let i = 0; i < attachments.length; i++) {
      const element = attachments[i];
      
      attachment_urls[i] = {
        position: i,
        url: element.stored_name,
      }

      if (element.stored_name === activeAttachmentUrl) {
        active_index = i;
      }
    }

    store.attachments_carousel_items = attachment_urls;
    store.attachments_carousel_shown = [true, active_index];
  }
</script>