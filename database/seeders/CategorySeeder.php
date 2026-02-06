<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            '#A855F7',
            '#3B82F6',
            '#22C55E',
            '#F97316',
            '#EAB308',
            '#6366F1',
            '#14B8a6',
            '#EC4899',
            '#8B5CF6',
            '#0EA5E9',
            '#D946EF',
            '#06B6D4',
        ];

        $icons = [
            'music',
            'computer',
            'football',
            'palette',
            'restaurant',
            'briefcase',
            'book',
            'heart',
            'movie',
            'plane',
            'shirt',
            'gamepad',
        ];

        $names = [
            'Music & Concerts',
            'Technology',
            'Sports & Fitness',
            'Art & Culture',
            'Food & Drink',
            'Business & Networking',
            'Education & Learning',
            'Health & Wellness',
            'Entertainment',
            'Travel & Adventure',
            'Fashion & Beauty',
            'Gaming & ESports',
        ];

        for($i = 0; $i < count($colors); $i++) {
            Category::create([
                'name' => $names[$i],
                'slug' => Str::slug($names[$i]),
                'icon' => $icons[$i],
                'color' => $colors[$i],
            ]);
        }
    }
}
