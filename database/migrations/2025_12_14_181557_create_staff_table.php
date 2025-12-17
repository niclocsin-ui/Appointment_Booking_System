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
    // IMPORTANT: Table name is 'staff'
    Schema::create('staff', function (Blueprint $table) {
        // IMPORTANT: Column name must be 'StaffID'
        $table->id('StaffID'); 
        
        $table->string('FirstName');
        $table->string('LastName');
        $table->string('Role');
        $table->string('Email')->unique();
        $table->string('Phone');
        $table->string('Password');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
