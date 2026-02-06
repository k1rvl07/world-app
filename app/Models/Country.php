<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $table = "countries";
    protected $keyType = "string";
    public $incrementing = false;

    protected $fillable = [
        "Code",
        "Name",
        "Continent",
        "Region",
        "SurfaceArea",
        "IndepYear",
        "Population",
        "LifeExpectancy",
        "GNP",
        "GNPOld",
        "LocalName",
        "GovernmentForm",
        "HeadOfState",
        "Capital",
        "Code2",
    ];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, "CountryCode", "Code");
    }

    public function languages(): HasMany
    {
        return $this->hasMany(CountryLanguage::class, "CountryCode", "Code");
    }
}
