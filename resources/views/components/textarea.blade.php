@props(['disabled' => false, 'rows' => 4])

<textarea 
    rows="{{ $rows }}"
    {{ $disabled ? 'disabled' : '' }} 
    {!! $attributes->merge([
        'class' => 'block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm resize-y'
    ]) !!}
>{{ $slot }}</textarea>

@pushOnce('components-css')
<style>
    textarea:disabled {
        @apply opacity-50 cursor-not-allowed;
    }
    
    textarea:focus {
        @apply outline-none ring-2 ring-offset-2 ring-indigo-500 dark:ring-offset-gray-800;
    }

    textarea::placeholder {
        @apply text-gray-400 dark:text-gray-600;
    }
</style>
@endPushOnce
