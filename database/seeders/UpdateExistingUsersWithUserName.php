<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UpdateExistingUsersWithUserName extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // تحديث جميع المستخدمين الموجودين
        $users = User::whereNull('user_name')->get();
        
        foreach ($users as $user) {
            // إذا كان لديه login_id، استخدمه كـ user_name
            if ($user->login_id) {
                $user->user_name = $user->login_id;
            } else {
                // إذا لم يكن لديه login_id، أنشئ user_name فريد
                $userName = 'user_' . $user->id . '_' . time();
                $user->user_name = $userName;
            }
            
            $user->save();
        }
        
        $this->command->info('Updated ' . $users->count() . ' users with user_name.');
    }
}
