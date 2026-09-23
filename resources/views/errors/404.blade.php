@component('layouts.app', ['title' => 'Page Not Found', 'description' => "The page you're looking for may have moved or no longer exists.", 'robots' => 'noindex, follow'])<section class="mx-auto min-h-[55vh] w-[calc(100%-96px)] max-w-[1240px] py-[110px] max-[640px]:w-[calc(100%-40px)]">
<p class="mb-5 text-[11px] font-bold uppercase tracking-[.17em] text-orange">404 / A different direction</p>
<h1 class="mb-[25px] text-[clamp(40px,4.5vw,66px)] font-semibold text-navy">Page Not Found</h1>
<p class="text-muted">The page you're looking for may have moved or no longer exists.</p>
<div class="mt-[30px] flex flex-wrap gap-3">
<a class="inline-flex min-h-[50px] items-center justify-center gap-6 rounded border border-orange bg-orange px-[23px] py-[15px] text-[13px] font-bold text-[#14233a]" href="{{ route('home') }}">Return Home ↗</a>
<a class="inline-flex min-h-[50px] items-center justify-center gap-6 rounded border border-[#b4becd] px-[23px] py-[15px] text-[13px] font-bold text-navy" href="{{ route('services.index') }}">Explore Services</a>
</div>
</section>
@endcomponent
