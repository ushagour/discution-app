<?php

namespace Database\Factories;

use App\Models\Discussion;
use App\Models\Channel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DiscussionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     */
    protected $model = Discussion::class;

    public function definition()
    {
     
    $channel_id =  Channel::all()->pluck('id');
    $user_id =  User::all()->pluck('id');

return [
            'title'=> $this->faker->text($maxNbChars = 200) ,
            'content'=> $this->faker->paragraph(),
            'slug'=> str::slug($this->faker->title()),
            'channel_id' => $this->faker->randomElement($channel_id),
            'created_at' =>now(),
            'user_id' =>$this->faker->randomElement($user_id)
];

    }
}
