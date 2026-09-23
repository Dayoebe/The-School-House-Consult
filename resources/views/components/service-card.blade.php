@props(['service'])<article class="group flex min-h-full flex-col items-start rounded-[24px] border border-[#e7ded1] bg-white/85 p-[30px] shadow-[0_12px_35px_rgba(11,42,91,.05)] backdrop-blur transition duration-300 hover:-translate-y-1 hover:border-teal/30 hover:shadow-[0_20px_45px_rgba(11,42,91,.12)] max-[640px]:rounded-[20px] max-[640px]:p-6">
<span class="mb-6 inline-grid h-[50px] w-[50px] shrink-0 place-items-center rounded-2xl bg-[#e8f2ee] text-teal transition group-hover:rotate-[-6deg] group-hover:bg-teal group-hover:text-white">
<x-icon :name="$service->icon" />
</span>
<h3 class="mb-[13px] font-display text-[21px] font-semibold leading-[1.15] tracking-[-.02em] text-navy">
<a href="{{ route('services.show', $service) }}">{{ $service->title }}</a>
</h3>
<p class="mb-5 text-[14px] text-muted">{{ $service->description }}</p>
<a class="mt-auto flex w-full items-center justify-between gap-[22px] py-2 text-[13px] font-bold leading-[1.5] text-navy transition hover:text-orange" href="{{ route('services.show', $service) }}" aria-label="Learn more about {{ $service->title }}">Learn More <i class="fa-solid fa-arrow-up-right-from-square text-[11px]" aria-hidden="true"></i>
</a>
</article>
