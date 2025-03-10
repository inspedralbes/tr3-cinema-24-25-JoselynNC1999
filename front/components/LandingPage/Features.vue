<template>
  <section class="py-16 bg-blue-950/80">
    <div class="container mx-auto px-6">
      <h2 class="text-3xl md:text-4xl font-bold mb-12 text-center text-blue-200">
        {{ title }}
      </h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <FeatureCard
          v-for="(feature, index) in features"
          :key="index"
          :icon="feature.icon"
          :title="feature.title"
          :description="feature.description"
        />
      </div>
    </div>
  </section>
</template>

<script setup>
import FeatureCard from './FeatureCard.vue'

defineProps({
  title: {
    type: String,
    default: 'Una experiència única de cinema'
  },
  features: {
    type: Array,
    default: () => [
      {
        icon: '🍿',
        title: 'Gastronomia Premium',
        description: 'Gaudeix de les nostres opcions gourmet mentre veus la teva pel·lícula favorita.'
      },
      {
        icon: '🎬',
        title: 'Sales VIP',
        description: 'Butaques reclinables, espai extra i servei a la butaca per una experiència de luxe.'
      },
      {
        icon: '🎮',
        title: 'Zona d\'Entreteniment',
        description: 'Videojocs i atraccions per a tota la família abans o després de la pel·lícula.'
      }
    ]
  }
})
</script>