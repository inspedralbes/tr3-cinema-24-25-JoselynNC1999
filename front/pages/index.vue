<template>
    <div class="min-h-screen bg-gradient-to-b from-blue-900 to-blue-800 text-white">
      <TheHeader  />
    <LandindPageFeaturesCard />
    <LandingPageHero/>
    <LandingPageFeatures/>
    <LandingPageMovieGallery />
    <PromoSection />
    <LandingPageNewsletter />
    <LandingPageSocialIcons/>
    <TheFooter class="mt-auto" />
  </div>
</template>

<script setup>

import { LandingPageFeatures, LandingPageMovieGallery, LandingPageNewsletter, LandingPageSocialIcons } from '#components';

import TheFooter from '@/components/layout/TheFooter.vue';
import TheHeader from '@/components/layout/TheHeader.vue';
import PromoSection from '~/components/layout/PromoSection.vue'

</script>