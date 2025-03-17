<template>
    <section class="py-16 bg-blue-950">
      <div class="container mx-auto px-6">
        <div class="max-w-2xl mx-auto text-center">
          <h2 class="text-3xl font-bold mb-6">{{ title }}</h2>
          <p class="text-blue-300 mb-8">{{ description }}</p>
          <div class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto">
            <input 
              type="email" 
              :placeholder="placeholder" 
              class="flex-grow py-3 px-4 rounded-full bg-blue-900 border border-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
              v-model="email"
            >
            <button 
              class="bg-blue-600 hover:bg-blue-700 py-3 px-6 rounded-full transition-transform hover:scale-105 whitespace-nowrap"
              @click="onSubmit"
            >
              {{ buttonText }}
            </button>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  
  const props = defineProps({
    title: {
      type: String,
      default: 'Subscriu-te a la nostra newsletter'
    },
    description: {
      type: String,
      default: 'Rep les últimes estrenes, promocions exclusives i novetats directament al teu correu.'
    },
    placeholder: {
      type: String,
      default: 'El teu email'
    },
    buttonText: {
      type: String,
      default: 'Subscriu-me'
    }
  })
  
  const emit = defineEmits(['submit'])
  
  const email = ref('')
  
  const onSubmit = () => {
    emit('submit', { email: email.value })
    email.value = ''
  }
  </script>
  