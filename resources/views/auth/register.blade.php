@component('layouts.app', [
    'title' => 'Create account',
    'description' => 'Create your School House Consult account.',
    'canonical' => route('register'),
    'robots' => 'noindex, nofollow, noarchive',
])
    <section class="relative isolate flex min-h-[calc(100vh-8rem)] items-center overflow-hidden bg-[#f6f1e8] px-4 py-16 sm:px-6 sm:py-20 lg:px-8">
        <div class="absolute -left-28 top-8 -z-10 h-80 w-80 rounded-full bg-orange/15 blur-3xl" aria-hidden="true"></div>
        <div class="absolute -right-24 bottom-0 -z-10 h-96 w-96 rounded-full bg-teal/15 blur-3xl" aria-hidden="true"></div>

        <section class="mx-auto grid w-full max-w-6xl overflow-hidden rounded-[30px] border border-white/80 bg-white shadow-[0_30px_100px_rgba(11,42,91,.18)] lg:min-h-[760px] lg:grid-cols-[.95fr_1.05fr]" aria-labelledby="register-title">
            <div class="flex items-center px-6 py-10 sm:px-12 lg:px-16 lg:py-14">
                <div class="w-full">
                    <p class="text-[10px] font-extrabold uppercase tracking-[.2em] text-orange">Join School House</p>
                    <h1 id="register-title" class="mt-3 text-4xl font-extrabold leading-none tracking-[-.05em] text-navy sm:text-5xl">Create your account.</h1>
                    <p class="mt-4 text-sm leading-6 text-muted">A few details and you’ll be ready to get started.</p>

                    @if ($errors->any())
                        <div class="mt-6 flex gap-3 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-800" role="alert">
                            <i class="fa-solid fa-circle-exclamation mt-1 shrink-0" aria-hidden="true"></i>
                            <ul class="list-disc space-y-1 pl-4">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.store') }}" class="mt-8 grid gap-5 sm:grid-cols-2">
                        @csrf
                        <div class="sm:col-span-2">
                            <label class="mb-2 block text-xs font-extrabold text-navy" for="name">Full name</label>
                            <div class="relative">
                                <i class="fa-regular fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-400" aria-hidden="true"></i>
                                <input class="min-h-14 w-full rounded-2xl border border-slate-200 bg-slate-50/80 pl-12 pr-4 text-sm text-ink outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-teal focus:bg-white focus:ring-4 focus:ring-teal/10" id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Your full name" required autofocus autocomplete="name">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="mb-2 block text-xs font-extrabold text-navy" for="email">Email address</label>
                            <div class="relative">
                                <i class="fa-regular fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400" aria-hidden="true"></i>
                                <input class="min-h-14 w-full rounded-2xl border border-slate-200 bg-slate-50/80 pl-12 pr-4 text-sm text-ink outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-teal focus:bg-white focus:ring-4 focus:ring-teal/10" id="email" name="email" type="email" value="{{ old('email') }}" placeholder="you@example.com" required autocomplete="email">
                            </div>
                        </div>
                        <div x-data="{ showPassword: false }">
                            <label class="mb-2 block text-xs font-extrabold text-navy" for="password">Password</label>
                            <div class="relative">
                                <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400" aria-hidden="true"></i>
                                <input class="min-h-14 w-full rounded-2xl border border-slate-200 bg-slate-50/80 pl-12 pr-12 text-sm text-ink outline-none transition hover:border-slate-300 focus:border-teal focus:bg-white focus:ring-4 focus:ring-teal/10" id="password" name="password" :type="showPassword ? 'text' : 'password'" required minlength="8" autocomplete="new-password">
                                <button class="absolute inset-y-0 right-0 grid w-12 place-items-center rounded-r-2xl text-slate-400 transition hover:text-teal focus:outline-none focus:ring-2 focus:ring-inset focus:ring-teal" type="button" @click="showPassword = !showPassword" :aria-label="showPassword ? 'Hide password' : 'Show password'" :title="showPassword ? 'Hide password' : 'Show password'"><i class="fa-solid" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'" aria-hidden="true"></i></button>
                            </div>
                            <p class="mt-2 text-[10px] leading-4 text-slate-500">Use at least 8 characters.</p>
                        </div>
                        <div x-data="{ showPassword: false }">
                            <label class="mb-2 block text-xs font-extrabold text-navy" for="password_confirmation">Confirm password</label>
                            <div class="relative">
                                <i class="fa-solid fa-shield-halved absolute left-4 top-1/2 -translate-y-1/2 text-slate-400" aria-hidden="true"></i>
                                <input class="min-h-14 w-full rounded-2xl border border-slate-200 bg-slate-50/80 pl-12 pr-12 text-sm text-ink outline-none transition hover:border-slate-300 focus:border-teal focus:bg-white focus:ring-4 focus:ring-teal/10" id="password_confirmation" name="password_confirmation" :type="showPassword ? 'text' : 'password'" required minlength="8" autocomplete="new-password">
                                <button class="absolute inset-y-0 right-0 grid w-12 place-items-center rounded-r-2xl text-slate-400 transition hover:text-teal focus:outline-none focus:ring-2 focus:ring-inset focus:ring-teal" type="button" @click="showPassword = !showPassword" :aria-label="showPassword ? 'Hide password' : 'Show password'" :title="showPassword ? 'Hide password' : 'Show password'"><i class="fa-solid" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <button class="group flex min-h-14 items-center justify-center gap-3 rounded-2xl bg-orange px-5 text-sm font-extrabold text-white shadow-[0_14px_30px_rgba(244,123,32,.28)] transition hover:-translate-y-0.5 hover:bg-[#dc6810] focus:outline-none focus:ring-4 focus:ring-orange/25 sm:col-span-2" type="submit">
                            Create account
                            <i class="fa-solid fa-arrow-right transition group-hover:translate-x-1" aria-hidden="true"></i>
                        </button>
                    </form>

                    <p class="mt-7 text-center text-sm text-muted">Already registered? <a class="font-extrabold text-teal underline decoration-teal/20 underline-offset-4 transition hover:text-orange" href="{{ route('login') }}">Log in instead</a></p>
                </div>
            </div>

            <div class="relative order-first flex min-h-[270px] flex-col justify-between overflow-hidden bg-navy p-7 text-white sm:min-h-[340px] sm:p-10 lg:order-last lg:min-h-full lg:p-12">
                <div class="absolute inset-0 opacity-25" aria-hidden="true">
                    <img class="h-full w-full object-cover" src="{{ asset('images/illustrations/education-collaboration-1536.webp') }}" alt="">
                </div>
                <div class="absolute inset-0 bg-[linear-gradient(145deg,rgba(11,42,91,.7),rgba(11,42,91,.97)_72%)]" aria-hidden="true"></div>
                <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full border-[42px] border-white/5" aria-hidden="true"></div>

                <div class="relative z-10">
                    <x-brand :footer="true" />
                </div>

                <div class="relative z-10 mt-12 max-w-md lg:mt-auto">
                    <p class="flex items-center gap-3 text-[10px] font-extrabold uppercase tracking-[.22em] text-[#7bd7c4]"><span class="h-px w-8 bg-[#7bd7c4]"></span>A connected community</p>
                    <h2 class="mt-4 max-w-sm text-3xl font-extrabold leading-[1.08] tracking-[-.04em] sm:text-4xl">Make room for better educational ideas.</h2>
                    <p class="mt-5 max-w-sm text-sm leading-7 text-slate-300">Create your account to stay connected to resources, programmes and School House Consult.</p>
                </div>
            </div>
        </section>
    </section>
@endcomponent
