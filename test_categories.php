<?php declare(strict_types=1); 

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Test de correspondance des catégories:\n";

$categories = App\Models\Category::all();
foreach ($categories as $cat) {
    echo "ID: {$cat->id}, Nom: '{$cat->name}'\n";
}

echo "\nTest de recherche:\n";
$testName = "Cartouches d'encre & Toners";
$found = App\Models\Category::where('name', $testName)->first();
echo "Recherche pour '$testName': " . ($found ? "Trouvé ID {$found->id}" : "Non trouvé") . "\n";

// Test avec l'apostrophe courbe exacte
$testName2 = "Cartouches d'encre & Toners";
$found2 = App\Models\Category::where('name', $testName2)->first();
echo "Recherche pour '$testName2': " . ($found2 ? "Trouvé ID {$found2->id}" : "Non trouvé") . "\n";

// Test direct avec l'ID 3
$cat3 = App\Models\Category::find(3);
echo "Catégorie ID 3: " . ($cat3 ? $cat3->name : "Non trouvée") . "\n"; 