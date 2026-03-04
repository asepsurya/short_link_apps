<section>
    <header>
        <h2 class="text-lg font-bold text-gray-900 dark:text-white">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('put')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="update_password_current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Current Password') }}</label>
                <input id="update_password_current_password" name="current_password" type="password" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm transition-colors" autocomplete="current-password">
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div>
                <label for="update_password_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ __('New Password') }}</label>
                <input id="update_password_password" name="password" type="password" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm transition-colors" autocomplete="new-password">
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div>
                <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Confirm Password') }}</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm transition-colors" autocomplete="new-password">
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-50 dark:border-gray-800">
            <button type="submit" class="inline-flex items-center gap-2 py-2.5 px-6 rounded-xl bg-purple-600 text-white text-sm font-semibold hover:bg-purple-700 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors shadow-sm">
                {{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400 font-medium"
                >{{ __('Password updated.') }}</p>
            @endif
        </div>
    </form>
</section>
