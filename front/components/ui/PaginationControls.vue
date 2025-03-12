<template>
    <div class="flex justify-center">
      <div class="flex space-x-2">
        <a 
          v-for="page in displayedPages" 
          :key="page" 
          href="#" 
          :class="[
            'w-10 h-10 flex items-center justify-center rounded-full transition-colors', 
            page === currentPage 
              ? 'bg-blue-700 text-white' 
              : 'bg-blue-900 hover:bg-blue-700 text-white'
          ]"
          @click.prevent="$emit('page-change', page)"
        >
          {{ page }}
        </a>
        <span v-if="showEllipsis" class="w-10 h-10 flex items-center justify-center text-blue-300">...</span>
        <a 
          v-if="showLastPage" 
          href="#" 
          class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-900 hover:bg-blue-700 text-white transition-colors"
          @click.prevent="$emit('page-change', totalPages)"
        >
          {{ totalPages }}
        </a>
      </div>
    </div>
  </template>
  
  <script setup>
  import { computed } from 'vue'
  
  const props = defineProps({
    currentPage: {
      type: Number,
      required: true,
      default: 1
    },
    totalPages: {
      type: Number,
      required: true
    }
  })
  
  defineEmits(['page-change'])
  
  const displayedPages = computed(() => {
    if (props.totalPages <= 5) {
      return Array.from({ length: props.totalPages }, (_, i) => i + 1)
    }
    
    if (props.currentPage <= 3) {
      return [1, 2, 3, 4]
    }
    
    if (props.currentPage >= props.totalPages - 2) {
      return Array.from(
        { length: 4 }, 
        (_, i) => props.totalPages - 3 + i
      )
    }
    
    return [
      props.currentPage - 1,
      props.currentPage,
      props.currentPage + 1
    ]
  })
  
  const showEllipsis = computed(() => {
    return props.totalPages > 5 && props.currentPage < props.totalPages - 2
  })
  
  const showLastPage = computed(() => {
    return props.totalPages > 5 && props.currentPage < props.totalPages - 1
  })
  </script>