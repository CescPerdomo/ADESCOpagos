<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Control') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Sección de Pagos -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                        {{ __("Realizar Pago") }}
                    </h2>
                    <p class="text-gray-600 mb-4">
                        {{ __("Realiza pagos de forma segura utilizando PayPal.") }}
                    </p>
                    <div class="mt-4">
                        <x-primary-button onclick="window.location.href='{{ route('payment.form') }}'">
                            {{ __("Realizar Pago") }}
                        </x-primary-button>
                    </div>
                </div>
            </div>

            <!-- Formulario de Validación de Recibo -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Validar Recibo</h3>
                    <form id="validateReceiptForm" class="space-y-4">
                        <div>
                            <label for="receipt_number" class="block text-sm font-medium text-gray-700">Número de Recibo</label>
                            <input type="text" name="receipt_number" id="receipt_number" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                   required maxlength="6" pattern="[0-9]{6}">
                        </div>
                        <div>
                            <label for="birth_date" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                            <input type="date" name="birth_date" id="birth_date" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                   required>
                        </div>
                        <div>
                            <button type="submit" 
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Validar Recibo
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Transacciones del Usuario -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tus Transacciones</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No. Recibo
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Monto
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Estado
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fecha
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse(auth()->user()->receipts as $receipt)
                                    @if($receipt->transaction)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $receipt->receipt_number }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                ${{ number_format($receipt->transaction->amount, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $receipt->transaction->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                                    {{ $receipt->transaction->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                    {{ $receipt->transaction->status === 'failed' ? 'bg-red-100 text-red-800' : '' }}">
                                                    {{ ucfirst($receipt->transaction->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $receipt->transaction->created_at->format('M d, Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if($receipt->transaction->status === 'completed')
                                                    <a href="{{ route('payment.pdf', $receipt->transaction) }}" 
                                                       class="text-indigo-600 hover:text-indigo-900">
                                        Descargar PDF
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            No se encontraron transacciones.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('validateReceiptForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = {
                receipt_number: document.getElementById('receipt_number').value,
                birth_date: document.getElementById('birth_date').value,
            };

            try {
                const response = await fetch('{{ route("receipt.validate") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(formData)
                });

                const data = await response.json();

                if (response.ok) {
                    // Create payment
                    const paymentResponse = await fetch('{{ route("payment.create") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ receipt_id: data.id })
                    });

                    const paymentData = await paymentResponse.json();

                    if (paymentResponse.ok) {
                        window.location.href = paymentData.approval_url;
                    } else {
                        alert('Error creating payment: ' + paymentData.error);
                    }
                } else {
                    alert('Invalid receipt details: ' + data.error);
                }
            } catch (error) {
                alert('Error processing request: ' + error.message);
            }
        });
    </script>
    @endpush
</x-app-layout>
