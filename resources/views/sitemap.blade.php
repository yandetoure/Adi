<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <!-- Page d'accueil -->
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toISOString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    
    <!-- Page produits -->
    <url>
        <loc>{{ url('/products') }}</loc>
        <lastmod>{{ now()->toISOString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    
    <!-- Page catégories -->
    <url>
        <loc>{{ url('/categories') }}</loc>
        <lastmod>{{ now()->toISOString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    
    <!-- Produits individuels -->
    @foreach($products as $product)
        <url>
            <loc>{{ url('/products/' . $product->slug) }}</loc>
            <lastmod>{{ $product->updated_at->toISOString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach
    
    <!-- Catégories individuelles -->
    @foreach($categories as $category)
        <url>
            <loc>{{ url('/categories/' . $category->slug) }}</loc>
            <lastmod>{{ $category->updated_at->toISOString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset> 