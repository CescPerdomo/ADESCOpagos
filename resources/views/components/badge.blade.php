@props([
    'type' => 'default',
    'size' => 'md'
])

@php
$types = [
    'default' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
    'success' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
    'warning' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
    'danger' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
    'info' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
];

$sizes = [
    'sm' => 'px-2 py-0.5 text-xs',
    'md' => 'px-2.5 py-0.5 text-sm',
    'lg' => 'px-3 py-1 text-base'
];

$classes = $types[$type] . ' ' . $sizes[$size] . ' inline-flex items-center font-medium rounded-full';
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
