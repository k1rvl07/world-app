<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("countries", function (Blueprint $table) {
            $table->char("Code", 3)->primary();
            $table->char("Name", 52);
            $table->string("Continent", 20)->default("Asia");
            $table->char("Region", 26);
            $table->decimal("SurfaceArea", 10, 2)->default(0.00);
            $table->smallInteger("IndepYear")->nullable();
            $table->integer("Population")->default(0);
            $table->decimal("LifeExpectancy", 3, 1)->nullable();
            $table->decimal("GNP", 10, 2)->nullable();
            $table->decimal("GNPOld", 10, 2)->nullable();
            $table->char("LocalName", 45);
            $table->char("GovernmentForm", 45);
            $table->char("HeadOfState", 60)->nullable();
            $table->integer("Capital")->nullable();
            $table->char("Code2", 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("countries");
    }
};
