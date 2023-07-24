@section('title', 'Login')


<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf


        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- Email Address
        <div>
            <x-input-label for="department" :value="__('Department')" />
            <x-text-input id="department" class="block mt-1 w-full" type="text" name="department" :value="old('department')" required autofocus autocomplete="department" />
            <x-input-error :messages="$errors->get('department')" class="mt-2" />
        </div>
        -->
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>
        <div class="flex items-center justify-end mt-4">
            
        <!--
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        -->
            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

</x-guest-layout>



<!-- Popup -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- the popup -->
<div class="modal" id="dashboardPopup" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="margin:50px;">   
                <img src="img/SecureDataStudents.5ca4bba7.png" width="450" height="450" style="opacity: .8">
            </div>
            <div class="modal-body text-center">   
                <p>
                    By continuing to browse this website, you agree to the 
                    <a href="http://www.usep.edu.ph/usep-data-privacy-statement/" class="text-primary text-decoration-none" target="_blank">University of Southeastern Philippines’ 
                    Data Privacy Statement</a>.
                </p>
            </div>
            <div class="modal-body text-center">
                <button type="button" class="btn btn-primary" style="text-align: center;" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">Continue</span>
                </button>
            </div>

        </div>
    </div>
</div>

<style>
    .modal {
        display: block;
    }
</style>

<script>
    // When the document is ready
    $(document).ready(function() {
        // Show the popup when the page loads
        $('#dashboardPopup').modal('show');

        // Close the popup when the "Close" button is clicked
        $('#dashboardPopup .close').click(function() {
            $('#dashboardPopup').modal('hide');
        });
    });
</script>
