<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Vehicles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-6">
                    <a href="{{ route('vehicles.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"> 
                        + Add 
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-gray-900 dark:text-gray-100 border-collapse">
                        <thead>
                            <tr class="border-b border-gray-300 dark:border-gray-700">
                                <th class="p-3 text-left">Name</th>
                                <th class="p-3 text-left">Brand</th>
                                <th class="p-3 text-left">Model</th>
                                <th class="p-3 text-left">Year</th>
                                <th class="p-3 text-left">License Plate</th>
                                <th class="p-3 text-left">Initial Odometer</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($vehicles as $vehicle)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="p-3">
                                        <a href="{{ route('vehicles.show', $vehicle) }}" class="text-blue-500 hover:underline"> 
                                            {{ $vehicle->name }} 
                                        </a>
                                    </td>
                                    <td class="p-3">{{ $vehicle->brand }}</td>
                                    <td class="p-3">{{ $vehicle->model }}</td>
                                    <td class="p-3">{{ $vehicle->year }}</td>
                                    <td class="p-3">{{ $vehicle->license_plate }}</td>
                                    <td class="p-3">{{ $vehicle->initial_odometer }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-6 text-center text-gray-500">No Vehicle Added.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>