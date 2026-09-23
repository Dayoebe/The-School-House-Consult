<x-layouts.admin title="Create account">
    <main class="grid min-h-screen place-items-center bg-[linear-gradient(135deg,#10243d,#0f766e)] px-5 py-12">
        <section class="w-full max-w-md rounded-[28px] border border-white/10 bg-white p-8 shadow-[0_25px_80px_rgba(0,0,0,.25)] sm:p-10">
            <a class="font-display text-xs font-bold uppercase tracking-[.14em] text-navy" href="{{ route('home') }}">The School House <span class="text-coral">Consult.</span></a>
            <p class="mt-10 text-xs font-bold uppercase tracking-[.18em] text-teal">Join the community</p>
            <h1 class="mt-3 font-display text-4xl font-semibold leading-none tracking-[-.05em] text-navy">Make your mark.</h1>
            <p class="mt-4 text-sm leading-6 text-muted">Create an account to stay connected to ideas, resources and the people shaping education.</p>
            @if ($errors->any())<div class="mt-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700" role="alert"><ul class="list-disc space-y-1 pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
            <form method="POST" action="{{ route('register.store') }}" class="mt-7 space-y-5">
                @csrf
                <div><label class="mb-2 block text-sm font-semibold text-navy" for="name">Full name</label><input class="min-h-12 w-full rounded-xl border border-[#cbd8d2] bg-[#fbfdfb] px-4 text-sm outline-none transition focus:border-teal focus:ring-4 focus:ring-teal/10" id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"></div>
                <div><label class="mb-2 block text-sm font-semibold text-navy" for="email">Email address</label><input class="min-h-12 w-full rounded-xl border border-[#cbd8d2] bg-[#fbfdfb] px-4 text-sm outline-none transition focus:border-teal focus:ring-4 focus:ring-teal/10" id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email"></div>
                <div><label class="mb-2 block text-sm font-semibold text-navy" for="password">Password</label><input class="min-h-12 w-full rounded-xl border border-[#cbd8d2] bg-[#fbfdfb] px-4 text-sm outline-none transition focus:border-teal focus:ring-4 focus:ring-teal/10" id="password" name="password" type="password" required minlength="8" autocomplete="new-password"></div>
                <div><label class="mb-2 block text-sm font-semibold text-navy" for="password_confirmation">Confirm password</label><input class="min-h-12 w-full rounded-xl border border-[#cbd8d2] bg-[#fbfdfb] px-4 text-sm outline-none transition focus:border-teal focus:ring-4 focus:ring-teal/10" id="password_confirmation" name="password_confirmation" type="password" required minlength="8" autocomplete="new-password"></div>
                <button class="flex min-h-12 w-full items-center justify-center rounded-xl bg-coral px-5 text-sm font-bold text-white shadow-lg shadow-coral/20 transition hover:-translate-y-0.5 hover:bg-[#df5e51]" type="submit">Create account <span class="ml-3 text-lg" aria-hidden="true">↗</span></button>
            </form>
            <p class="mt-7 text-center text-sm text-muted">Already registered? <a class="font-bold text-teal hover:text-coral" href="{{ route('login') }}">Log in</a></p>
        </section>
    </main>
</x-layouts.admin>
