<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            ['title' => 'Barbie', 'description' => 'La icónica muñeca cobra vida en una aventura mágica.', 'poster_url' => 'https://image.tmdb.org/t/p/w500/iuFNMS8U5cb6xfzi51Dbkovj7vM.jpg', 'duration' => 114],
            ['title' => 'Dune: Part One', 'description' => 'Un joven noble enfrenta su destino en un planeta desértico.', 'poster_url' => 'https://image.tmdb.org/t/p/w500/d5NXSklXo0qyIYkgV94XAgMIckC.jpg', 'duration' => 155],
            ['title' => 'Mickey 17', 'description' => 'Un thriller de ciencia ficción sobre clones en una misión espacial.', 'poster_url' => 'https://hips.hearstapps.com/hmg-prod/images/es-mky17-vert-main-2764x4096-intl-67c9945dd9ede.jpg', 'duration' => 130],
            ['title' => 'Avengers: Endgame', 'description' => 'Un épico final para los Vengadores.', 'poster_url' => 'https://image.tmdb.org/t/p/w500/q6725aR8Zs4IwGMXzZT8aC8lh41.jpg', 'duration' => 181],
            ['title' => 'The Dark Knight', 'description' => 'Batman enfrenta al Joker en una batalla psicológica.', 'poster_url' => 'https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg', 'duration' => 152],
            ['title' => 'Inception', 'description' => 'Un thriller de ciencia ficción sobre los sueños.', 'poster_url' => 'https://image.tmdb.org/t/p/w500/edv5CZvWj09upOsy2Y6IwDhK8bt.jpg', 'duration' => 148],
            ['title' => 'Interstellar', 'description' => 'Un viaje interestelar en busca de un nuevo hogar.', 'poster_url' => 'https://image.tmdb.org/t/p/w500/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg', 'duration' => 169],
            ['title' => 'Joker', 'description' => 'La transformación de un hombre en el villano más icónico.', 'poster_url' => 'https://image.tmdb.org/t/p/w500/udDclJoHjfjb8Ekgsd4FDteOkCU.jpg', 'duration' => 122],
            ['title' => 'Parasite', 'description' => 'Una historia sobre la lucha de clases y la supervivencia.', 'poster_url' => 'https://image.tmdb.org/t/p/w500/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg', 'duration' => 132],
            ['title' => 'Toy Story', 'description' => 'Los juguetes cobran vida cuando los humanos no están.', 'poster_url' => 'https://image.tmdb.org/t/p/w500/uXDfjJbdP4ijW5hWSBrPrlKpxab.jpg', 'duration' => 81],
            ['title' => 'The Matrix', 'description' => 'Un hacker descubre la impactante verdad sobre su realidad.', 'poster_url' => 'https://image.tmdb.org/t/p/w500/f89U3ADr1oiB1s9GkdPOEpXUk5H.jpg', 'duration' => 136],
            ['title' => 'Forrest Gump', 'description' => 'Un hombre con una vida extraordinaria cuenta su historia.', 'poster_url' => 'https://image.tmdb.org/t/p/w500/saHP97rTPS5eLmrLQEcANmKrsFl.jpg', 'duration' => 142],

        ];

        foreach ($movies as $movie) {
            Movie::create($movie);
        }
    }
}
