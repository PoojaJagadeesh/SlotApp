<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slots', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('license')->nullable();
            $table->string('vehicle_number');
            $table->dateTime('booking_start')->useCurrent();
            $table->dateTime('booking_end')->nullable();
           
            $table->foreignId('parkslot_id')->constrained()->cascadeOnDelete();
          //  ->references('id')->on('parkslots')->onDelete('cascade');
            $table->string('appintment_number')->nullable();
            $table->decimal('fee', $precision = 8, $scale = 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slots');
    }
};
