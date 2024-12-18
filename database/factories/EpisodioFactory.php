<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Episodio>
 */
class EpisodioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "idSerie" => $this->faker->numberBetween(1, 180),
            "titolo" => $this->faker->sentence(4),
            "descrizione" => $this->faker->sentence(15),
            "durata" => $this->faker->numerify(),
            "annoUscita" => $this->faker->sentence(1),
            "numStagione" => $this->faker->numerify('##'),
            "numEpisodio" => $this->faker->numerify('##'),
            "idVideo" => $this->faker->numerify()
        ];
    }
}
