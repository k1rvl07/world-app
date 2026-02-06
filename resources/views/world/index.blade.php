@extends("layouts.app")

@section("content")
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Countries</h1>
    <p class="text-gray-600 mt-2">Explore countries and their cities</p>
</div>

<form method="GET" action="{{ route('world.index') }}" class="mb-6 bg-white rounded-lg shadow-md p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div>
            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}"
                   placeholder="Country name..."
                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border px-4 py-2 bg-white text-gray-900">
        </div>
        <div>
            <label for="continent" class="block text-sm font-medium text-gray-700 mb-1">Continent</label>
            <div class="relative">
                <select name="continent" id="continent" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border px-4 py-2 bg-white text-gray-900 appearance-none cursor-pointer pr-10">
                    <option value="">All Continents</option>
                    @foreach($continents as $continent)
                        <option value="{{ $continent }}" {{ request('continent') == $continent ? 'selected' : '' }}>
                            {{ $continent }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
        </div>
        <div>
            <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
            <div class="relative">
                <select name="sort" id="sort" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border px-4 py-2 bg-white text-gray-900 appearance-none cursor-pointer pr-10">
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="population" {{ request('sort') == 'population' ? 'selected' : '' }}>Population</option>
                    <option value="area" {{ request('sort') == 'area' ? 'selected' : '' }}>Surface Area</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
        </div>
        <div>
            <label for="direction" class="block text-sm font-medium text-gray-700 mb-1">Order</label>
            <div class="relative">
                <select name="direction" id="direction" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border px-4 py-2 bg-white text-gray-900 appearance-none cursor-pointer pr-10">
                    <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 flex justify-end gap-3">
        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 transition-colors cursor-pointer">
            Apply
        </button>
        @if(request()->has('search') || request()->has('continent') || request()->has('sort') || request()->has('direction'))
            <a href="{{ route('world.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 font-medium rounded-md hover:bg-gray-50 transition-colors">
                Clear
            </a>
        @endif
    </div>
</form>

@if($countries->isEmpty())
    <div class="text-center py-12">
        <p class="text-gray-500 text-lg">No countries found matching your criteria.</p>
        <a href="{{ route('world.index') }}" class="text-indigo-600 hover:text-indigo-800 mt-2 inline-block">
            View all countries
        </a>
    </div>
@else
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($countries as $country)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow flex flex-col">
            <div class="p-6 flex flex-col flex-1 justify-between">
                <div>
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">{{ $country->Name }}</h2>
                            <p class="text-sm text-gray-500 mt-1">{{ $country->Continent }} - {{ $country->Region }}</p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 whitespace-nowrap">
                            {{ number_format($country->Population) }} people
                        </span>
                    </div>

                    <div class="mt-4 space-y-2 text-sm text-gray-600">
                        <p><span class="font-medium">Surface Area:</span> {{ number_format($country->SurfaceArea, 2) }} km²</p>
                        <p><span class="font-medium">Government:</span> {{ $country->GovernmentForm }}</p>
                        <p><span class="font-medium">Cities:</span> {{ $country->cities_count }}</p>
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <a href="{{ route("world.show", $country->Code) }}"
                       class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Learn More
                    </a>
                    <a href="{{ route("world.cities", $country->Code) }}"
                       class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Cities
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="mt-8">
    {{ $countries->links() }}
</div>
@endif
@endsection
