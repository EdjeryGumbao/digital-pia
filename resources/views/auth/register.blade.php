@section('title', 'Register')

<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="username" :value="__('Department')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>
        
        <!-- Contacts -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password 
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div> -->

        <!-- Confirm Password 
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div> -->
        <br>
        <p>Note: The default password is: 
            <span class="password-wrapper">
                <span class="password-cover">********</span>
                <span class="password-content">12345678</span>
            </span>
        </p>

        <div class="flex items-center justify-end mt-4">

            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ url('manage') }}">
                {{ __('Back') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<style>
.password-wrapper {
  position: relative;
  display: inline-block;
}

.password-cover {
  cursor: pointer;
  padding: 2px 5px;
  background-color: #000;
  color: #fff;
}

.password-content {
  display: none;
  position: absolute;
  top: 0;
  left: 0;
  padding: 2px 5px;
  background-color: #fff;
  color: #000;
}

.password-wrapper:hover .password-content {
  display: inline;
}

</style>