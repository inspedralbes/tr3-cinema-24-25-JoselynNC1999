<template>
    <div class="min-h-screen bg-gradient-to-b from-blue-900 to-blue-800 text-white">
      <LandingPageHeader  />
    <LandindPageFeaturesCard />
    <LandingPageHero/>
    <LandingPageMovieCard/>
    <LandingPageMovieGallery />
    <LandingPagePromoSection />
    <LandingPageNewsletter />
    <LandingPageSocialIcons/>
    <LandingPageFooter class="mt-auto" />
  </div>
</template>

<script setup>

import { LandingPageHeader, LandingPageMovieCard, LandingPageMovieGallery, LandingPageNewsletter, LandingPagePromoSection, LandingPageSocialIcons } from '#components';


</script>