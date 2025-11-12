<x-guest-layout>
    <h4 class="mb-2">Welcome to Sneat! 👋</h4>
    <p class="mb-4">Please sign-in to your account</p>

    <x-auth-session-status class="mb-4 alert alert-info" :status="session('status')" />

    <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                type="email"
                class="form-control"
                id="email"
                name="email"
                placeholder="Enter your email"
                :value="old('email')"
                required
                autofocus
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
        </div>

        <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        <small>Forgot Password?</small>
                    </a>
                @endif
            </div>
            <div class="input-group input-group-merge">
                <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password"
                    required
                />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember_me" name="remember" />
                <label class="form-check-label" for="remember_me"> Remember Me </label>
            </div>
        </div>

        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
        </div>
    </form>

    <p class="text-center">
        <span>New on our platform?</span>
        <a href="{{ route('register') }}">
            <span>Create an account</span>
        </a>
    </p>
</x-guest-layout>