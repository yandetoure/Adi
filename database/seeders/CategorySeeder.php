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
                'name' => 'Électronique',
                'description' => 'Produits électroniques et gadgets',
                'meta_title' => 'Électronique - ADI Store',
                'meta_description' => 'Découvrez notre sélection de produits électroniques de qualité',
                'meta_keywords' => 'électronique, gadgets, technologie, ADI',
            ],
            [
                'name' => 'Vêtements',
                'description' => 'Mode et vêtements pour tous',
                'meta_title' => 'Vêtements - ADI Store',
                'meta_description' => 'Trouvez votre style avec notre collection de vêtements',
                'meta_keywords' => 'vêtements, mode, style, ADI',
            ],
            [
                'name' => 'Maison & Jardin',
                'description' => 'Articles pour la maison et le jardin',
                'meta_title' => 'Maison & Jardin - ADI Store',
                'meta_description' => 'Aménagez votre intérieur et extérieur avec nos produits',
                'meta_keywords' => 'maison, jardin, décoration, ADI',
            ],
            [
                'name' => 'Sport & Loisirs',
                'description' => 'Équipements sportifs et loisirs',
                'meta_title' => 'Sport & Loisirs - ADI Store',
                'meta_description' => 'Pratiquez vos activités favorites avec notre équipement',
                'meta_keywords' => 'sport, loisirs, équipement, ADI',
            ],
            [
                'name' => 'Livres & Médias',
                'description' => 'Livres, films et médias',
                'meta_title' => 'Livres & Médias - ADI Store',
                'meta_description' => 'Explorez notre collection de livres et médias',
                'meta_keywords' => 'livres, médias, films, ADI',
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
