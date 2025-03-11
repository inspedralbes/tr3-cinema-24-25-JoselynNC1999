<template>
    <div class="min-h-screen bg-gradient-to-b from-blue-900 to-blue-800 text-white">
      <TheHeader  />
    <LandindPageFeaturesCard />
    <LandingPageHero/>
    <LandingPageFeatures/>
    <LandingPageMovieGallery />
    <LandingPagePromoSection />
    <LandingPageNewsletter />
    <LandingPageSocialIcons/>
    <TheFooter class="mt-auto" />
  </div>
</template>

<script setup>

import { LandingPageFeatures, LandingPageMovieGallery, LandingPageNewsletter, LandingPagePromoSection, LandingPageSocialIcons } from '#components';

import TheFooter from '@/components/layout/TheFooter.vue';
import TheHeader from '@/components/layout/TheHeader.vue'


</script>