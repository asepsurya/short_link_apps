<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-red-600 dark:text-red-500">
            {{ __('Danger Zone') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center gap-2 py-2.5 px-6 rounded-xl bg-red-50 text-red-600 text-sm font-semibold hover:bg-red-100 dark:bg-red-900/20 dark:text-red-400 dark:hover:bg-red-900/40 transition-colors border border-red-100 dark:border-red-900/30"
    >
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-white dark:bg-[#121217]">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                {{ __('Delete Account permanently?') }}
            </h2>

            <p class="mt-3 text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                {{ __('This action cannot be undone. All your short links and analytics data will be lost forever. Please enter your password to confirm.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">{{ __('Password') }}</label>
                <input id="password" name="password" type="password" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-red-500 focus:ring-red-500 rounded-xl py-3 px-4 text-sm" placeholder="{{ __('Password') }}">
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-8 flex flex-col sm:flex-row justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="py-2.5 px-6 rounded-xl text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors order-2 sm:order-1">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="py-2.5 px-6 rounded-xl bg-red-600 text-white text-sm font-semibold hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors shadow-sm order-1 sm:order-2">
                    {{ __('Permanently Delete') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
