<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
          

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>


            <div class="flex items-center justify-end mt-3">
                <x-jet-button class="">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
        <a href="{{ route('register') }}">
            <span>Create Account?</span>
        </a>
        <span class="d-flex justify-content-center mt-3">or</span>
     <div class="row mt-4">
        <div class="col-4">
            <a href="{{ route('github@redirect') }}">
                <button class="btn btn-secondary">GitHib</button>
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('google@redirect') }}">
                <button class="btn btn-danger ">Google</button>
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('facebook@redirect') }}">
                <button class="btn btn-primary ">Facebook</button>
            </a>
        </div>
     </div>
      
    </x-jet-authentication-card>
</x-guest-layout>
