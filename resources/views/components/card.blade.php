@props(['header' => null, 'footer' => null])

<div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg']) }}>
    @if($header)
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
            {{ $header }}
        </div>
    @endif

    <div class="p-6 text-gray-900 dark:text-gray-100">
        {{ $slot }}
    </div>

    @if($footer)
        <div class="px-4 py-4 sm:px-6 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-200 dark:border-gray-700">
            {{ $footer }}
        </div>
    @endif
</div>
