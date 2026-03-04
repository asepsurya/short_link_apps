<section>
    <header>
        <h2 class="text-lg font-bold text-gray-900 dark:text-white">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-8 space-y-6">
        @csrf
        @method('patch')

        <!-- Profile Photo -->
        <div class="flex items-center gap-6 mb-8 p-4 bg-gray-50 dark:bg-[#1A1A22] rounded-2xl border border-gray-100 dark:border-gray-800">
            <div class="relative group">
                <div class="w-20 h-20 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400 font-bold text-2xl border-4 border-white dark:border-gray-800 shadow-md overflow-hidden">
                    @if($user->avatar_url)
                        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                    @else
                        {{ substr($user->name, 0, 1) }}
                    @endif
                </div>
            </div>
            <div class="flex-1">
                <label for="avatar" class="block text-sm font-semibold text-gray-900 dark:text-white mb-1.5">Profile Photo</label>
                <input type="file" name="avatar" id="avatar" class="block w-full text-xs text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 dark:file:bg-purple-900/30 dark:file:text-purple-400 transition-all cursor-pointer">
                <p class="mt-1.5 text-[10px] text-gray-500 dark:text-gray-500">JPG, PNG or WebP. Max 2MB.</p>
                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Name') }}</label>
                <input id="name" name="name" type="text" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm transition-colors" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Email') }}</label>
                <input id="email" name="email" type="email" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm transition-colors" value="{{ old('email', $user->email) }}" required autocomplete="username">
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="underline text-purple-600 hover:text-purple-700 dark:text-purple-400 dark:hover:text-purple-300 focus:outline-none">
                                {{ __('Click here to re-send verification.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-xs text-green-600 dark:text-green-400">
                                {{ __('Verification link sent.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-50 dark:border-gray-800">
            <button type="submit" class="inline-flex items-center gap-2 py-2.5 px-6 rounded-xl bg-purple-600 text-white text-sm font-semibold hover:bg-purple-700 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors shadow-sm">
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400 font-medium"
                >{{ __('Settings saved.') }}</p>
            @endif
        </div>
    </form>
</section>
