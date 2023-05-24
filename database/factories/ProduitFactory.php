<?php

namespace Database\Factories;
use App\Produit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

     protected $model = Produit::class;
 
    public function definition()
    {
        return [
            'nom' => $this->faker->nom(),
            'description' => $this->faker->description(),
            'nom_englais' => $this->faker->nom_englais(),
            'description_anglais' => $this->faker->description_anglais(),
            'Prix' => $this->faker->Prix(),
            'Prix_euro' => $this->faker->Prix_euro(),
            'Prix_dollar' => $this->faker->Prix_dollar(),
            'Qte' => $this->faker->Qte(),
            'Photo_principale' => $this->faker->Photo_principale()
        ];
    }
}
