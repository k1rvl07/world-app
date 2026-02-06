<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CountryLanguage extends Model
{
    protected $table = "countrylanguages";
    public $timestamps = true;
    public $incrementing = false;
    protected $keyType = "string";

    protected $fillable = [
        "CountryCode",
        "Language",
        "IsOfficial",
        "Percentage",
    ];

    protected function casts(): array
    {
        return [
            "Percentage" => "decimal:1",
        ];
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, "CountryCode", "Code");
    }
}
