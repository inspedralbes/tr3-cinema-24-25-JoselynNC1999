<?php
namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    protected $model = Movie::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,  // Títol de la pel·lícula
            'description' => $this->faker->paragraph,  // Descripció de la pel·lícula
            'release_date' => $this->faker->date,  // Data de llançament
            'duration' => $this->faker->numberBetween(60, 180),  // Duració en minuts
            'genre' => $this->faker->word,  // Gènere de la pel·lícula
            'rating' => $this->faker->randomFloat(1, 1, 5),  // Valoració (1 a 5)
        ];
    }
}
