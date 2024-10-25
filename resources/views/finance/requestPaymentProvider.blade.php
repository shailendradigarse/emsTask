<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Request New Payment Provider') }}
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
                    <form id="paymentProviderRequestForm" action="{{ route('paymentProviderRequests.store') }}" method="POST">
                        @csrf
                        <!-- Payment Method Name -->
                        <div class="mb-4">
                            <label for="payment_method_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Payment Method Name
                            </label>
                            <input type="text" name="payment_method_name" id="payment_method_name" placeholder="Enter payment method name"
                                class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-gray-300"
                                required>
                        </div>

                        <!-- Website -->
                        <div class="mb-4">
                            <label for="website" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Website
                            </label>
                            <input type="url" name="website" id="website" placeholder="https://example.com"
                                class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-gray-300">
                        </div>

                        <!-- Event -->
                        <div class="mb-4">
                            <label for="event_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Event
                            </label>
                            <select name="event_id" id="event_id"
                                class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-gray-300">
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Company -->
                        <div class="mb-4">
                            <label for="company_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Company
                            </label>
                            <select name="company_id" id="company_id"
                                class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-gray-300">
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-500 dark:hover:bg-indigo-600">
                                Submit Request
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
            $("#paymentProviderRequestForm").validate({
                rules: {
                    payment_method_name: {
                        required: true,
                        minlength: 2
                    },
                    website: {
                        required: true,
                        url: true
                    },
                    event_id: {
                        required: true
                    },
                    company_id: {
                        required: true
                    }
                },
                messages: {
                    payment_method_name: {
                        required: "Please enter the payment method name.",
                        minlength: "Payment method name must be at least 2 characters long."
                    },
                    website: {
                        required: "Please enter the website url.",
                        url: "Please enter a valid URL."
                    },
                    event_id: "Please select an event.",
                    company_id: "Please select a company."
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
