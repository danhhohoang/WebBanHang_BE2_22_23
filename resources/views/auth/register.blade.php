<x-guest-layout>
    <div class="card-body register-card-body">
        <p class="login-box-msg">Register a new membership</p>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-group mb-3">
                <input id="name" type="text" class="form-control" name="name" :value="old('name')" required autofocus
                    autocomplete="name" placeholder="Full name">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="input-group mb-3">
                <input id="email" type="email" class="form-control" name="email" :value="old('email')" required
                    autocomplete="username" placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="input-group mb-3">
                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password"
                    placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="input-group mb-3">
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password" placeholder="Retype password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

                <!-- /.col -->

                    <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>

            <div class="text-center flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
