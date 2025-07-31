<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index()
    {
        $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Page d'accueil
        $content .= $this->addUrl(route('home'), '1.0', 'daily');

        // Page produits
        $content .= $this->addUrl(route('products.index'), '0.9', 'daily');

        // Page catégories
        $content .= $this->addUrl(route('categories.index'), '0.8', 'weekly');

        // Catégories individuelles
        $categories = Category::where('is_active', true)->get();
        foreach ($categories as $category) {
            $content .= $this->addUrl(route('categories.show', $category), '0.7', 'weekly');
        }

        // Produits individuels
        $products = Product::where('is_active', true)->get();
        foreach ($products as $product) {
            $content .= $this->addUrl(route('products.show', $product), '0.8', 'weekly');
        }

        $content .= '</urlset>';

        return response($content, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }

    private function addUrl($url, $priority, $changefreq)
    {
        return "  <url>\n" .
               "    <loc>" . htmlspecialchars($url) . "</loc>\n" .
               "    <lastmod>" . date('Y-m-d') . "</lastmod>\n" .
               "    <changefreq>" . $changefreq . "</changefreq>\n" .
               "    <priority>" . $priority . "</priority>\n" .
               "  </url>\n";
    }
}
