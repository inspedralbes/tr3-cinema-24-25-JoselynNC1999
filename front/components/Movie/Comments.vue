<template>
    <section class="py-12">
      <div class="container mx-auto px-6">
        <h2 class="text-2xl font-bold mb-8 flex items-center">
          <span class="bg-blue-600 w-3 h-8 mr-3 rounded-sm"></span>
          Opinions dels espectadors
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
          <div v-for="(comment, index) in comments" :key="index" class="bg-blue-900/40 rounded-lg p-6">
            <div class="flex items-start gap-4">
              <div class="w-12 h-12 rounded-full bg-blue-800 flex-shrink-0 flex items-center justify-center">
                👤
              </div>
              <div class="flex-grow">
                <div class="flex justify-between items-center mb-2">
                  <h3 class="font-bold">{{ comment.name }}</h3>
                  <div class="flex text-yellow-400 text-sm">
                    <span v-for="i in 5" :key="i" :class="i <= comment.rating ? '' : 'text-blue-700'">★</span>
                  </div>
                </div>
                <p class="text-blue-200 text-sm mb-2">{{ comment.date }}</p>
                <p class="text-blue-100">{{ comment.text }}</p>
              </div>
            </div>
          </div>
        </div>
        <!-- Formulari de comentaris -->
        <div class="bg-blue-900/40 rounded-lg p-6">
          <h3 class="font-bold text-xl mb-4">Deixa la teva opinió</h3>
          <div class="mb-4">
            <label class="block text-blue-300 mb-2">La teva valoració</label>
            <div class="flex text-2xl text-blue-700">
              <span v-for="i in 5" :key="i" class="cursor-pointer hover:text-yellow-400"
                    @mouseenter="hoverRating = i" @mouseleave="hoverRating = 0" @click="setRating(i)">
                {{ i <= (hoverRating || userRating) ? '★' : '★' }}
              </span>
            </div>
          </div>
          <div class="mb-4">
            <label class="block text-blue-300 mb-2">El teu comentari</label>
            <textarea v-model="userComment" class="w-full bg-blue-950 border border-blue-700 rounded-lg p-3 text-white min-h-32 focus:outline-none focus:ring-2 focus:ring-blue-400"
                      placeholder="Comparteix la teva experiència..."></textarea>
          </div>
          <button @click="submitComment" class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded-full transition-transform hover:scale-105">
            Enviar comentari
          </button>
        </div>
      </div>
    </section>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  defineProps({
    comments: {
      type: Array,
      required: true
    }
  });
  
  const userRating = ref(0);
  const hoverRating = ref(0);
  const userComment = ref('');
  
  const setRating = (rating) => {
    userRating.value = rating;
  };
  
  const submitComment = () => {
    // Aquí afegiràs la lògica per enviar el comentari
    console.log('Comentari enviat:', userRating.value, userComment.value);
    // Es pot reiniciar el formulari
    userRating.value = 0;
    hoverRating.value = 0;
    userComment.value = '';
  };
  </script>
  