<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contacto;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contacto>
 */
class ContactoFactory extends Factory
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
            'nombre'=>fake()->firstname(),
            'apellido'=>fake()->lastname(),
            'correo_electronico'=>fake()->Email(),
            'telefono'=>fake()->phoneNumber()

        ];
    }
}
