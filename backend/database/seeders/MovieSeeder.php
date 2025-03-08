<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ['title' => 'Avengers: Endgame', 'description' => 'A superhero action movie', 'poster_url' => 'url_to_poster_1', 'duration' => 181],
            ['title' => 'The Dark Knight', 'description' => 'Batman facing the Joker', 'poster_url' => 'url_to_poster_2', 'duration' => 152],
            ['title' => 'Inception', 'description' => 'A mind-bending sci-fi thriller', 'poster_url' => 'url_to_poster_3', 'duration' => 148],
            ['title' => 'Interstellar', 'description' => 'A journey through space and time', 'poster_url' => 'url_to_poster_4', 'duration' => 169],
            ['title' => 'Titanic', 'description' => 'A love story aboard the ill-fated Titanic', 'poster_url' => 'url_to_poster_5', 'duration' => 195],
            ['title' => 'The Lion King', 'description' => 'A young lion prince overcomes adversity', 'poster_url' => 'url_to_poster_6', 'duration' => 88],
            ['title' => 'Joker', 'description' => 'A deep dive into the psyche of a man who becomes a villain', 'poster_url' => 'url_to_poster_7', 'duration' => 122],
            ['title' => 'Parasite', 'description' => 'A thriller about class disparity', 'poster_url' => 'url_to_poster_8', 'duration' => 132],
            ['title' => 'Toy Story', 'description' => 'Toys that come to life when humans are not around', 'poster_url' => 'url_to_poster_9', 'duration' => 81],
            ['title' => 'Gladiator', 'description' => 'A roman general seeks revenge in ancient Rome', 'poster_url' => 'url_to_poster_10', 'duration' => 155],
        ];

        foreach ($movies as $movie) {
            Movie::create($movie);
        }
    }
}