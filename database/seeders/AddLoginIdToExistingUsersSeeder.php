<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AddLoginIdToExistingUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::whereNull('login_id')->get();
        
        foreach ($users as $user) {
            $year = now()->format('Y');
            do {
                $randomDigits = rand(1000, 9999);
                $loginId = $year . $randomDigits;
            } while (User::where('login_id', $loginId)->exists());
            
            $user->login_id = $loginId;
            $user->save();
        }
        
        $this->command->info('Login IDs added to existing users successfully!');
    }
}
