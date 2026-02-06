<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("cities", function (Blueprint $table) {
            $table->id();
            $table->char("Name", 35);
            $table->char("CountryCode", 3);
            $table->char("District", 20);
            $table->integer("Population")->default(0);
            $table->timestamps();

            $table->foreign("CountryCode")->references("Code")->on("countries")->onDelete("cascade");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("cities");
    }
};
