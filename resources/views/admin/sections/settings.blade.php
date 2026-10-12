@php
    $phones = old('phone_displays')
        ? collect(old('phone_displays'))->mapWithKeys(fn (string $display, int $index): array => [$display => old('phone_values')[$index] ?? ''])
        : collect($siteSettings['phones']);
@endphp

<div class="grid gap-7 xl:grid-cols-[minmax(0,1fr)_320px]">
    <section class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-[0_12px_35px_rgba(11,42,91,.05)] sm:p-9">
        <div class="flex flex-col justify-between gap-5 border-b border-slate-100 pb-7 sm:flex-row sm:items-end">
            <div>
                <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-[10px] font-extrabold uppercase tracking-[.15em] text-emerald-700">Public website details</span>
                <h2 class="mt-4 text-[clamp(28px,4vw,42px)] font-extrabold tracking-[-.045em] text-slate-950">Manage your site identity.</h2>
                <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-600">These details appear across the header, footer, contact page, map and search-engine information.</p>
            </div>
            <a class="inline-flex shrink-0 items-center gap-2 rounded-xl border border-slate-200 px-4 py-3 text-[11px] font-extrabold text-slate-700 hover:border-teal hover:text-teal" href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">Preview website <span aria-hidden="true">↗</span></a>
        </div>

        @if($errors->any())
            <div class="mt-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800" role="alert">
                <p class="font-extrabold">Please correct the highlighted fields.</p>
                <ul class="mt-2 list-disc space-y-1 pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form class="mt-8 space-y-8" method="POST" action="{{ route('admin.settings.update') }}">
            @csrf
            @method('PATCH')

            <fieldset>
                <legend class="text-lg font-extrabold text-slate-950">Organisation identity</legend>
                <p class="mt-1 text-xs text-slate-500">Keep the public name, positioning and mission consistent.</p>
                <div class="mt-5 grid gap-5 sm:grid-cols-2">
                    <label class="text-[11px] font-extrabold text-slate-700">Organisation name <span class="text-orange">*</span><input class="mt-2 min-h-12 w-full rounded-xl border bg-slate-50 px-4 text-base font-normal text-slate-900 outline-none focus:border-teal focus:ring-4 focus:ring-teal/10 @error('name') border-red-400 @else border-slate-300 @enderror" name="name" value="{{ old('name', $siteSettings['name']) }}" required></label>
                    <label class="text-[11px] font-extrabold text-slate-700">Tagline<input class="mt-2 min-h-12 w-full rounded-xl border bg-slate-50 px-4 text-base font-normal text-slate-900 outline-none focus:border-teal focus:ring-4 focus:ring-teal/10 @error('tagline') border-red-400 @else border-slate-300 @enderror" name="tagline" value="{{ old('tagline', $siteSettings['tagline']) }}"></label>
                    <label class="text-[11px] font-extrabold text-slate-700 sm:col-span-2">Mission<textarea class="mt-2 min-h-28 w-full rounded-xl border bg-slate-50 px-4 py-3 text-base font-normal leading-7 text-slate-900 outline-none focus:border-teal focus:ring-4 focus:ring-teal/10 @error('mission') border-red-400 @else border-slate-300 @enderror" name="mission">{{ old('mission', $siteSettings['mission']) }}</textarea></label>
                </div>
            </fieldset>

            <fieldset class="border-t border-slate-100 pt-8">
                <legend class="text-lg font-extrabold text-slate-950">Contact channels</legend>
                <p class="mt-1 text-xs text-slate-500">Phone links must use international format, such as +2347062220159.</p>
                <div class="mt-5 grid gap-5 sm:grid-cols-2">
                    <label class="text-[11px] font-extrabold text-slate-700">Public email <span class="text-orange">*</span><input class="mt-2 min-h-12 w-full rounded-xl border bg-slate-50 px-4 text-base font-normal text-slate-900 outline-none focus:border-teal focus:ring-4 focus:ring-teal/10 @error('email') border-red-400 @else border-slate-300 @enderror" type="email" name="email" value="{{ old('email', $siteSettings['email']) }}" required></label>
                    <label class="text-[11px] font-extrabold text-slate-700">WhatsApp URL <span class="text-orange">*</span><input class="mt-2 min-h-12 w-full rounded-xl border bg-slate-50 px-4 text-base font-normal text-slate-900 outline-none focus:border-teal focus:ring-4 focus:ring-teal/10 @error('whatsapp') border-red-400 @else border-slate-300 @enderror" type="url" name="whatsapp" value="{{ old('whatsapp', $siteSettings['whatsapp']) }}" required></label>
                </div>
                <div class="mt-5 space-y-3">
                    @foreach($phones as $display => $phone)
                        <div class="grid gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-4 sm:grid-cols-2">
                            <label class="text-[11px] font-extrabold text-slate-700">Displayed phone<input class="mt-2 min-h-11 w-full rounded-xl border border-slate-300 bg-white px-4 text-base font-normal text-slate-900 outline-none focus:border-teal" name="phone_displays[]" value="{{ $display }}" required></label>
                            <label class="text-[11px] font-extrabold text-slate-700">Clickable phone<input class="mt-2 min-h-11 w-full rounded-xl border border-slate-300 bg-white px-4 text-base font-normal text-slate-900 outline-none focus:border-teal" name="phone_values[]" value="{{ $phone }}" placeholder="+234…" required></label>
                        </div>
                    @endforeach
                </div>
            </fieldset>

            <fieldset class="border-t border-slate-100 pt-8">
                <legend class="text-lg font-extrabold text-slate-950">Office location</legend>
                <p class="mt-1 text-xs text-slate-500">The map search phrase controls the pin displayed on the contact page.</p>
                <div class="mt-5 grid gap-5">
                    <label class="text-[11px] font-extrabold text-slate-700">Public address <span class="text-orange">*</span><textarea class="mt-2 min-h-24 w-full rounded-xl border bg-slate-50 px-4 py-3 text-base font-normal leading-7 text-slate-900 outline-none focus:border-teal focus:ring-4 focus:ring-teal/10 @error('address') border-red-400 @else border-slate-300 @enderror" name="address" required>{{ old('address', $siteSettings['address']) }}</textarea></label>
                    <label class="text-[11px] font-extrabold text-slate-700">Google Maps search phrase <span class="text-orange">*</span><input class="mt-2 min-h-12 w-full rounded-xl border bg-slate-50 px-4 text-base font-normal text-slate-900 outline-none focus:border-teal focus:ring-4 focus:ring-teal/10 @error('map_query') border-red-400 @else border-slate-300 @enderror" name="map_query" value="{{ old('map_query', $siteSettings['map_query']) }}" required></label>
                </div>
            </fieldset>

            <div class="flex flex-col gap-3 border-t border-slate-100 pt-7 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-xs leading-5 text-slate-500">Changes take effect across the public website immediately after saving.</p>
                <button class="inline-flex min-h-12 items-center justify-center gap-2 rounded-xl bg-navy px-6 text-sm font-extrabold text-white shadow-lg shadow-navy/15 transition hover:bg-teal" type="submit"><i class="fa-solid fa-floppy-disk" aria-hidden="true"></i> Save site settings</button>
            </div>
        </form>
    </section>

    <aside class="space-y-5">
        <section class="rounded-[24px] bg-navy p-6 text-white">
            <span class="grid h-11 w-11 place-items-center rounded-xl bg-white/10 text-[#ffb47d]"><i class="fa-solid fa-shield-halved" aria-hidden="true"></i></span>
            <h2 class="mt-5 text-xl font-extrabold">Safe website defaults</h2>
            <p class="mt-3 text-xs leading-6 text-slate-300">The verified organisation details remain in the application as fallbacks. If the settings database is unavailable, the public site continues to show those defaults.</p>
        </section>
        <section class="rounded-[24px] border border-orange-200 bg-orange-50 p-6">
            <p class="text-[10px] font-extrabold uppercase tracking-widest text-[#b5480a]">Before saving</p>
            <ul class="mt-4 space-y-3 text-xs leading-5 text-slate-700">
                <li class="flex gap-3"><span class="font-extrabold text-orange">01</span> Confirm the email and every phone number.</li>
                <li class="flex gap-3"><span class="font-extrabold text-orange">02</span> Use the complete office address.</li>
                <li class="flex gap-3"><span class="font-extrabold text-orange">03</span> Preview the contact page and map afterwards.</li>
            </ul>
        </section>
    </aside>
</div>
