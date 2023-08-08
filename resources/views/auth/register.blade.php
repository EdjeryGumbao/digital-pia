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
            <label for="Department">Department</label>
                <select name="department" class="mt-1 w-full">
                    <option value="">No selected</option>
                    <option value="Board of Regents">Board of Regents</option>
                    <option value="Office of the President">Office of the President</option>
                    <option value="Office of the Vice President for Academic Affairs">Office of the Vice President for Academic Affairs</option>
                    <option value="Office of the Vice President for Administration">Office of the Vice President for Administration</option>
                    <option value="Office of the Vice President for Planning and Quality Assurance">Office of the Vice President for Planning and Quality Assurance</option>
                    <option value="Office of the Vice President for Research, Development and Extension">Office of the Vice President for Research, Development and Extension</option>
                    <option value="Office of the Secretary of the University and the University Records Office">Office of the Secretary of the University and the University Records Office</option>
                    <option value="Office of Legal Affairs">Office of Legal Affairs</option>
                    <option value="International Affairs Division">International Affairs Division</option>
                    <option value="Public Affairs Division">Public Affairs Division</option>
                    <option value="Office of Advance Studies">Office of Advance Studies</option>
                    <option value="Human Resource Management Division">Human Resource Management Division</option>
                    <option value="Administrative Services Division">Administrative Services Division</option>
                    <option value="Physical Development Division">Physical Development Division</option>
                    <option value="Gender and Development Office">Gender and Development Office</option>
                    <option value="Bids &amp; Awards Committee">Bids &amp; Awards Committee</option>
                    <option value="Office of Student Affairs and Services">Office of Student Affairs and Services</option>
                    <option value="Office of the University Registrar">Office of the University Registrar</option>
                    <option value="University Assessment and Guidance Center">University Assessment and Guidance Center</option>
                    <option value="University Learning Resource Center">University Learning Resource Center</option>
                    <option value="Resource Management Division">Resource Management Division</option>
                    <option value="Health Services Division">Health Services Division</option>
                    <option value="University Finance Division">University Finance Division</option>
                    <option value="Research, Development and Extension">Research, Development and Extension</option>
                    <option value="College of Agriculture and Related Sciences">College of Agriculture and Related Sciences</option>
                    <option value="College of Arts and Sciences">College of Arts and Sciences</option>
                    <option value="College of Business Administration">College of Business Administration</option>
                    <option value="College of Development Management">College of Development Management</option>
                    <option value="College of Education">College of Education</option>
                    <option value="College of Engineering">College of Engineering</option>
                    <option value="College of Teacher Education and Technology">College of Teacher Education and Technology</option>
                    <option value="College of Technology">College of Technology</option>
                    <option value="College of Information and Computing">College of Information and Computing</option>
                    <option value="College of Applied Economics">College of Applied Economics</option>
                    <option value="School of Law">School of Law</option>
                    <option value="School of Medicine">School of Medicine</option>
                </select>
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