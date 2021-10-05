<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Channel;
use Illuminate\Support\Str;


class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

  Channel::create([

'name'=>'laravel 7',
'slug'=>str::slug('laravel 7','-')

        ]);
  Channel::create([

'name'=>'vue js 2',
'slug'=>str::slug('vue js 2','-')

        ]);
  Channel::create([

'name'=>'angular 4',
'slug'=>str::slug('angular 4','-')

        ]);
    }
}
