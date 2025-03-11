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
            ['title' => 'Avengers: Endgame', 'description' => 'A superhero action movie', 'poster_url' => 'https://m.media-amazon.com/images/I/91HrMmvyEUL.jpg', 'duration' => 181],
            ['title' => 'The Dark Knight', 'description' => 'Batman facing the Joker', 'poster_url' => 'https://m.media-amazon.com/images/I/71p8G+eKfTL._AC_SY679_.jpg', 'duration' => 152],
            ['title' => 'Inception', 'description' => 'A mind-bending sci-fi thriller', 'poster_url' => 'https://m.media-amazon.com/images/I/51XB1aCspqL._AC_.jpg', 'duration' => 148],
            ['title' => 'Interstellar', 'description' => 'A journey through space and time', 'poster_url' => 'https://m.media-amazon.com/images/I/91kFYg4fX3L._AC_SY679_.jpg', 'duration' => 169],
            ['title' => 'Titanic', 'description' => 'A love story aboard the ill-fated Titanic', 'poster_url' => 'https://m.media-amazon.com/images/I/81KkrQWEHIL._AC_SY679_.jpg', 'duration' => 195],
            ['title' => 'The Lion King', 'description' => 'A young lion prince overcomes adversity', 'poster_url' => 'https://m.media-amazon.com/images/I/81mrVjsWuML._AC_SY679_.jpg', 'duration' => 88],
            ['title' => 'Joker', 'description' => 'A deep dive into the psyche of a man who becomes a villain', 'poster_url' => 'https://m.media-amazon.com/images/I/71WPBQ8d5xL._AC_SY679_.jpg', 'duration' => 122],
            ['title' => 'Parasite', 'description' => 'A thriller about class disparity', 'poster_url' => 'https://m.media-amazon.com/images/I/71cZayBVo3L._AC_SY679_.jpg', 'duration' => 132],
            ['title' => 'Toy Story', 'description' => 'Toys that come to life when humans are not around', 'poster_url' => 'https://m.media-amazon.com/images/I/71aBLaC4TzL._AC_SY679_.jpg', 'duration' => 81],
            ['title' => 'Gladiator', 'description' => 'A Roman general seeks revenge in ancient Rome', 'poster_url' => 'https://m.media-amazon.com/images/I/71-Sx5vZjzL._AC_SY679_.jpg', 'duration' => 155],
        ];

        foreach ($movies as $movie) {
            Movie::create($movie);
        }
    }
}
