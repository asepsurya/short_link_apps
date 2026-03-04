<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mt-1">
            {{ __('Profile Settings') }}
        </h2>
    </x-slot>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Manage Account</h1>
        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Update your profile information and security settings.</p>
    </div>

    <div class="space-y-6">
        <div class="p-6 bg-white dark:bg-[#121217] shadow-sm border border-gray-100 dark:border-gray-800 rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-6 bg-white dark:bg-[#121217] shadow-sm border border-gray-100 dark:border-gray-800 rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-6 bg-white dark:bg-[#121217] shadow-sm border border-gray-100 dark:border-gray-800 rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.api-token-form')
            </div>
        </div>

        <div class="p-6 bg-white dark:bg-[#121217] shadow-sm border border-gray-100 dark:border-gray-800 rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
