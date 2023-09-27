<x-app-layout>


    <x-slot name="header">

        <div class=" mb-5 relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>


                    </tr>
                </thead>
                <tbody>





                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                            {{ $user->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4">

                        </td>



                    </tr>
                </tbody>
            </table>
        </div>

        <x-auth-card>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('users.update', $user) }}">
                @csrf
                @method('PUT')
                <div class="grid gap-6">
                    <!-- Name -->
                    <div class="space-y-2">
                        <x-form.label for="name" :value="__('Name')" />

                        <x-form.input-with-icon-wrapper>
                            <x-slot name="icon">
                                <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                            </x-slot>

                            <x-form.input withicon id="name" class="block w-full" type="text" name="name"
                                :value="old('name')" required autofocus placeholder="{{ __('Name') }}" />
                        </x-form.input-with-icon-wrapper>
                    </div>

                    <!-- Email Address -->
                    <div class="space-y-2">
                        <x-form.label for="email" :value="__('Email')" />

                        <x-form.input-with-icon-wrapper>
                            <x-slot name="icon">
                                <x-heroicon-o-mail aria-hidden="true" class="w-5 h-5" />
                            </x-slot>

                            <x-form.input withicon id="email" class="block w-full" type="email" name="email"
                                :value="old('email')" required placeholder="{{ __('Email') }}" />
                        </x-form.input-with-icon-wrapper>
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <x-form.label for="password" :value="__('Password')" />

                        <x-form.input-with-icon-wrapper>
                            <x-slot name="icon">
                                <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                            </x-slot>

                            <x-form.input withicon id="password" class="block w-full" type="password" name="password"
                                required autocomplete="new-password" placeholder="{{ __('Password') }}" />
                        </x-form.input-with-icon-wrapper>
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-2">
                        <x-form.label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-form.input-with-icon-wrapper>
                            <x-slot name="icon">
                                <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                            </x-slot>

                            <x-form.input withicon id="password_confirmation" class="block w-full" type="password"
                                name="password_confirmation" required placeholder="{{ __('Confirm Password') }}" />
                        </x-form.input-with-icon-wrapper>
                    </div>
            
                    <div>
                        <x-button class="justify-center w-full gap-2">
                            <x-heroicon-o-user-add class="w-6 h-6" aria-hidden="true" />

                            <span>{{ __('Create User') }}</span>
                        </x-button>
                    </div>


                </div>
            </form>
        </x-auth-card>
    </x-slot>

</x-app-layout>
