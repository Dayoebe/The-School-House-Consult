<x-page-hero eyebrow="Our team" title="People with a shared purpose." text="Meet the people behind The School House Consult." />
<section class="py-[92px] max-[640px]:py-12"><div class="mx-auto w-[calc(100%-96px)] max-w-[1240px] max-[640px]:w-[calc(100%-40px)]">
@forelse($team as $member)<x-team-card :member="$member" />
@empty<x-empty-state title="Meet our team soon" text="Team profiles will be shared here as they become available." />
@endforelse</div>
</section>
<x-cta />
