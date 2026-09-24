<x-layouts.admin title="Log in">
    <main class="grid min-h-screen place-items-center bg-[linear-gradient(135deg,#10243d,#0f766e)] px-5 py-12">
        <section class="w-full max-w-md rounded-[28px] border border-white/10 bg-white p-8 shadow-[0_25px_80px_rgba(0,0,0,.25)] sm:p-10">
            <a class="font-display text-xs font-bold uppercase tracking-[.14em] text-navy" href="{{ route('home') }}">The School House <span class="text-coral">Consult.</span></a>
            <p class="mt-10 text-xs font-bold uppercase tracking-[.18em] text-teal">Member access</p>
            <h1 class="mt-3 font-display text-4xl font-semibold leading-none tracking-[-.05em] text-navy">Welcome back.</h1>
            <p class="mt-4 text-sm leading-6 text-muted">Log in to continue to your School House account.</p>
            @if ($errors->any())<div class="mt-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700" role="alert">{{ $errors->first() }}</div>@endif
            <form method="POST" action="{{ route('login.store') }}" class="mt-7 space-y-5">
                @csrf
                <div><label class="mb-2 block text-sm font-semibold text-navy" for="email">Email address</label><input class="min-h-12 w-full rounded-xl border border-[#cbd8d2] bg-[#fbfdfb] px-4 text-sm outline-none transition focus:border-teal focus:ring-4 focus:ring-teal/10" id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email"></div>
                <div x-data="{ showPassword: false }"><label class="mb-2 block text-sm font-semibold text-navy" for="password">Password</label><div class="relative"><input class="min-h-12 w-full rounded-xl border border-[#cbd8d2] bg-[#fbfdfb] px-12 pl-4 pr-12 text-sm outline-none transition focus:border-teal focus:ring-4 focus:ring-teal/10" id="password" name="password" :type="showPassword ? 'text' : 'password'" required autocomplete="current-password"><button class="absolute inset-y-0 right-0 grid w-12 place-items-center text-muted transition hover:text-teal" type="button" @click="showPassword = !showPassword" :aria-label="showPassword ? 'Hide password' : 'Show password'" :title="showPassword ? 'Hide password' : 'Show password'"><i class="fa-solid" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'" aria-hidden="true"></i></button></div></div>
                <button class="flex min-h-12 w-full items-center justify-center gap-3 rounded-xl bg-coral px-5 text-sm font-bold text-white shadow-lg shadow-coral/20 transition hover:-translate-y-0.5 hover:bg-[#df5e51]" type="submit">Log in <i class="fa-solid fa-arrow-right-to-bracket" aria-hidden="true"></i></button>
            </form>
            <p class="mt-7 text-center text-sm text-muted">New here? <a class="font-bold text-teal hover:text-coral" href="{{ route('register') }}">Create an account</a></p>
        </section>
    </main>
</x-layouts.admin>
