<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('appointments', function (Blueprint $table) {
        $table->id('AppointmentID');

        // 1. Create the columns
        $table->unsignedBigInteger('ClientID');
        $table->unsignedBigInteger('StaffID')->nullable(); // Nullable allowed
        $table->unsignedBigInteger('ServiceID');
        
        $table->date('AppointmentDate');
        $table->time('AppointmentTime');
        $table->string('Status')->default('Scheduled');
        $table->timestamps();

        // 2. Define the Relationships (Foreign Keys)
        // These link the columns created above ^ to the ID columns in the other tables.
        
        $table->foreign('ClientID')
              ->references('ClientID') // This looks for 'ClientID' in the clients table
              ->on('clients')
              ->onDelete('cascade');

        $table->foreign('StaffID')
              ->references('StaffID') // This looks for 'StaffID' in the staff table
              ->on('staff')
              ->onDelete('set null');

        $table->foreign('ServiceID')
              ->references('ServiceID') // This looks for 'ServiceID' in the services table
              ->on('services')
              ->onDelete('cascade');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::create('appointments');
      $table->foreign('ClientID')->references('ClientID')->on('clients')->onDelete('cascade');
      $table->foreign('StaffID')->references('StaffID')->on('staff')->onDelete('set null');
    }
};