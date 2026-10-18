<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Vehicle') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('vehicles.store') }}">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Vehicle Name (Example: Daily Car)')" />
                        
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="brand" :value="__('Brand (Example: BMW, Toyota)')" />
                        <x-text-input id="brand" class="block mt-1 w-full" type="text" name="brand" :value="old('brand')" required />
                        <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="model" :value="__('Model (Example:M3 GTR, Mio Soul GT)')" />
                        <x-text-input id="model" class="block mt-1 w-full" type="text" name="model" :value="old('model')" required />
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="year" :value="__('Year (Example:2000)')" />
                        <x-text-input id="year" class="block mt-1 w-full" type="number" name="year" :value="old('year')" required />
                        <x-input-error :messages="$errors->get('year')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="license_plate" :value="__('License Plate (Example:A 1234 BC)')" />
                        <x-text-input id="license_plate" class="block mt-1 w-full" type="text" name="license_plate" :value="old('license_plate')" required />
                        <x-input-error :messages="$errors->get('license_plate')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="intial_odometer" :value="__('Initial Odometer (Example:123000)')" />
                        <x-text-input id="initial_odometer" class="block mt-1 w-full" type="number" name="initial_odometer" :value="old('initial_odometer')" step="0.1" required />
                        <x-input-error :messages="$errors->get('initial_odometer')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4 gap-6">
                        <a href="{{ route('vehicles.index') }}" class="text-gray-600 dark:text-gray-400 hover:underline ">
                            Cancel
                        </a>
                        <x-primary-button>
                            {{ __('Save vehicle') }}
                        </x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>