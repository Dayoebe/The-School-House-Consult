@props(['service'])<article class="group flex min-h-full flex-col items-start rounded border border-line bg-white p-[30px] transition hover:border-[#9aaec9] hover:shadow-[0_5px_16px_#0b2a5b06] max-[640px]:rounded-[10px] max-[640px]:p-6">
<span class="mb-6 inline-grid h-[46px] w-[46px] shrink-0 place-items-center rounded bg-[#f5eee7] text-[#ad4f08]">
<x-icon :name="$service->icon" />
</span>
<h3 class="mb-[13px] text-[20px] font-semibold leading-[1.3] tracking-[-.02em] text-navy">
<a href="{{ route('services.show', $service) }}">{{ $service->title }}</a>
</h3>
<p class="mb-5 text-[14px] text-muted">{{ $service->description }}</p>
<a class="mt-auto flex w-full items-center justify-between gap-[22px] py-2 text-[13px] font-bold leading-[1.5] text-navy transition hover:text-orange" href="{{ route('services.show', $service) }}" aria-label="Learn more about {{ $service->title }}">Learn More <span class="text-[22px]" aria-hidden="true">↗</span>
</a>
</article>
