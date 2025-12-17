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
    // IMPORTANT: Table name must be 'clients' (PLURAL), not 'client'
    Schema::create('clients', function (Blueprint $table) {
        // IMPORTANT: Column name must be 'ClientID', not 'id'
        $table->id('ClientID'); 
        
        $table->string('FirstName');
        $table->string('LastName');
        $table->string('Email')->unique();
        $table->string('Password');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
