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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('name');
            $table->string('firstname')->after('username');
            $table->string('lastname')->after('firstname');
            $table->integer('age')->nullable()->after('lastname');
            $table->string('contactNumber')->nullable()->after('age');
            $table->string('address')->nullable()->after('contactNumber');
            $table->integer('busID')->nullable()->after('address');
            
            $table->foreign('busID')->references('busID')->on('buses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['busID']);
            $table->dropColumn(['username', 'firstname', 'lastname', 'age', 'contactNumber', 'address', 'busID']);
        });
    }
};
