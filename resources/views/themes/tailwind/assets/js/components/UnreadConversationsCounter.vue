<!-- <template>
  <span 
    id="unread-conversations-counter" 
    class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-xs font-bold text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300"
    v-if="store.unread_conversations_number > 0"
  >
    {{ store.unread_conversations_number }}
  </span>
</template> -->
<template>
  <!-- <span
    class="absolute top-0 right-0 translate-x-1/4 -translate-y-1/4 flex items-center justify-center w-4 h-4 text-xs text-red-100 bg-red-500 rounded-full"
    v-if="store.unread_conversations_number > 0"
  >
    {{ store.unread_conversations_number }}
  </span> -->
  <span
    class="inline-flex items-center justify-center w-3 h-3 p-2.5 me-2.5 text-xs font-medium text-secondary-800 bg-secondary-100 rounded-full"
    v-if="store.unread_conversations_number > 0"
  >
    {{ store.unread_conversations_number }}
  </span>
</template>

<script setup>
  import { useConversationsStore } from '../stores/conversations';
  import { onMounted } from 'vue';

  const store = useConversationsStore();

  onMounted(() => {
    store.loadConversations();
  })
</script>