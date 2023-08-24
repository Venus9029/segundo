<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Evento;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evento>
 */
class EventoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'titulo'=>fake()->word(),
            'descripcion'=>fake()->text(),
            'fecha_inicio'=>fake()->datetime(),
            'fecha_fin'=>fake()->datetime(),
            'contacto_id'=>fake()->numberBetween(0,100)
            
        ];
    }
}
