<?php

namespace Database\Factories;

use App\Models\ListModel;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ListModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name(),
            'title'=>$this->faker->title,
            'email'=>$this->faker->email,
            'count'=>rand(10,99)
        ];
    }
}
