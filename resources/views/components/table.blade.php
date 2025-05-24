<div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
    <table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-gray-300 dark:divide-gray-700']) }}>
        @isset($head)
            <thead class="bg-gray-50 dark:bg-gray-800">
                {{ $head }}
            </thead>
        @endisset

        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900">
            {{ $slot }}
        </tbody>

        @isset($foot)
            <tfoot class="bg-gray-50 dark:bg-gray-800">
                {{ $foot }}
            </tfoot>
        @endisset
    </table>
</div>

@pushOnce('components-css')
<style>
    .table-row {
        @apply hover:bg-gray-50 dark:hover:bg-gray-800/50;
    }
    .table-cell {
        @apply px-3 py-4 text-sm text-gray-500 dark:text-gray-400;
    }
    .table-header {
        @apply px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100;
    }
    .table-footer {
        @apply px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100;
    }
</style>
@endPushOnce
