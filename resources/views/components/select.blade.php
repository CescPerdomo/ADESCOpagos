@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) !!}>
    {{ $slot }}
</select>

@pushOnce('components-css')
<style>
    select option {
        @apply bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100;
    }
    
    select:disabled {
        @apply opacity-50 cursor-not-allowed;
    }
    
    select:focus {
        @apply outline-none ring-2 ring-offset-2 ring-indigo-500 dark:ring-offset-gray-800;
    }
</style>
@endPushOnce
