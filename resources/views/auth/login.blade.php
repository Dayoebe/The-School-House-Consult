@component('layouts.app', [
    'title' => 'Log in',
    'description' => 'Log in to your School House Consult account.',
    'canonical' => route('login'),
    'robots' => 'noindex, nofollow, noarchive',
])
    <section class="relative isolate flex min-h-[calc(100vh-8rem)] items-center overflow-hidden bg-[#f6f1e8] px-4 py-16 sm:px-6 sm:py-20 lg:px-8">
        <div class="absolute -left-28 top-8 -z-10 h-80 w-80 rounded-full bg-orange/15 blur-3xl" aria-hidden="true"></div>
        <div class="absolute -right-24 bottom-0 -z-10 h-96 w-96 rounded-full bg-teal/15 blur-3xl" aria-hidden="true"></div>

        <section class="mx-auto grid w-full max-w-6xl overflow-hidden rounded-[30px] border border-white/80 bg-white shadow-[0_30px_100px_rgba(11,42,91,.18)] lg:min-h-[700px] lg:grid-cols-[1.05fr_.95fr]" aria-labelledby="login-title">
            <div class="relative flex min-h-[290px] flex-col justify-between overflow-hidden bg-navy p-7 text-white sm:min-h-[350px] sm:p-10 lg:min-h-full lg:p-12">
                <div class="absolute inset-0 opacity-25" aria-hidden="true">
                    <img class="h-full w-full object-cover" src="{{ asset('images/illustrations/professional-learning-1536.webp') }}" alt="">
                </div>
                <div class="absolute inset-0 bg-[linear-gradient(145deg,rgba(11,42,91,.72),rgba(11,42,91,.96)_70%)]" aria-hidden="true"></div>
                <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full border-[42px] border-white/5" aria-hidden="true"></div>

                <div class="relative z-10">
                    <x-brand :footer="true" />
                </div>

                <div class="relative z-10 mt-14 max-w-md lg:mt-auto">
                    <p class="flex items-center gap-3 text-[10px] font-extrabold uppercase tracking-[.22em] text-[#7bd7c4]"><span class="h-px w-8 bg-[#7bd7c4]"></span>Member access</p>
                    <h2 class="mt-4 max-w-sm text-3xl font-extrabold leading-[1.08] tracking-[-.04em] sm:text-4xl">Continue shaping what education can become.</h2>
                    <p class="mt-5 max-w-sm text-sm leading-7 text-slate-300">Return to your account and stay connected to School House Consult resources and opportunities.</p>
                </div>
            </div>

            <div class="flex items-center px-6 py-10 sm:px-12 lg:px-16 lg:py-14">
                <div class="w-full">
                    <p class="text-[10px] font-extrabold uppercase tracking-[.2em] text-orange">Welcome back</p>
                    <h1 id="login-title" class="mt-3 text-4xl font-extrabold leading-none tracking-[-.05em] text-navy sm:text-5xl">Log in.</h1>
                    <p class="mt-4 text-sm leading-6 text-muted">Enter your details to continue to your account.</p>

                    @if ($errors->any())
                        <div class="mt-6 flex gap-3 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-800" role="alert">
                            <i class="fa-solid fa-circle-exclamation mt-1 shrink-0" aria-hidden="true"></i>
                            <p>{{ $errors->first() }}</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-5">
                        @csrf
                        <div>
                            <label class="mb-2 block text-xs font-extrabold text-navy" for="email">Email address</label>
                            <div class="relative">
                                <i class="fa-regular fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400" aria-hidden="true"></i>
                                <input class="min-h-14 w-full rounded-2xl border border-slate-200 bg-slate-50/80 pl-12 pr-4 text-sm text-ink outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-teal focus:bg-white focus:ring-4 focus:ring-teal/10" id="email" name="email" type="email" value="{{ old('email') }}" placeholder="you@example.com" required autofocus autocomplete="email">
                            </div>
                        </div>
                        <div x-data="{ showPassword: false }">
                            <label class="mb-2 block text-xs font-extrabold text-navy" for="password">Password</label>
                            <div class="relative">
                                <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400" aria-hidden="true"></i>
                                <input class="min-h-14 w-full rounded-2xl border border-slate-200 bg-slate-50/80 pl-12 pr-12 text-sm text-ink outline-none transition hover:border-slate-300 focus:border-teal focus:bg-white focus:ring-4 focus:ring-teal/10" id="password" name="password" :type="showPassword ? 'text' : 'password'" required autocomplete="current-password">
                                <button class="absolute inset-y-0 right-0 grid w-12 place-items-center rounded-r-2xl text-slate-400 transition hover:text-teal focus:outline-none focus:ring-2 focus:ring-inset focus:ring-teal" type="button" @click="showPassword = !showPassword" :aria-label="showPassword ? 'Hide password' : 'Show password'" :title="showPassword ? 'Hide password' : 'Show password'">
                                    <i class="fa-solid" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <button class="group flex min-h-14 w-full items-center justify-center gap-3 rounded-2xl bg-orange px-5 text-sm font-extrabold text-white shadow-[0_14px_30px_rgba(244,123,32,.28)] transition hover:-translate-y-0.5 hover:bg-[#dc6810] focus:outline-none focus:ring-4 focus:ring-orange/25" type="submit">
                            Log in
                            <i class="fa-solid fa-arrow-right transition group-hover:translate-x-1" aria-hidden="true"></i>
                        </button>
                    </form>

                    <div class="mt-8 flex items-center gap-4 text-slate-300" aria-hidden="true"><span class="h-px flex-1 bg-slate-200"></span><span class="h-1.5 w-1.5 rounded-full bg-orange"></span><span class="h-px flex-1 bg-slate-200"></span></div>
                    <p class="mt-7 text-center text-sm text-muted">New to School House? <a class="font-extrabold text-teal underline decoration-teal/20 underline-offset-4 transition hover:text-orange" href="{{ route('register') }}">Create an account</a></p>
                </div>
            </div>
        </section>
    </section>
@endcomponent
