<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Add Fuel Log') }} - {{ $vehicle->name }}
            </h2>
            <x-link-button :href="route('vehicles.show', $vehicle)">
                Return
            </x-link-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('fuel-logs.store') }}" class="space-y-6">
                        @csrf
                        
                        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <x-input-label for="date" :value="__('Date')" />
                                <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" :value="old('date', date('Y-m-d'))" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('date')" />
                            </div>

                            <div>
                                <x-input-label for="odometer" :value="__('Odometer (km)')" />
                                <x-text-input id="odometer" name="odometer" type="number" step="0.1" class="mt-1 block w-full" :value="old('odometer')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('odometer')" />
                            </div>

                            <div>
                                <x-input-label for="liters" :value="__('Liters')" />
                                <x-text-input id="liters" name="liters" type="number" step="0.01" class="mt-1 block w-full" :value="old('liters')" required oninput="calculateTotal()" />
                                <x-input-error class="mt-2" :messages="$errors->get('liters')" />
                            </div>

                            <div>
                                <x-input-label for="price_per_liter" :value="__('Price per Liter')" />
                                <x-text-input id="price_per_liter" name="price_per_liter" type="number" step="0.01" class="mt-1 block w-full" :value="old('price_per_liter')" required oninput="calculateTotal()" />
                                <x-input-error class="mt-2" :messages="$errors->get('price_per_liter')" />
                            </div>

                            <div>
                                <x-input-label for="total_cost" :value="__('Total Cost')" />
                                <x-text-input id="total_cost" name="total_cost" type="number" step="0.01" class="mt-1 block w-full bg-gray-50 dark:bg-gray-700" :value="old('total_cost')" required readonly />
                                <x-input-error class="mt-2" :messages="$errors->get('total_cost')" />
                                <p class="text-xs text-gray-500 mt-1">Auto-calculated (Liters × Price)</p>
                            </div>

                            <div class="flex items-center pt-6">
                                <input id="is_full_tank" type="checkbox" name="is_full_tank" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" {{ old('is_full_tank') ? 'checked' : '' }}>
                                <label for="is_full_tank" class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Full Tank?') }}
                                </label>
                            </div>
                        </div>

                        <div>
                            <x-input-label for="notes" :value="__('Notes (Optional)')" />
                            <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('notes') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('notes')" />
                        </div>

                        <div class="flex items-center justify-end mt-4 gap-4">
                            <x-primary-button>
                                {{ __('Save Fuel Log') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calculateTotal() {
            let liters = parseFloat(document.getElementById('liters').value) || 0;
            let price = parseFloat(document.getElementById('price_per_liter').value) || 0;
            document.getElementById('total_cost').value = (liters * price).toFixed(2);
        }
    </script>
</x-app-layout>