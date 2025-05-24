<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pago Exitoso') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-center">
                        <!-- Ícono de éxito -->
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>

                        <h3 class="text-lg font-medium text-gray-900 mb-4">
                            ¡Pago Procesado Exitosamente!
                        </h3>

                        <!-- Detalles de la transacción -->
                        <div class="mt-8 border-t border-gray-200 pt-8">
                            <dl class="divide-y divide-gray-200">
                                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">ID de Transacción</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                        {{ $transaction->id }}
                                    </dd>
                                </div>

                                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">Monto</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                        {{ number_format($transaction->amount, 2) }} {{ $transaction->currency }}
                                    </dd>
                                </div>

                                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">Método de Pago</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                        {{ ucfirst($transaction->payment_method) }}
                                    </dd>
                                </div>

                                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">Número de Recibo</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                        {{ $transaction->receipt->receipt_number }}
                                    </dd>
                                </div>

                                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">Fecha</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                        {{ $transaction->created_at->format('d/m/Y H:i:s') }}
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Botones de acción -->
                        <div class="mt-8 flex justify-center space-x-4">
                            <x-primary-button onclick="window.location.href='{{ route('dashboard') }}'">
                                {{ __('Volver al Dashboard') }}
                            </x-primary-button>

                            @if($transaction->receipt)
                                <x-secondary-button onclick="window.location.href='{{ route('receipt.download', $transaction->receipt->id) }}'">
                                    {{ __('Descargar Recibo') }}
                                </x-secondary-button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
