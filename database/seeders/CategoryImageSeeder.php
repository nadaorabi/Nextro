<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryImages = [
            '9th Grade Scientific' => 'categories/scientific.jpg',
            'Secondary Literary' => 'categories/literary.jpg',
            'Business Administration' => 'categories/business.jpg',
            'Programming' => 'categories/programming.jpg',
            'Chess' => 'categories/chess.jpg',
            'Conversation' => 'categories/conversation.jpg',
            'Languages' => 'categories/languages.jpg',
        ];

        foreach ($categoryImages as $categoryName => $imagePath) {
            $category = Category::where('name', $categoryName)->first();
            if ($category) {
                $category->update(['image' => $imagePath]);
                $this->command->info("Updated image for category: {$categoryName}");
            }
        }
    }
} 