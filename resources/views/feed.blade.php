{!! '<'.'?xml version="1.0" encoding="UTF-8"?'.'>' !!}
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<title>School House Consult Education Insights</title>
<link>{{ route('resources.index') }}</link>
<description>{{ config('site.mission') }}</description>
<language>en-NG</language>
<atom:link href="{{ route('feed') }}" rel="self" type="application/rss+xml" />
@foreach($articles as $article)<item>
<title>{{ $article->title }}</title>
<link>{{ route('resources.show', $article) }}</link>
<guid isPermaLink="true">{{ route('resources.show', $article) }}</guid>
<description>{{ $article->excerpt }}</description>
<pubDate>{{ $article->published_at->toRssString() }}</pubDate>
</item>
@endforeach</channel>
</rss>
