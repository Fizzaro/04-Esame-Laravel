<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Serie>
 */
class SerieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "idCategoria" => $this->faker->numberBetween(1, 10),
            "titolo" => $this->faker->sentence(4),
            "descrizione" => $this->faker->sentence(15),
            "regista" => $this->faker->sentence(2),
            "produttore" => $this->faker->sentence(2),
            "attori" => $this->faker->sentence(10),
            "annoUscita" => $this->faker->sentence(1),
            "annoFine" => $this->faker->sentence(1),
            "totStagioni" => $this->faker->numerify('##'),
            "totEpisodi" => $this->faker->numerify('##'),
            "idLocandina" => $this->faker->numerify(),
            "idTrailer" => $this->faker->numerify()
        ];
    }
}
