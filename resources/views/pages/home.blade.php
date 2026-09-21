<section class="home-hero">
<div class="container hero-grid">
<div class="hero-copy">
<p class="eyebrow">
<span class="accent-line">
</span>Education. Collaboration. Excellence.</p>
<h1>Shaping the<br>Future of<br>
<span>Education</span>
<span class="orange-period">.</span>
</h1>
<p class="hero-lead">Strategic educational solutions for schools, educators and communities.</p>
<p class="hero-description">The School House Consult partners with stakeholders to develop practical solutions that promote educational excellence.</p>
<div class="button-row">
<a class="button" href="{{ route('services.index') }}">Explore Our Services <span aria-hidden="true">↗</span>
</a>
<a class="button button-outline" href="{{ route('contact') }}#consultation">Request a Consultation</a>
</div>
<div class="hero-footnote">
<span class="small-mark" aria-hidden="true">↗</span>
<span>Rooted in collaboration.<br>
<strong>Focused on education.</strong>
</span>
</div>
</div>
<div class="hero-visual hero-illustration">
<x-editorial-image name="education-collaboration" alt="Conceptual illustration of education professionals planning together around an open book." caption="A shared purpose. A thoughtful approach." priority />
<div class="hero-note"><x-icon name="book" /><span>Better education begins<br>with purposeful partnership.</span></div>

</div>
</div>
</section>
<div class="audience-strip">
<div class="container">
<span>Working together with</span>
<strong>Schools & Institutions</strong>
<span aria-hidden="true">/</span>
<strong>Educators & Leaders</strong>
<span aria-hidden="true">/</span>
<strong>Communities & Stakeholders</strong>
</div>
</div>
<section class="section">
<div class="container intro-grid">
<x-section-heading eyebrow="Welcome to The School House Consult" title="Partnering for Educational Excellence" />
<div>
<p class="large-copy">Education moves forward when we work together.</p>
<p>We are an education consulting company working with schools, educators and communities to explore challenges, shape ideas and plan practical next steps.</p>
<blockquote>{{ config('site.mission') }}</blockquote>
<a class="text-link" href="{{ route('about') }}">Discover our approach <span aria-hidden="true">↗</span>
</a>
</div>
</div>
</section>
<section class="section section-soft">
<div class="container">
<x-section-heading eyebrow="Who we serve" title="Different perspectives. Shared purpose." />
<x-audiences />
</div>
</section>
<section class="section">
<div class="container">
<div class="section-top">
<x-section-heading eyebrow="How we can help" title="Our Areas of Expertise" text="Practical support across the people, systems and experiences that shape education." />
<a class="text-link" href="{{ route('services.index') }}">View all services <span aria-hidden="true">↗</span>
</a>
</div>
<p class="swipe-hint">Swipe to explore our expertise <span aria-hidden="true">→</span></p>
<div class="grid-three mobile-service-rail" tabindex="0" role="region" aria-label="Our education consulting services">
@foreach($services as $service)<x-service-card :service="$service" />
@endforeach</div>
</div>
</section>
<section class="section approach-section">
<div class="container approach-grid">
<div>
<p class="eyebrow">Why partner with us</p>
<h2>Thoughtful strategy.<br>Practical next steps.</h2>
<p>Every educational setting has its own context. Our approach starts with understanding yours.</p>
<a class="button button-light" href="{{ route('about') }}">Our approach <span aria-hidden="true">↗</span>
</a>
</div>
<div class="approach-list">
@foreach(['Strategic collaboration'=>'Start with a shared understanding of priorities and work towards a considered plan.', 'Stakeholder engagement'=>'Bring the perspectives of educators, leaders and communities into the conversation.', 'Professional development'=>'Make space for learning, reflection and the development of professional practice.', 'Practical educational solutions'=>'Connect ideas to the needs and day-to-day realities of educational settings.'] as $heading=>$copy)<div>
<span class="approach-number">0{{ $loop->iteration }}</span>
<div>
<h3>{{ $heading }}</h3>
<p>{{ $copy }}</p>
</div>
</div>
@endforeach</div>
</div>
</section>
<section class="section">
<div class="container">
@if($member = $team->first())<x-team-card :member="$member" />
<div class="team-more">
<a class="text-link" href="{{ route('team') }}">View Our Team <span aria-hidden="true">↗</span>
</a>
</div>
@endif</div>
</section>
<section class="section section-soft">
<div class="container">
<div class="section-top">
<x-section-heading eyebrow="Programs & Training" title="Learning that supports better practice." text="Explore professional development across teaching, leadership and school improvement." />
<a class="text-link" href="{{ route('programs.index') }}">Explore training <span aria-hidden="true">↗</span>
</a>
</div>
<div class="learning-feature">
<x-editorial-image name="professional-learning" alt="Conceptual illustration of an educator leading a professional learning discussion." caption="Room to learn. Space to grow." />
<div><x-training-categories /><a class="text-link" href="{{ route('contact') }}#consultation">Discuss your team's learning needs ↗</a></div>
</div>
@if($programs->isNotEmpty())<div class="grid-three">
@foreach($programs as $program)<x-program-card :program="$program" />
@endforeach</div>
@else<p class="muted">Program details will be published as they become available. <a class="inline-link" href="{{ route('contact') }}#consultation">Discuss your training needs.</a>
</p>
@endif</div>
</section>
<section class="section">
<div class="container">
<div class="section-top">
<x-section-heading eyebrow="Resources & Insights" title="A space for ideas in education." />
<a class="text-link" href="{{ route('resources.index') }}">All resources <span aria-hidden="true">↗</span>
</a>
</div>
@if($articles->isNotEmpty())<div class="grid-three">
@foreach($articles as $article)<x-article-card :article="$article" />
@endforeach</div>
@else<x-empty-state title="Fresh perspectives are on the way" text="Articles and resources will appear here when they are published. In the meantime, explore our areas of expertise." />
@endif</div>
</section>
<section class="section section-soft">
<div class="container">
<div class="section-top">
<x-section-heading eyebrow="Case studies" title="From collaboration to practice." />
<a class="text-link" href="{{ route('case-studies.index') }}">View case studies <span aria-hidden="true">↗</span>
</a>
</div>
@if($caseStudies->isNotEmpty())<div class="grid-three">
@foreach($caseStudies as $caseStudy)<x-case-study-card :case-study="$caseStudy" />
@endforeach</div>
@else<x-empty-state title="Project stories, shared thoughtfully" text="Case studies will be published as our projects and impact stories become available." />
@endif</div>
</section>
<x-newsletter />
<x-cta />
<section class="section contact-preview">
<div class="container">
<x-section-heading eyebrow="Get in touch" title="Let's start a conversation." />
<x-contact-details />
</div>
</section>
