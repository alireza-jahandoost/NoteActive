<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $CatCnt = Category::count();
        return [
            'title' => $this->faker->sentence,
            'category_id' => rand(1,$CatCnt),
            'post_image' => 'https://picsum.photos/750/350?random='.rand(1,55000),
            'body' => implode("\n",$this->faker->paragraphs(5)),
            'created_at' => $this->faker->dateTimeBetween('-1year','now'),
        ];
    }
}
