<template>
  <div class="flex flex-col items-center justify-center gap-3">
    <div class="relative h-16 border border-gray-200 rounded-lg shadow shrink-0 flex items-center justify-center" v-if="u_file.type.includes('image')">
      <img 
        class="rounded-lg max-h-full" 
        :class="is_removing ? 'opacity-50' : ''"
        :src="windowUrl + '/storage/' + u_file.url" 
        alt="" 
      />
      <span 
        class="absolute top-0 right-0 w-6 h-6 translate-x-1/2 -translate-y-1/2 bg-gray-50 border rounded-full shadow-md text-gray-400 flex items-center justify-center cursor-pointer hover:bg-gray-200 hover:border-gray-400" 
        @click="removeUploadedFile"
      >
        <svg class="w-3 h-3 text-gray-800 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
        </svg>
      </span>
      <span 
        v-if="is_removing" 
        class="absolute top-1/2 right-1/2 translate-x-1/2 -translate-y-1/2"
      >
        <svg aria-hidden="true" class="w-4 h-4 text-gray-200 animate-spin fill-indigo-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
      </span>
    </div>

    <div 
      class="relative h-16 border border-gray-200 rounded-lg shadow shrink-0 flex items-center justify-center" 
      v-else-if="u_file.type.includes('video')"
    >
      <video 
        class="rounded-lg max-h-full"
        :class="is_removing ? 'opacity-50' : ''"
        :src="windowUrl + '/storage/' + u_file.url" 
      ></video>
      <span 
        class="absolute top-0 right-0 w-6 h-6 translate-x-1/2 -translate-y-1/2 bg-gray-50 border rounded-full shadow-md text-gray-400 flex items-center justify-center cursor-pointer hover:bg-gray-200 hover:border-gray-400" 
        @click="removeUploadedFile"
      >
        <svg class="w-3 h-3 text-gray-800 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
        </svg>
      </span>
      <span class="absolute top-1/2 left-1/2 w-8 h-8 -translate-x-1/2 -translate-y-1/2 bg-transparent border-2 border-white rounded-full shadow-md text-white flex items-center justify-center">
        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
          <path fill-rule="evenodd" d="M8.6 5.2A1 1 0 0 0 7 6v12a1 1 0 0 0 1.6.8l8-6a1 1 0 0 0 0-1.6l-8-6Z" clip-rule="evenodd"/>
        </svg>
      </span>
      <span 
        class="absolute top-1/2 right-1/2 translate-x-1/2 -translate-y-1/2"
        v-if="is_removing" 
      >
        <svg aria-hidden="true" class="w-4 h-4 text-gray-200 animate-spin fill-indigo-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
      </span>
    </div>

    <div 
      class="relative bg-gray-200 w-28 border border-gray-200 rounded-lg shadow shrink-0" 
      v-else
    >
      <div 
        class="flex items-center gap-1 px-2 py-4"
        :class="is_removing ? 'opacity-50' : ''"
      >
        <span>
          <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 3v4a1 1 0 0 1-1 1H5m4 8h6m-6-4h6m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z"/>
          </svg>
        </span>
        <span class="text-xs w-16 truncate">{{ u_file.name }}</span>
      </div>
      <span class="absolute top-0 right-0 w-6 h-6 translate-x-1/2 -translate-y-1/2 bg-gray-50 border rounded-full shadow-md text-gray-400 flex items-center justify-center cursor-pointer hover:bg-gray-200 hover:border-gray-400" @click="removeUploadedFile">
        <svg class="w-3 h-3 text-gray-800 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
        </svg>
      </span>
      <span v-if="is_removing" class="absolute top-1/2 right-1/2 translate-x-1/2 -translate-y-1/2">
        <svg aria-hidden="true" class="w-4 h-4 text-gray-200 animate-spin fill-indigo-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
      </span>
    </div>
  </div>
</template>

<script setup>
  import { computed, ref } from 'vue';
  import { useRoute } from 'vue-router';
  import { useConversationsStore } from '../../stores/conversations';

  const props = defineProps({
    u_file: Object
  });
  const store = useConversationsStore();
  const route = useRoute();

  const is_removing = ref(false);

  const removeUploadedFile = async function() {
    is_removing.value = true;

    await store.removeUploadedFile(props.u_file, route.params.id);

    is_removing.value = false;
  };

  const windowUrl = computed(() => {
    return window.URL;
  })
</script>