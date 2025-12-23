<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->integer('busID')->primary();
            $table->string('route');
            $table->integer('passengerCapacity');
            $table->integer('passengerTotal')->default(0);
            $table->timestamp('routeTimeDate')->nullable();
            $table->timestamps();
            
            $table->foreign('route')->references('routeID')->on('routes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
