<x-page-hero eyebrow="Programs & Training" title="Make room for professional growth." text="Professional development across teaching, leadership, curriculum and educational technology." />
<section class="section">
<div class="container">
<x-section-heading eyebrow="Learning areas" title="What would you like to develop?" text="These are areas for training conversations. Contact us to discuss your team's needs and available options." />
<div class="learning-feature">
<x-editorial-image name="professional-learning" alt="Conceptual illustration of adults taking part in professional learning." caption="Professional learning, illustrated." />
<div><x-training-categories /></div>
</div>
<div class="section-divider">
</div>
<x-section-heading eyebrow="Programs" title="Explore available programs" />
@if($programs->isEmpty())<x-empty-state title="Program details are coming soon" text="Confirmed programs will be listed here. To discuss teacher development, school leadership or other training needs, request a consultation." />
<a class="button below-empty" href="{{ route('contact') }}#consultation">Discuss your training needs ↗</a>
@else<div class="grid-three">
@foreach($programs as $program)<x-program-card :program="$program" />
@endforeach</div>
<div class="pagination">{{ $programs->links() }}</div>
@endif</div>
</section>
<x-cta />
