<x-page-hero eyebrow="Case study" :title="$record->title" :text="$record->summary" />
<section class="section">
<article class="container article-body prose">
<a class="text-link back-link" href="{{ route('case-studies.index') }}">← All case studies</a>
@if($record->client_name)<p class="eyebrow">{{ $record->client_name }}</p>
@endif @if($record->featured_image)<img class="detail-image" src="{{ asset($record->featured_image) }}" alt="{{ $record->title }}">
@endif @foreach(['challenge'=>'The challenge', 'approach'=>'Our approach', 'outcome'=>'The outcome'] as $field=>$heading)<h2>{{ $heading }}</h2>
<div class="plain-content">{{ $record->$field }}</div>
@endforeach</article>
</section>
<x-cta />
