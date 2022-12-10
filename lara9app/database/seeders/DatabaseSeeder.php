<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
          //   \App\Models\Parkslot::factory(5)->create();
          $letters=range('A','Z');
          foreach($letters as $l){
             \App\Models\Parkslot::factory()
                ->count(5)
                ->sequence(fn ($sequence) => ['name' => str_pad($l,2,"0").$sequence->index+1])
                ->create();
          }


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
