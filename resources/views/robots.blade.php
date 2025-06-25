User-agent: *
Allow: /

# Sitemap
Sitemap: {{ url('/sitemap.xml') }}

# Disallow admin and assistant areas
Disallow: /admin/
Disallow: /assistant/
Disallow: /login
Disallow: /register
Disallow: /password/
Disallow: /email/

# Allow important pages
Allow: /products
Allow: /categories
Allow: /cart

# Crawl delay (optional) 