<x-layouts.admin title="Login">
    <main class="grid min-h-screen place-items-center bg-[#10243d] px-5 py-12">
        <div class="pointer-events-none absolute inset-0 opacity-20 [background-image:linear-gradient(rgba(255,255,255,.12)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,.12)_1px,transparent_1px)] [background-size:52px_52px]"></div>
        <section class="relative w-full max-w-md rounded-[28px] border border-white/10 bg-white p-8 shadow-[0_25px_80px_rgba(0,0,0,.25)] sm:p-10">
            <div class="mb-10">
                <a class="font-display text-xs font-bold uppercase tracking-[.14em] text-navy" href="{{ route('home') }}">The School House <span class="text-coral">Consult.</span></a>
                <p class="mt-8 text-xs font-bold uppercase tracking-[.18em] text-teal">Private workspace</p>
                <h1 class="mt-3 font-display text-4xl font-semibold leading-none tracking-[-.05em] text-navy">Welcome back.</h1>
                <p class="mt-4 text-sm leading-6 text-muted">Sign in to manage the content, enquiries and learning resources behind your website.</p>
            </div>
            @if ($errors->any())
                <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700" role="alert">{{ $errors->first() }}</div>
            @endif
            <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="mb-2 block text-sm font-semibold text-navy" for="email">Email address</label>
                    <input class="min-h-12 w-full rounded-xl border border-[#cbd8d2] bg-[#fbfdfb] px-4 text-sm outline-none transition focus:border-teal focus:ring-4 focus:ring-teal/10" id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-navy" for="password">Password</label>
                    <input class="min-h-12 w-full rounded-xl border border-[#cbd8d2] bg-[#fbfdfb] px-4 text-sm outline-none transition focus:border-teal focus:ring-4 focus:ring-teal/10" id="password" name="password" type="password" required autocomplete="current-password">
                </div>
                <button class="flex min-h-12 w-full items-center justify-center rounded-xl bg-coral px-5 text-sm font-bold text-white shadow-lg shadow-coral/20 transition hover:-translate-y-0.5 hover:bg-[#df5e51]" type="submit">Enter dashboard <span class="ml-3 text-lg" aria-hidden="true">↗</span></button>
            </form>
        </section>
    </main>
</x-layouts.admin>
