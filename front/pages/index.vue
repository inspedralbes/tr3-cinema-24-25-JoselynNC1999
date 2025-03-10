<template>
    <div class="min-h-screen bg-gradient-to-b from-blue-900 to-blue-800 text-white">
      <!-- Header -->
      <header class="py-4 px-6 bg-blue-950 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
          <div class="flex items-center">
            <span class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-purple-400 animate-pulse">Cinépolis Pedralbes</span>
          </div>
          <nav class="hidden md:flex space-x-8">
            <a href="#" class="hover:text-blue-300 transition-colors duration-300">Inici</a>
            <a href="#" class="hover:text-blue-300 transition-colors duration-300">Cartellera</a>
            <a href="#" class="hover:text-blue-300 transition-colors duration-300">Promocions</a>
            <a href="#" class="hover:text-blue-300 transition-colors duration-300">Sobre nosaltres</a>
            <a href="#" class="hover:text-blue-300 transition-colors duration-300">Contacte</a>
          </nav>
          <button class="md:hidden text-2xl">
            <i class="fas fa-bars"></i>
          </button>
        </div>
      </header>
  
      <!-- Hero Section -->
      <section class="py-16 relative overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
          <div class="md:flex items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
              <h1 class="text-4xl md:text-6xl font-bold mb-4 leading-tight">
                Benvinguts a 
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-purple-500">
                  Cinépolis Pedralbes
                </span>
              </h1>
              <p class="text-xl md:text-2xl mb-8 text-blue-200 italic">
                "Perquè cada sessió ha de ser especial, t'oferim el millor confort i qualitat per viure el cinema com mai abans."
              </p>
              <div class="flex flex-wrap gap-4">
                <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-full transition-transform hover:scale-105 shadow-lg">
                  Veure cartellera
                </a>
                <a href="#" class="bg-transparent border-2 border-blue-400 hover:bg-blue-800 text-white font-semibold py-3 px-8 rounded-full transition-transform hover:scale-105 shadow-lg">
                  Comprar entrades
                </a>
              </div>
            </div>
            <div class="md:w-1/2 relative">
              <div class="w-full h-64 md:h-96 bg-blue-700 rounded-xl shadow-xl overflow-hidden relative transform hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-600/50 to-purple-900/70"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                  <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-lg hover:bg-blue-100 transition cursor-pointer">
                    <div class="ml-1 w-0 h-0 border-t-8 border-b-8 border-l-12 border-t-transparent border-b-transparent border-l-blue-700"></div>
                  </div>
                </div>
              </div>
              <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-yellow-400 rounded-full animate-bounce opacity-70"></div>
              <div class="absolute -top-4 -left-4 w-16 h-16 bg-blue-400 rounded-full animate-ping opacity-70"></div>
            </div>
          </div>
        </div>
        
        <!-- Animated background elements -->
        <div class="absolute top-20 left-10 w-8 h-8 bg-blue-400 rounded-full opacity-20 animate-float"></div>
        <div class="absolute bottom-20 right-20 w-12 h-12 bg-purple-400 rounded-full opacity-20 animate-float-delay"></div>
        <div class="absolute top-40 right-40 w-6 h-6 bg-yellow-400 rounded-full opacity-20 animate-float-delay-long"></div>
      </section>
  
      <!-- Features -->
      <section class="py-16 bg-blue-950/80">
        <div class="container mx-auto px-6">
          <h2 class="text-3xl md:text-4xl font-bold mb-12 text-center text-blue-200">
            Una experiència única de cinema
          </h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-blue-900/60 p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-transform">
              <div class="w-16 h-16 bg-blue-600 rounded-full mb-6 flex items-center justify-center">
                <span class="text-2xl">🍿</span>
              </div>
              <h3 class="text-xl font-bold mb-4">Gastronomia Premium</h3>
              <p class="text-blue-200">Gaudeix de les nostres opcions gourmet mentre veus la teva pel·lícula favorita.</p>
            </div>
            <div class="bg-blue-900/60 p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-transform">
              <div class="w-16 h-16 bg-blue-600 rounded-full mb-6 flex items-center justify-center">
                <span class="text-2xl">🎬</span>
              </div>
              <h3 class="text-xl font-bold mb-4">Sales VIP</h3>
              <p class="text-blue-200">Butaques reclinables, espai extra i servei a la butaca per una experiència de luxe.</p>
            </div>
            <div class="bg-blue-900/60 p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-transform">
              <div class="w-16 h-16 bg-blue-600 rounded-full mb-6 flex items-center justify-center">
                <span class="text-2xl">🎮</span>
              </div>
              <h3 class="text-xl font-bold mb-4">Zona d'Entreteniment</h3>
              <p class="text-blue-200">Videojocs i atraccions per a tota la família abans o després de la pel·lícula.</p>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Now Playing -->
      <section class="py-16">
        <div class="container mx-auto px-6">
          <h2 class="text-3xl md:text-4xl font-bold mb-2 text-center">En cartellera</h2>
          <p class="text-blue-300 text-center mb-12">Les millors estrenes i pel·lícules del moment</p>
          
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Movie Cards -->
            <div class="bg-blue-900/40 rounded-lg overflow-hidden shadow-lg hover:shadow-blue-500/50 transition-shadow">
              <div class="relative h-64 bg-blue-800">
                <div class="absolute inset-0 flex items-center justify-center">
                  <span class="text-4xl">🎬</span>
                </div>
                <div class="absolute top-2 right-2 bg-blue-600 text-xs px-2 py-1 rounded">ESTRENA</div>
              </div>
              <div class="p-4">
                <h3 class="font-bold text-lg mb-2">Aventures Galàctiques</h3>
                <div class="flex mb-2">
                  <div class="text-yellow-400 flex">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span class="text-blue-700">★</span>
                  </div>
                  <span class="text-xs ml-2 text-blue-300">4.0/5.0</span>
                </div>
                <p class="text-blue-200 text-sm mb-4">Ciència Ficció | 120 min</p>
                <button class="w-full bg-blue-600 hover:bg-blue-700 py-2 rounded-full transition-transform hover:scale-105">
                  Comprar entrades
                </button>
              </div>
            </div>
            
            <div class="bg-blue-900/40 rounded-lg overflow-hidden shadow-lg hover:shadow-blue-500/50 transition-shadow">
              <div class="relative h-64 bg-blue-800">
                <div class="absolute inset-0 flex items-center justify-center">
                  <span class="text-4xl">🎭</span>
                </div>
              </div>
              <div class="p-4">
                <h3 class="font-bold text-lg mb-2">Somnis d'Estiu</h3>
                <div class="flex mb-2">
                  <div class="text-yellow-400 flex">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                  </div>
                  <span class="text-xs ml-2 text-blue-300">5.0/5.0</span>
                </div>
                <p class="text-blue-200 text-sm mb-4">Drama | 105 min</p>
                <button class="w-full bg-blue-600 hover:bg-blue-700 py-2 rounded-full transition-transform hover:scale-105">
                  Comprar entrades
                </button>
              </div>
            </div>
            
            <div class="bg-blue-900/40 rounded-lg overflow-hidden shadow-lg hover:shadow-blue-500/50 transition-shadow">
              <div class="relative h-64 bg-blue-800">
                <div class="absolute inset-0 flex items-center justify-center">
                  <span class="text-4xl">🤣</span>
                </div>
              </div>
              <div class="p-4">
                <h3 class="font-bold text-lg mb-2">Comèdia Salvatge</h3>
                <div class="flex mb-2">
                  <div class="text-yellow-400 flex">
                    <span>★</span><span>★</span><span>★</span><span class="text-blue-700">★</span><span class="text-blue-700">★</span>
                  </div>
                  <span class="text-xs ml-2 text-blue-300">3.0/5.0</span>
                </div>
                <p class="text-blue-200 text-sm mb-4">Comèdia | 95 min</p>
                <button class="w-full bg-blue-600 hover:bg-blue-700 py-2 rounded-full transition-transform hover:scale-105">
                  Comprar entrades
                </button>
              </div>
            </div>
            
            <div class="bg-blue-900/40 rounded-lg overflow-hidden shadow-lg hover:shadow-blue-500/50 transition-shadow">
              <div class="relative h-64 bg-blue-800">
                <div class="absolute inset-0 flex items-center justify-center">
                  <span class="text-4xl">👻</span>
                </div>
                <div class="absolute top-2 right-2 bg-purple-600 text-xs px-2 py-1 rounded">3D</div>
              </div>
              <div class="p-4">
                <h3 class="font-bold text-lg mb-2">Misteri a la Mansió</h3>
                <div class="flex mb-2">
                  <div class="text-yellow-400 flex">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span class="text-blue-700">★</span>
                  </div>
                  <span class="text-xs ml-2 text-blue-300">4.2/5.0</span>
                </div>
                <p class="text-blue-200 text-sm mb-4">Terror | 110 min</p>
                <button class="w-full bg-blue-600 hover:bg-blue-700 py-2 rounded-full transition-transform hover:scale-105">
                  Comprar entrades
                </button>
              </div>
            </div>
          </div>
          
          <div class="text-center mt-10">
            <a href="#" class="inline-block border-2 border-blue-400 hover:bg-blue-800 text-white font-semibold py-2 px-8 rounded-full transition-transform hover:scale-105">
              Veure tota la cartellera
            </a>
          </div>
        </div>
      </section>
  
      <!-- Promo Section -->
      <section class="py-16 bg-gradient-to-b from-blue-900 to-purple-900 relative overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
          <div class="bg-blue-950/70 p-8 md:p-12 rounded-2xl shadow-2xl backdrop-blur-sm">
            <div class="md:flex items-center">
              <div class="md:w-2/3 mb-6 md:mb-0 md:pr-8">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Promoció especial de dimecres</h2>
                <p class="text-blue-200 text-lg mb-6">
                  Vine els dimecres i gaudeix de 2x1 en totes les pel·lícules! Porta un amic o familiar i la segona entrada és gratis.
                </p>
                <div class="flex gap-4">
                  <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-blue-900 font-bold py-3 px-8 rounded-full transition-transform hover:scale-105 shadow-lg">
                    Aprofita ara!
                  </a>
                </div>
              </div>
              <div class="md:w-1/3 relative">
                <div class="bg-yellow-400 p-6 rounded-xl transform rotate-3 hover:rotate-0 transition-transform">
                  <div class="text-center">
                    <span class="text-6xl text-blue-900 font-black">2x1</span>
                    <p class="text-blue-900 font-bold text-lg">TOTS ELS DIMECRES</p>
                    <p class="text-blue-900 text-sm mt-2">*Consulta condicions</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Animated elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
          <div class="absolute top-10 left-10 w-20 h-20 bg-blue-400 rounded-full opacity-10 animate-float"></div>
          <div class="absolute bottom-10 right-10 w-32 h-32 bg-purple-400 rounded-full opacity-10 animate-float-delay"></div>
          <div class="absolute top-1/2 left-1/3 w-16 h-16 bg-yellow-400 rounded-full opacity-10 animate-float-delay-long"></div>
        </div>
      </section>
  
      <!-- Newsletter -->
      <section class="py-16 bg-blue-950">
        <div class="container mx-auto px-6">
          <div class="max-w-2xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Subscriu-te a la nostra newsletter</h2>
            <p class="text-blue-300 mb-8">Rep les últimes estrenes, promocions exclusives i novetats directament al teu correu.</p>
            <div class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto">
              <input 
                type="email" 
                placeholder="El teu email" 
                class="flex-grow py-3 px-4 rounded-full bg-blue-900 border border-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
              >
              <button class="bg-blue-600 hover:bg-blue-700 py-3 px-6 rounded-full transition-transform hover:scale-105 whitespace-nowrap">
                Subscriu-me
              </button>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Footer -->
      <footer class="bg-blue-950 py-10 border-t border-blue-800">
        <div class="container mx-auto px-6">
          <div class="md:flex md:justify-between mb-8">
            <div class="mb-6 md:mb-0">
              <h3 class="text-2xl font-bold mb-2">Cinépolis Pedralbes</h3>
              <p class="text-blue-300 max-w-md">
                "Perquè cada sessió ha de ser especial, t'oferim el millor confort i qualitat per viure el cinema com mai abans."
              </p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
              <div>
                <h4 class="text-lg font-semibold mb-4">Cinema</h4>
                <ul class="space-y-2 text-blue-300">
                  <li><a href="#" class="hover:text-white transition-colors">Cartellera</a></li>
                  <li><a href="#" class="hover:text-white transition-colors">Pròximes estrenes</a></li>
                  <li><a href="#" class="hover:text-white transition-colors">Promocions</a></li>
                  <li><a href="#" class="hover:text-white transition-colors">VIP Experience</a></li>
                </ul>
              </div>
              <div>
                <h4 class="text-lg font-semibold mb-4">Informació</h4>
                <ul class="space-y-2 text-blue-300">
                  <li><a href="#" class="hover:text-white transition-colors">Sobre nosaltres</a></li>
                  <li><a href="#" class="hover:text-white transition-colors">Contacte</a></li>
                  <li><a href="#" class="hover:text-white transition-colors">Privacitat</a></li>
                  <li><a href="#" class="hover:text-white transition-colors">FAQs</a></li>
                </ul>
              </div>
              <div class="col-span-2 md:col-span-1">
                <h4 class="text-lg font-semibold mb-4">Contacte</h4>
                <ul class="space-y-2 text-blue-300">
                  <li>Avinguda Pedralbes, 123</li>
                  <li>Barcelona, 08034</li>
                  <li>Tel: 93 123 45 67</li>
                  <li>info@cinepolispedralbes.com</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="pt-8 border-t border-blue-800 flex flex-col md:flex-row justify-between items-center">
            <div class="text-blue-400 text-sm mb-4 md:mb-0">
              © 2025 Cinépolis Pedralbes. Tots els drets reservats.
            </div>
            <div class="flex space-x-6">
              <a href="#" class="text-blue-400 hover:text-white transition-colors">
                <span class="sr-only">Facebook</span>
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                </svg>
              </a>
              <a href="#" class="text-blue-400 hover:text-white transition-colors">
                <span class="sr-only">Instagram</span>
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                </svg>
              </a>
              <a href="#" class="text-blue-400 hover:text-white transition-colors">
                <span class="sr-only">Twitter</span>
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </template>
  
  <script setup>
  // En una aplicación Nuxt real, aquí iría la lógica de Vue 3 si fuera necesaria
  </script>
  
  <style>
  /* Animaciones personalizadas que se pueden añadir para complementar Tailwind */
  @keyframes float {
    0%, 100% {
      transform: translateY(0);
    }
    50% {
      transform: translateY(-15px);
    }
  }
  @keyframes float-delay {
    0%, 100% {
      transform: translateY(0);
    }
    50% {
      transform: translateY(-15px);
    }
  }
  @keyframes float-delay-long {
    0%, 100% {
      transform: translateY(0);
    }
    50% {
      transform: translateY(-15px);
    }
  }
  
  .animate-float {
    animation: float 5s ease-in-out infinite;
  }
  .animate-float-delay {
    animation: float-delay 7s ease-in-out infinite;
  }
  .animate-float-delay-long {
    animation: float-delay-long 9s ease-in-out infinite;
  }
  </style>