<template>
    <footer class="bg-blue-950 py-10 border-t border-blue-800">
      <div class="container mx-auto px-6">
        <div class="md:flex md:justify-between mb-8">
          <div class="mb-6 md:mb-0">
            <h3 class="text-2xl font-bold mb-2">{{ siteName }}</h3>
            <p class="text-blue-300 max-w-md">
              "{{ tagline }}"
            </p>
          </div>
          <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
            <div v-for="(section, index) in footerSections" :key="index">
              <h4 class="text-lg font-semibold mb-4">{{ section.title }}</h4>
              <ul class="space-y-2 text-blue-300">
                <li v-for="(item, itemIndex) in section.items" :key="itemIndex">
                  <a v-if="item.url" :href="item.url" class="hover:text-white transition-colors">{{ item.text }}</a>
                  <span v-else>{{ item.text }}</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="pt-8 border-t border-blue-800 flex flex-col md:flex-row justify-between items-center">
          <div class="text-blue-400 text-sm mb-4 md:mb-0">
            {{ copyright }}
          </div>
          <div class="flex space-x-6">
            <a v-for="(social, index) in socialLinks" :key="index" :href="social.url" class="text-blue-400 hover:text-white transition-colors">
              <span class="sr-only">{{ social.name }}</span>
              <component :is="social.icon" class="h-6 w-6" fill="currentColor" aria-hidden="true" />
            </a>
          </div>
        </div>
      </div>
    </footer>
  </template>
  
  <script setup>
  defineProps({
    siteName: {
      type: String,
      default: 'Cinépolis Pedralbes'
    },
    tagline: {
      type: String,
      default: 'Perquè cada sessió ha de ser especial, t\'oferim el millor confort i qualitat per viure el cinema com mai abans.'
    },
    footerSections: {
      type: Array,
      default: () => [
        {
          title: 'Cinema',
          items: [
            { text: 'Cartellera', url: '#' },
            { text: 'Pròximes estrenes', url: '#' },
            { text: 'Promocions', url: '#' },
            { text: 'VIP Experience', url: '#' }
          ]
        },
        {
          title: 'Informació',
          items: [
            { text: 'Sobre nosaltres', url: '#' },
            { text: 'Contacte', url: '#' },
            { text: 'Privacitat', url: '#' },
            { text: 'FAQs', url: '#' }
          ]
        },
        {
          title: 'Contacte',
          items: [
            { text: 'Avinguda Pedralbes, 123' },
            { text: 'Barcelona, 08034' },
            { text: 'Tel: 93 123 45 67' },
            { text: 'info@cinepolispedralbes.com' }
          ]
        }
      ]
    },
    copyright: {
      type: String,
      default: '© 2025 Cinépolis Pedralbes. Tots els drets reservats.'
    },
    socialLinks: {
      type: Array,
      default: () => [
        { 
          name: 'Facebook', 
          url: '#',
          icon: 'FacebookIcon'
        },
        { 
          name: 'Instagram', 
          url: '#',
          icon: 'InstagramIcon'
        },
        { 
          name: 'Twitter', 
          url: '#',
          icon: 'TwitterIcon'
        }
      ]
    }
  })
  </script>
  