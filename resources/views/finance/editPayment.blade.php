<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Payment for ') . $event->name }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('error'))
                <div id="flash-message" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>

                </div>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <form id="paymentProviderForm" action="{{ route('finance.updatePayment', $event->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Payment Method -->
                        <div class="mb-4">
                            <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Payment Method
                            </label>
                            <select name="payment_method" id="payment_method" class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-gray-300">
                                @foreach($paymentMethods as $paymentMethod)
                                    <option value="{{ $paymentMethod->id }}" {{ $eventPayment && $eventPayment->payment_method_id == $paymentMethod->id ? 'selected' : '' }}>
                                        {{ $paymentMethod->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- VAT Rate -->
                        <div class="mb-4">
                            <label for="vat_rate" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                VAT Rate
                            </label>
                            <input type="number" name="vat_rate" id="vat_rate" step="0.01" value="{{ old('vat_rate', $eventPayment->vat_rate ?? '') }}"
                                class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-gray-300" />
                        </div>

                        <!-- Company -->
                        <div class="mb-4">
                            <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Company
                            </label>
                            <select name="company" id="company" class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-gray-300">
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ $eventPayment && $eventPayment->company_id == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-500 dark:hover:bg-indigo-600">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#paymentProviderForm").validate({
                rules: {
                    payment_method: {
                        required: true
                    },
                    vat_rate: {
                        required: true,
                        number: true
                    },
                    company: {
                        required: true
                    }
                },
                messages: {
                    payment_method: "Please select a payment method.",
                    vat_rate: {
                        required: "Please enter the VAT rate.",
                        number: "Please enter a valid number."
                    },
                    company: "Please select a company."
                },
                errorElement: "span",
                errorClass: "text-red-500 text-sm",
                validClass: "text-green-500 text-sm",
                highlight: function(element) {
                    $(element).addClass("border-red-500");
                },
                unhighlight: function(element) {
                    $(element).removeClass("border-red-500");
                }
            });
        });
    </script>
    <script>
        // Auto-dismiss the flash message after 5 seconds
        setTimeout(() => {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.remove();
            }
        }, 5000);

        // Ensure close button works

    </script>
</x-app-layout>
