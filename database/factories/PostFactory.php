<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->text(50),
            'image' => 'public/posts/'.$this->faker->image('public/storage/posts',640,480,null,false),
            //'image' => $this->faker->imageUrl(640,480), // PLAN B

        ];
    }
}
