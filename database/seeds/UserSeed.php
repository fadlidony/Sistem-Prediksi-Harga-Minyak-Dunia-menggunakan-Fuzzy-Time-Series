<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate(['name' => 'Kiblon', 'email' => 'fadlidonypradana@gmail.com'],['password' => Hash::make('123456')]);
    }
}
