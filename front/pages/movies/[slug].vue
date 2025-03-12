<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-900 to-blue-800 text-white">
    <TheHeader />
    <Breadcrumb :currentTitle="movie.title" />
    <MovieDetail :movie="movie" />
    <Sessions
      :movie="movie"
      :upcomingDays="upcomingDays"
      :selectedDay="selectedDay"
      @update:selectedDay="selectedDay = $event"
    />
    <RelatedMovies :relatedMovies="relatedMovies" />
    <PromoSection />
    <Comments :comments="comments" />
    <NewsletterSection />
    <TheFooter />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import TheHeader from '@/components/layout/TheHeader.vue';
import Breadcrumb from '@/components/layout/Breadcrumb.vue';
import MovieDetail from '~/components/Movie/MovieDetail.vue';
import Sessions from '~/components/Movie/Sessions.vue';
import RelatedMovies from '~/components/Movie/RelatedMovies.vue';
import PromoSection from '~/components/layout/PromoSection.vue';
import Comments from '~/components/Movie/Comments.vue';
import NewsletterSection from '@/components/sections/NewsletterSection.vue';
import TheFooter from '@/components/layout/TheFooter.vue';

const selectedDay = ref(0);

const upcomingDays = [
  { dayName: 'Avui', date: '11 Mar' },
  { dayName: 'Dimecres', date: '12 Mar' },
  { dayName: 'Dijous', date: '13 Mar' },
  { dayName: 'Divendres', date: '14 Mar' },
  { dayName: 'Dissabte', date: '15 Mar' },
  { dayName: 'Diumenge', date: '16 Mar' },
  { dayName: 'Dilluns', date: '17 Mar' }
];

const movie = ref({
  title: 'Cosmos Infinit',
  emoji: '🌌',
  rating: 'TP',
  isVOSE: false,
  is3D: true,
  isVIP: true,
  isNew: false,
  genre: 'Ciència Ficció',
  duration: 145,
  year: 2025,
  director: 'Maria Rodríguez',
  stars: 5,
  synopsis: 'Un viatge fascinant a través de l\'univers que canviarà la nostra percepció del cosmos.',
  extendedSynopsis: 'Quan un equip d\'astrònoms descobreix un misteriós senyal provinent d\'una llunyana galàxia, s\'inicia una aventura interestel·lar que posarà a prova els límits del coneixement humà. "Cosmos Infinit" és una odissea visual que explora els misteris més profunds de l\'univers i la nostra connexió amb les estrelles. Una història sobre el coratge, la curiositat científica i la capacitat humana per superar els límits del que coneixem.',
  cast: ['Elena Martí', 'Carlos López', 'Laura Puig', 'Marc Fernández', 'Anna Torres', 'Joan Garcia'],
  sessions: {
    standard: ['15:45', '18:30', '21:15'],
    threeD: ['16:30', '19:15', '22:00'],
    vip: ['17:30', '20:30']
  }
});

const relatedMovies = [
  {
    title: 'La Gran Aventura',
    emoji: '🎬',
    genre: 'Aventura',
    duration: 135,
    badge: 'ESTRENA'
  },
  {
    title: 'Comèdia Total',
    emoji: '🤣',
    genre: 'Comèdia',
    duration: 95,
    badge: 'ESTRENA'
  },
  {
    title: 'Misteri a la Mansió',
    emoji: '👻',
    genre: 'Terror',
    duration: 110,
    badge: null
  }
];

const comments = ref([
  {
    name: 'Usuari 1',
    rating: 4,
    date: '10 Mar 2025',
    text: 'Una pel·lícula impressionant, molt recomanada!'
  },
  {
    name: 'Usuari 2',
    rating: 5,
    date: '11 Mar 2025',
    text: 'Em va encantar la direcció i l\'efecte visual. Una obra mestra!'
  }
]);
</script>
