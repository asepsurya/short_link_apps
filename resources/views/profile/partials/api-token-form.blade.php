<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('API Tokens') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('API tokens allow third-party services to authenticate with our application on your behalf. Keep these tokens secure.') }}
        </p>
    </header>

    @if (session('api_token'))
        <div class="p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl">
            <p class="text-sm text-green-700 dark:text-green-300 font-semibold mb-2">{{ __('Your new API token is below. Copy it now, as it will not be shown again.') }}</p>
            <div class="flex items-center gap-2">
                <code class="px-3 py-2 bg-white dark:bg-gray-900 rounded-lg border border-green-300 dark:border-green-700 text-green-600 dark:text-green-400 break-all flex-1">
                    {{ session('api_token') }}
                </code>
            </div>
        </div>
    @endif

    <div class="flex items-center gap-4">
        <form method="post" action="{{ route('profile.token.generate') }}">
            @csrf
            <x-primary-button>{{ __('Generate New Token') }}</x-primary-button>
        </form>

        <form method="post" action="{{ route('profile.token.revoke') }}" onsubmit="return confirm('{{ __('Are you sure you want to revoke all tokens? All your integrations will stop working immediately.') }}')">
            @csrf
            @method('delete')
            <x-danger-button>{{ __('Revoke All Tokens') }}</x-danger-button>
        </form>
    </div>

    @if (session('status') === 'tokens-revoked')
        <p
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="text-sm text-gray-600 dark:text-gray-400"
        >{{ __('All tokens revoked.') }}</p>
    @endif
</section>
