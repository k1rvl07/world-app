<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CountryController extends Controller
{
    public function index(Request $request): View
    {
        $query = Country::query()
            ->withCount('cities');

        if ($request->filled('search')) {
            $query->where('Name', 'ilike', '%'.$request->search.'%');
        }

        if ($request->filled('continent')) {
            $query->where('Continent', $request->continent);
        }

        $sort = $request->get('sort', 'Name');
        $direction = $request->get('direction', 'asc');

        $sortMap = [
            'name' => 'Name',
            'population' => 'Population',
            'area' => 'SurfaceArea',
        ];

        $sortColumn = $sortMap[$sort] ?? 'Name';
        $direction = in_array($direction, ['asc', 'desc']) ? $direction : 'asc';

        $continents = Country::distinct()->pluck('Continent')->sort();

        $countries = $query
            ->orderBy($sortColumn, $direction)
            ->paginate(12)
            ->appends($request->query());

        return view('world.index', compact('countries', 'continents'));
    }

    public function show(string $code): View
    {
        $country = Country::where('Code', $code)->firstOrFail();

        $country->load(['cities' => function ($query) {
            $query->orderBy('Population', 'desc');
        }]);

        $country->languages = $country->languages()->orderBy('Percentage', 'desc')->get();

        return view('world.show', compact('country'));
    }

    public function cities(string $code): View
    {
        $country = Country::where('Code', $code)->firstOrFail();

        $cities = City::where('CountryCode', $code)
            ->orderBy('Population', 'desc')
            ->paginate(20);

        return view('city.index', compact('country', 'cities'));
    }
}
