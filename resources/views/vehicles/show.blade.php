<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $vehicle->name }} {{ __('Details') }}
            </h2>
            <!--- button -->
            <div class="flex gap-4">
                <x-link-button :href="route('vehicles.index')">
                    Return
                </x-link-button>
                @can('update', $vehicle)

                    <x-warning-button :href="route('vehicles.edit', $vehicle)">
                        Edit
                    </x-warning-button>
                @endcan
                @can('delete', $vehicle)
                    <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" onsubmit="return confirm('Warning: Do you really want to delete {{ $vehicle->name }} permanently?');">
                        @csrf
                        @method('DELETE')
                        <x-danger-button type="submit" class="px-4 py-2 bg-red-600 text-white font-semibold rounded-md hover:bg-red-700 transition">
                            Delete
                        </x-danger-button>
                    </form>
                @endcan
            </div>
        </div>
    </x-slot>
</x-app-layout>