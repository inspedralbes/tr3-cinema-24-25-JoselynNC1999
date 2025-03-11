<template>
    <section class="py-6 bg-blue-950/80">
      <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
          <div class="flex items-center gap-4 w-full md:w-auto">
            <span class="text-blue-300 font-semibold">Filtrar per:</span>
            <select class="bg-blue-900 border border-blue-700 text-white rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
              <option value="tots">Totes les pel·lícules</option>
              <option value="estrenes">Estrenes</option>
              <option value="vip">Sales VIP</option>
              <option value="3d">Pel·lícules 3D</option>
              <option value="vo">V.O. Subtitulada</option>
            </select>
          </div>
          <div class="flex items-center gap-4 w-full md:w-auto">
            <span class="text-blue-300 font-semibold">Gènere:</span>
            <select class="bg-blue-900 border border-blue-700 text-white rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
              <option value="tots">Tots els gèneres</option>
              <option value="accio">Acció</option>
              <option value="aventura">Aventura</option>
              <option value="ciencia-ficcio">Ciència Ficció</option>
              <option value="comedia">Comèdia</option>
              <option value="drama">Drama</option>
              <option value="terror">Terror</option>
              <option value="animacio">Animació</option>
            </select>
          </div>
          <div class="flex items-center gap-4 w-full md:w-auto mt-4 md:mt-0">
            <input
              type="text"
              placeholder="Cerca pel·lícules..."
              class="bg-blue-900 border border-blue-700 text-white rounded-full px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
          </div>
        </div>
      </div>
    </section>
  </template>