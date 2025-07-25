<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UpdateTeachersExperienceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('🔄 Updating experience status for existing teachers...');
        
        $teachers = User::where('role', 'teacher')->get();
        
        foreach ($teachers as $teacher) {
            if (!isset($teacher->is_experienced)) {
                $teacher->is_experienced = false;
                $teacher->save();
            }
        }
        
        $this->command->info('✅ Experience status updated for all teachers successfully!');
        $this->command->info('📊 Statistics:');
        $this->command->info('   - Total Teachers: ' . $teachers->count());
        $this->command->info('   - Experienced Teachers: ' . $teachers->where('is_experienced', true)->count());
        $this->command->info('   - Not Experienced Teachers: ' . $teachers->where('is_experienced', false)->count());
    }
}
