<template>
    <section class="py-16 bg-blue-950">
      <div class="container mx-auto px-6">
        <div class="max-w-2xl mx-auto text-center">
          <h2 class="text-3xl font-bold mb-6">Subscriu-te a la nostra newsletter</h2>
          <p class="text-blue-300 mb-8">Rep les últimes estrenes, promocions exclusives i novetats directament al teu correu.</p>
          <NewsletterForm />
        </div>
      </div>
    </section>
  </template>
  
  <script setup>
  import NewsletterForm from '~/components/ui/NewsletterForm.vue'
  </script>