@props(['disabled' => false, 'label' => null])

<div class="flex items-center">
    <input 
        type="checkbox" 
        {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge([
            'class' => 'rounded border-gray-300 dark:border-gray-700 text-indigo-600 dark:text-indigo-500 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:bg-gray-900 dark:checked:bg-indigo-500'
        ]) !!}
    >
    
    @if($label)
        <label class="ml-2 block text-sm text-gray-900 dark:text-gray-100" for="{{ $attributes->get('id') }}">
            {{ $label }}
        </label>
    @endif
</div>

@pushOnce('components-css')
<style>
    input[type="checkbox"]:checked {
        background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e");
    }

    input[type="checkbox"]:disabled {
        @apply opacity-50 cursor-not-allowed;
    }

    input[type="checkbox"]:focus {
        @apply outline-none ring-2 ring-offset-2 ring-indigo-500 dark:ring-offset-gray-800;
    }
</style>
@endPushOnce
