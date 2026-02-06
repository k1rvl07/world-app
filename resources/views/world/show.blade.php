@extends("layouts.app")

@section("content")
<div class="mb-6">
    <a href="{{ route('world.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Countries
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $country->Name }}</h1>
                <p class="text-lg text-gray-500 mt-1">{{ $country->Continent }} - {{ $country->Region }}</p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 whitespace-nowrap">
                {{ number_format($country->Population) }} people
            </span>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Geography</h3>
                <dl class="mt-3 space-y-2">
                    <div>
                        <dt class="text-xs text-gray-500">Surface Area</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ number_format($country->SurfaceArea, 2) }} km²</dd>
                    </div>
                    @if($country->IndepYear)
                    <div>
                        <dt class="text-xs text-gray-500">Independence Year</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $country->IndepYear }}</dd>
                    </div>
                    @endif
                </dl>
            </div>

            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Government</h3>
                <dl class="mt-3 space-y-2">
                    <div>
                        <dt class="text-xs text-gray-500">Government Form</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $country->GovernmentForm }}</dd>
                    </div>
                    @if($country->HeadOfState)
                    <div>
                        <dt class="text-xs text-gray-500">Head of State</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $country->HeadOfState }}</dd>
                    </div>
                    @endif
                </dl>
            </div>

            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Economy</h3>
                <dl class="mt-3 space-y-2">
                    <div>
                        <dt class="text-xs text-gray-500">GNP</dt>
                        <dd class="text-lg font-medium text-gray-900">${{ number_format($country->GNP) }}</dd>
                    </div>
                    @if($country->GNPOld)
                    <div>
                        <dt class="text-xs text-gray-500">GNP (Old)</dt>
                        <dd class="text-lg font-medium text-gray-900">${{ number_format($country->GNPOld) }}</dd>
                    </div>
                    @endif
                </dl>
            </div>
        </div>
    </div>
</div>

<div class="mt-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-900">Languages</h2>
        <span class="text-sm text-gray-500">{{ $country->languages->count() }} languages</span>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($country->languages as $language)
            <div class="bg-white rounded-lg shadow-md p-4 flex justify-between items-center">
                <span class="font-medium text-gray-900">{{ $language->Language }}</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $language->IsOfficial === 'T' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800' }}">
                    {{ $language->IsOfficial === 'T' ? 'Official' : 'Spoken' }}
                    <span class="ml-1 text-gray-500">({{ $language->Percentage }}%)</span>
                </span>
            </div>
        @endforeach
    </div>
</div>

<div class="mt-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-900">Cities</h2>
        <a href="{{ route('world.cities', $country->Code) }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800">
            View all {{ $country->cities->count() }} cities
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($country->cities->take(6) as $city)
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="font-semibold text-gray-900">{{ $city->Name }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ number_format($city->Population) }} people</p>
                @if($city->District)
                    <p class="text-xs text-gray-400 mt-1">{{ $city->District }}</p>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
