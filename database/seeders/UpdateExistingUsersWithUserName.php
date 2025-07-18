<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UpdateExistingUsersWithUserName extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Updating existing users with user_name...');
        
        // تحديث جميع المستخدمين الموجودين
        $users = User::whereNull('user_name')->orWhere('user_name', '')->get();
        
        if ($users->isEmpty()) {
            $this->command->info('No users found without user_name.');
            return;
        }
        
        $this->command->info('Found ' . $users->count() . ' users without user_name.');
        
        foreach ($users as $user) {
            $userName = $this->generateUniqueUserName($user);
            $user->user_name = $userName;
            $user->save();
            
            $this->command->info("Updated user {$user->name} with user_name: {$userName}");
        }
        
        $this->command->info('Successfully updated ' . $users->count() . ' users with user_name.');
    }
    
    /**
     * Generate a unique user_name for the given user
     */
    private function generateUniqueUserName($user)
    {
        // إذا كان لديه login_id، استخدمه كأساس
        if ($user->login_id) {
            $baseName = $user->login_id;
        } else {
            // استخدم الاسم كأساس
            $baseName = Str::slug($user->name, '');
        }
        
        // إزالة الأحرف الخاصة والمسافات
        $baseName = preg_replace('/[^a-zA-Z0-9]/', '', $baseName);
        
        // إذا كان الاسم فارغاً، استخدم user_ + ID
        if (empty($baseName)) {
            $baseName = 'user_' . $user->id;
        }
        
        // التحقق من التفرد
        $userName = $baseName;
        $counter = 1;
        
        while (User::where('user_name', $userName)->where('id', '!=', $user->id)->exists()) {
            $userName = $baseName . '_' . $counter;
            $counter++;
        }
        
        return $userName;
    }
}
