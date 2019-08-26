<?php

use Illuminate\Database\Seeder;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $team = Role::whereId(4)->firstOrFail();

        factory(App\User::class, 100)->create();


        App\User::where('id' , '>' , '418')->each(function ($user) use ($team) { 
            $user->roles()->attach($team->id); 
        });
        
    }
}
