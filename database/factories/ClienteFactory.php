<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\TipoCliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'identificacion' => $this->faker->randomNumber(),
            'nombre'=> $this->faker->name,
            'direccion'=> $this->faker->text(40),
            'telefono' => $this->faker->randomNumber(),
            'correo' => $this->faker->unique()->safeEmail,
            'tipo_cliente_id'=> TipoCliente::all()->random()->id
        ];
    }
}
