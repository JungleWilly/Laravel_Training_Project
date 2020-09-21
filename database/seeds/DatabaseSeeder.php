<?php

use App\User;
use App\Topicality;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // run the different factory to fill out the DB

        $user= factory(User::class)->create();
        
        

        factory(Topicality::class, 5)->create([
            'user_id' => $user->id,
        ]);

    
        $user2= factory(User::class)->create([
            'api_token' => '67891',
        ]);
        
        

        factory(Topicality::class, 5)->create([
            'user_id' => $user2->id,
        ]);

    
    }
}
