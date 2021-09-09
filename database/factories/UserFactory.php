<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $firstName = $this->faker->unique()->firstName;
        $lastName = $this->faker->unique()->lastName;    
        
        return [ 
            'email' => $this->faker->unique()->safeEmail,
            'username' => $firstName.$lastName,
            'fname' => $firstName,
            'lname' => $lastName,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role_ID' => rand(1,2),
            'created_at' => now(),
        ];
    }
}
