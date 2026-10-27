<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="lg:col-span-2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 pb-3 mb-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('vehicles.index') }}" class="p-1 rounded-md text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition" title="Back to Vehicles">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                                    </svg>
                                </a>
                                <h3 class="text-lg font-bold">{{ $vehicle->name }} {{ __('Details') }}</h3>
                            </div>

                            <div class="flex items-center gap-2">
                                @can('update', $vehicle)
                                    <a href="{{ route('vehicles.edit', $vehicle) }}" class="p-2 text-yellow-600 hover:text-yellow-700 dark:text-yellow-400 dark:hover:text-yellow-300 rounded-md hover:bg-yellow-50 dark:hover:bg-yellow-900/30 transition" title="Edit Vehicle">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </a>
                                @endcan
                                
                                @can('delete', $vehicle)
                                    <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" onsubmit="return confirm('Warning: Do you really want to delete {{ $vehicle->name }} permanently?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 rounded-md hover:bg-red-50 dark:hover:bg-red-900/30 transition" title="Delete Vehicle">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Brand</p>
                                <p class="font-semibold">{{ $vehicle->brand }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Model & Year</p>
                                <p class="font-semibold">{{ $vehicle->model }} ({{ $vehicle->year }})</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">License Plate</p>
                                <p class="font-semibold uppercase">{{ $vehicle->license_plate }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Initial Odometer</p>
                                <p class="font-semibold">{{ number_format($vehicle->initial_odometer, 1) }} km</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-data="{ mode: 'overall' }" class="lg:col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 pb-3 mb-4">
                            <h3 class="text-lg font-bold">Fuel Efficiency</h3>
                            
                            <div class="inline-flex rounded-lg bg-gray-100 dark:bg-gray-700 p-1">
                                <button type="button" 
                                        @click="mode = 'overall'"
                                        :class="mode === 'overall' ? 'bg-white dark:bg-gray-800 text-indigo-600 dark:text-indigo-400 shadow' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200'"
                                        class="px-2.5 py-1 text-xs font-semibold rounded-md transition-all">
                                    Overall
                                </button>
                                <button type="button" 
                                        @click="mode = 'latest'"
                                        :class="mode === 'latest' ? 'bg-white dark:bg-gray-800 text-indigo-600 dark:text-indigo-400 shadow' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200'"
                                        class="px-2.5 py-1 text-xs font-semibold rounded-md transition-all">
                                    Latest
                                </button>
                            </div>
                        </div>

                        <div x-show="mode === 'overall'">
                            <p class="text-xs text-indigo-700 dark:text-indigo-400 font-medium uppercase tracking-wider">Overall Average</p>
                            <p class="font-bold text-3xl text-indigo-700 dark:text-indigo-300 mt-1">
                                @if(isset($overallFuelEfficiency) && $overallFuelEfficiency)
                                    {{ $overallFuelEfficiency }} <span class="text-base font-normal">Km/L</span>
                                @else
                                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Need 2 Full Tanks</span>
                                @endif
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Calculated across all historical refueling logs.</p>
                        </div>

                        <div x-show="mode === 'latest'" style="display: none;">
                            <p class="text-xs text-indigo-600 dark:text-indigo-400 font-medium uppercase tracking-wider">Latest Trip</p>
                            <p class="font-bold text-3xl text-indigo-700 dark:text-indigo-300 mt-1">
                                @if(isset($latestFuelEfficiency) && $latestFuelEfficiency)
                                    {{ $latestFuelEfficiency }} <span class="text-base font-normal">Km/L</span>
                                @else
                                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Need 2 Full Tanks</span>
                                @endif
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Calculated between the two most recent full tank fills.</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Fuel Log History</h3>
                    
                    <a href="{{ route('fuel-logs.create', ['vehicle_id' => $vehicle->id]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        + Log Fuel
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Odometer</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Volume (L)</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Price/L</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total cost</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($vehicle->fuelLogs->sortByDesc('date') as $log)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $log->date->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ number_format($log->odometer, 1) }} km
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ number_format($log->liters, 2) }} L
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        Rp {{ number_format($log->price_per_liter, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        Rp {{ number_format($log->total_cost, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($log->is_full_tank)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Full Tank</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">Partial</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end gap-3">
                                            @can('update', $log)
                                                <a href="{{ route('fuel-logs.edit', $log) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">Edit</a>
                                            @endcan
                                            
                                            @can('delete', $log)
                                                <form action="{{ route('fuel-logs.destroy', $log) }}" method="POST" onsubmit="return confirm('Delete this Fuel Log?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                        There's no fuel log for this vehicle.<br>
                                        Start refueling now!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>