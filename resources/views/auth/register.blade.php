@section('title', 'Register')

<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="lastname" :value="__('Lastname')" />
            <x-text-input id="name" class="mt-1 w-full" type="text" name="lastname" required autofocus autocomplete="lastname" />
            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
        </div> 

        <div>
            <x-input-label for="firstname" :value="__('Firstname')" />
            <x-text-input id="name" class="mt-1 w-full" type="text" name="firstname" required autofocus autocomplete="firstname" />
            <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
        </div> 

        <div>
            <x-input-label for="middlename" :value="__('Middlename')" />
            <x-text-input id="name" class="mt-1 w-full" type="text" name="middlename" autofocus autocomplete="middlename" />
            <x-input-error :messages="$errors->get('middlename')" class="mt-2" />
        </div> 

        <div>
            <x-input-label for="department" :value="__('Department')" />
            <x-text-input id="name" class="mt-1 w-full" type="text" name="department" required autofocus autocomplete="department" />
            <x-input-error :messages="$errors->get('department')" class="mt-2" />
        </div> 

        <!-- Contacts -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
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