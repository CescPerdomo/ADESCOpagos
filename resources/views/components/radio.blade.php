@props(['disabled' => false, 'label' => null, 'name' => null])

<div class="flex items-center">
    <input 
        type="radio" 
        name="{{ $name }}"
        {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge([
            'class' => 'border-gray-300 dark:border-gray-700 text-indigo-600 dark:text-indigo-500 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:bg-gray-900 dark:checked:bg-indigo-500'
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
    input[type="radio"] {
        @apply rounded-full;
    }

    input[type="radio"]:checked {
        background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e");
    }

    input[type="radio"]:disabled {
        @apply opacity-50 cursor-not-allowed;
    }

    input[type="radio"]:focus {
        @apply outline-none ring-2 ring-offset-2 ring-indigo-500 dark:ring-offset-gray-800;
    }

    input[type="radio"]:checked:focus {
        @apply ring-2 ring-offset-2 ring-indigo-500 dark:ring-offset-gray-800;
    }
</style>
@endPushOnce
