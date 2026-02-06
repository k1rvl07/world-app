<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("countrylanguages", function (Blueprint $table) {
            $table->char("CountryCode", 3);
            $table->char("Language", 30);
            $table->string("IsOfficial", 1)->default("F");
            $table->decimal("Percentage", 4, 1)->default(0.0);
            $table->timestamps();

            $table->primary(["CountryCode", "Language"]);
            $table->foreign("CountryCode")->references("Code")->on("countries")->onDelete("cascade");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("countrylanguages");
    }
};
