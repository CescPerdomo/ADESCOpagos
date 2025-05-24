<div {{ $attributes->merge(['class' => 'md:flex md:items-center md:justify-between']) }}>
    <div class="flex-1 min-w-0">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-gray-100 sm:text-3xl sm:truncate">
            {{ $title }}
        </h2>
        @if(isset($description))
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                {{ $description }}
            </p>
        @endif
    </div>
    @if(isset($actions))
        <div class="mt-4 flex md:mt-0 md:ml-4">
            {{ $actions }}
        </div>
    @endif
</div>
