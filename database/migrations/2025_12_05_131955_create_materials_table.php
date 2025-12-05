<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->timestamps();
        });

        DB::table('materials')->insert([
            ['name_ar' => 'ذهب', 'name_en' => 'Gold'],
            ['name_ar' => 'فضة', 'name_en' => 'Silver'],
            ['name_ar' => 'بلاتين', 'name_en' => 'Platinum'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
