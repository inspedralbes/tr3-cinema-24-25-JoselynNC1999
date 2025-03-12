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
            ['title' => 'Mickey 17', 'description' => 'Un thriller de ciencia ficción sobre clones en una misión espacial.', 'poster_url' => 'https://hips.hearstapps.com/hmg-prod/images/es-mky17-vert-main-2764x4096-intl-67c9945dd9ede.jpg', 'duration' => 130],
            ['title' => 'Looney Tunes: El día que la tierra explotó', 'description' => 'Bugs Bunny y sus amigos enfrentan un desastre cósmico.', 'poster_url' => 'https://www.cinesur.com/data/fotos/el-dia-que-la-tierra-exploto-104344.jpg', 'duration' => 95],
            ['title' => 'Avengers: Endgame', 'description' => 'Un épico final para los Vengadores.', 'poster_url' => 'https://image.tmdb.org/t/p/w500/q6725aR8Zs4IwGMXzZT8aC8lh41.jpg', 'duration' => 181],
            ['title' => 'The Dark Knight', 'description' => 'Batman enfrenta al Joker en una batalla psicológica.', 'poster_url' => 'https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg', 'duration' => 152],
            ['title' => 'Inception', 'description' => 'Un thriller de ciencia ficción sobre los sueños.', 'poster_url' => 'https://image.tmdb.org/t/p/w500/edv5CZvWj09upOsy2Y6IwDhK8bt.jpg', 'duration' => 148],
            ['title' => 'Interstellar', 'description' => 'Un viaje interestelar en busca de un nuevo hogar.', 'poster_url' => 'https://image.tmdb.org/t/p/w500/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg', 'duration' => 169],
            ['title' => 'Joker', 'description' => 'La transformación de un hombre en el villano más icónico.', 'poster_url' => 'https://image.tmdb.org/t/p/w500/udDclJoHjfjb8Ekgsd4FDteOkCU.jpg', 'duration' => 122],
            ['title' => 'Parasite', 'description' => 'Una historia sobre la lucha de clases y la supervivencia.', 'poster_url' => 'https://image.tmdb.org/t/p/w500/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg', 'duration' => 132],
            ['title' => 'Toy Story', 'description' => 'Los juguetes cobran vida cuando los humanos no están.', 'poster_url' => 'https://image.tmdb.org/t/p/w500/uXDfjJbdP4ijW5hWSBrPrlKpxab.jpg', 'duration' => 81],
            ['title' => 'Gladiator', 'description' => 'Un general romano busca venganza contra un emperador corrupto.', 'poster_url' => 'https://image.tmdb.org/t/p/w500/ty8TGRuvJLPUmAR1H1nRIsgwvim.jpg', 'duration' => 155],
        ];

        foreach ($movies as $movie) {
            Movie::create($movie);
        }
    }
}
