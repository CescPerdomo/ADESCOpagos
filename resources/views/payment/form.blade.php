<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Realizar Pago') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="payment-form" class="space-y-6">
                        @csrf
                        
                        <div>
                            <x-input-label for="amount" :value="__('Monto a Pagar')" />
                            <x-text-input id="amount" name="amount" type="number" step="0.01" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Descripción')" />
                            <x-textarea id="description" name="description" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <!-- PayPal Button Container -->
                        <div id="paypal-button-container" class="mt-4"></div>

                        <div class="flex items-center justify-end mt-4">
                            <x-secondary-button type="button" onclick="window.history.back()">
                                {{ __('Cancelar') }}
                            </x-secondary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <!-- PayPal SDK -->
    <script src="https://sandbox.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency={{ config('services.paypal.currency') }}"></script>
    
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                const amount = document.getElementById('amount').value;
                const description = document.getElementById('description').value;

                if (!amount || !description) {
                    alert('Por favor complete todos los campos');
                    return false;
                }

                // Create the order
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: amount
                        },
                        description: description
                    }]
                });
            },
            onApprove: function(data, actions) {
                // Capture the payment
                return actions.order.capture().then(function(details) {
                    // Send the payment details to our backend
                    return fetch('/payment/process', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            order_id: data.orderID,
                            payment_details: details,
                            amount: document.getElementById('amount').value,
                            description: document.getElementById('description').value
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href = '/payment/success?transaction_id=' + data.transaction_id;
                        } else {
                            alert('Error al procesar el pago: ' + data.message);
                        }
                    });
                });
            },
            onError: function(err) {
                alert('Error al procesar el pago: ' + err);
            }
        }).render('#paypal-button-container');
    </script>
    @endpush
</x-app-layout>
