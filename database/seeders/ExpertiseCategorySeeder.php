<?php

namespace Database\Seeders;

use App\Models\ExpertiseCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ExpertiseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Orientation & everyday life in Germany',
                'name_de' => 'Orientierung & Alltag in Deutschland',
                'description' => 'Help with settling in Germany, understanding the culture, and navigating daily life',
                'sort_order' => 1,
            ],
            [
                'name' => 'Language & Communication',
                'name_de' => 'Sprache & Kommunikation',
                'description' => 'German language learning, communication skills, and language practice',
                'sort_order' => 2,
            ],
            [
                'name' => 'Education & Work',
                'name_de' => 'Arbeit (IT, Lager, Handwerk, Analytics, Ausbildung etc)',
                'description' => 'Career guidance including IT, logistics, crafts, analytics, vocational training',
                'sort_order' => 3,
            ],
            [
                'name' => 'Administrative Procedures & Rights',
                'name_de' => 'Behördengänge & Rechte',
                'description' => 'Assistance with government offices, paperwork, and understanding legal rights',
                'sort_order' => 4,
            ],
            [
                'name' => 'Housing & Mobility',
                'name_de' => 'Wohnen & Mobilität',
                'description' => 'Finding housing, understanding rental contracts, and transportation systems',
                'sort_order' => 5,
            ],
            [
                'name' => 'Social Integration & Network',
                'name_de' => 'Soziale Integration & Netzwerk',
                'description' => 'Building social connections, finding communities, and integration support',
                'sort_order' => 6,
            ],
            [
                'name' => 'Healthcare',
                'name_de' => 'Gesundheitsversorgung',
                'description' => 'Understanding the German healthcare system, insurance, and medical services',
                'sort_order' => 7,
            ],
            [
                'name' => 'Instrument',
                'name_de' => 'Instrument (Piano, Klavier, Gitarre etc)',
                'description' => 'Learning musical instruments including piano, guitar, and others',
                'sort_order' => 8,
            ],
        ];

        foreach ($categories as $category) {
            ExpertiseCategory::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'name_de' => $category['name_de'] ?? null,
                    'description' => $category['description'],
                    'sort_order' => $category['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
