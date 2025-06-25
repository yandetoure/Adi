<?php declare(strict_types=1); 

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Imprimantes',
                'description' => 'Imprimantes jet d’encre, laser, multifonctions et professionnelles.',
                'meta_title' => 'Imprimantes - ADI Store',
                'meta_description' => 'Découvrez notre sélection d’imprimantes pour tous les besoins professionnels et personnels.',
                'meta_keywords' => 'imprimante, laser, jet d’encre, multifonction, ADI',
            ],
            [
                'name' => 'Écrans',
                'description' => 'Moniteurs et écrans de toutes tailles pour le bureau ou la maison.',
                'meta_title' => 'Écrans - ADI Store',
                'meta_description' => 'Écrans et moniteurs haute résolution pour un affichage optimal.',
                'meta_keywords' => 'écran, moniteur, affichage, ADI',
            ],
            [
                'name' => "Cartouches d’encre & Toners",
                'description' => 'Cartouches d’encre, toners et consommables pour imprimantes.',
                'meta_title' => 'Cartouches & Toners - ADI Store',
                'meta_description' => 'Cartouches d’encre et toners pour toutes marques d’imprimantes.',
                'meta_keywords' => 'cartouche, toner, encre, imprimante, ADI',
            ],
            [
                'name' => 'Ordinateurs',
                'description' => 'Ordinateurs portables, de bureau et stations de travail.',
                'meta_title' => 'Ordinateurs - ADI Store',
                'meta_description' => 'Ordinateurs performants pour tous les usages.',
                'meta_keywords' => 'ordinateur, portable, bureau, PC, ADI',
            ],
            [
                'name' => 'Accessoires',
                'description' => 'Clés USB, disques durs, accessoires informatiques.',
                'meta_title' => 'Accessoires - ADI Store',
                'meta_description' => 'Accessoires et périphériques pour compléter votre équipement.',
                'meta_keywords' => 'accessoire, clé USB, disque dur, ADI',
            ],
            [
                'name' => 'Scanners',
                'description' => 'Scanners de documents et de photos.',
                'meta_title' => 'Scanners - ADI Store',
                'meta_description' => 'Scanners professionnels et domestiques.',
                'meta_keywords' => 'scanner, numérisation, ADI',
            ],
            [
                'name' => 'Photocopieurs',
                'description' => 'Photocopieurs multifonctions pour entreprises et particuliers.',
                'meta_title' => 'Photocopieurs - ADI Store',
                'meta_description' => 'Photocopieurs performants pour tous les besoins.',
                'meta_keywords' => 'photocopieur, copie, multifonction, ADI',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'meta_title' => $category['meta_title'],
                'meta_description' => $category['meta_description'],
                'meta_keywords' => $category['meta_keywords'],
                'is_active' => true,
                'order' => 0,
            ]);
        }
    }
}
