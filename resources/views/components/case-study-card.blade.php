@props(['caseStudy'])<article class="content-card">
@if($caseStudy->featured_image)<img class="card-image" src="{{ asset($caseStudy->featured_image) }}" alt="" width="640" height="400" loading="lazy">
@endif<div class="card-body">
<p class="eyebrow">Case study</p>
<h3>{{ $caseStudy->title }}</h3>
<p>{{ $caseStudy->summary }}</p>
<a class="text-link" href="{{ route('case-studies.show', $caseStudy) }}">Read case study <span aria-hidden="true">↗</span>
</a>
</div>
</article>
