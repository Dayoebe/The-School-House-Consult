<x-page-hero eyebrow="Our team" title="People with a shared purpose." text="Meet the people behind The School House Consult." />
<section class="section">
<div class="container team-list">
@forelse($team as $member)<x-team-card :member="$member" />
@empty<x-empty-state title="Meet our team soon" text="Team profiles will be shared here as they become available." />
@endforelse</div>
</section>
<x-cta />
