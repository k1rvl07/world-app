<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    protected $table = "cities";
    public $timestamps = true;

    protected $fillable = [
        "Name",
        "CountryCode",
        "District",
        "Population",
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, "CountryCode", "Code");
    }
}
