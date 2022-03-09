<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user=  User::create([ 
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'), //remember! the password is passowrd by defult 
            'is_admin'  =>1
          ]);


          DB::table('profiles')->insert([
            'avatar' => 'avatars/defult_user.png',
            'about' =>  'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugiat, dignissimos quisquam molestiae consequuntur dicta eveniet voluptate incidunt quo ullam cupiditate, odit natus ducimus ad, aut totam deserunt illum repellendus? Quidem.',
            'user_id' => $user->id,
        ]);
    }
}
