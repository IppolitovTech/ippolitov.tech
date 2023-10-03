@php
echo '<?xml version="1.0" encoding="UTF-8" ?>';
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($entries as $entry)
        <url>
            <loc>{{ url($entry->link) }}</loc>
            <lastmod>{{ $entry->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        </url>
    @endforeach
</urlset>
