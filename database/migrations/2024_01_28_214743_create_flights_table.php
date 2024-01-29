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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plane_id');
            $table->unsignedBigInteger('airport_origin_id');
            $table->unsignedBigInteger('airport_destination_id');
            $table->date('date');
            $table->time('time_duration');
            $table->time('hour_output');
            $table->time('arrival_time');
            $table->double('old_price', 10, 2);
            $table->double('price', 10, 2);
            $table->integer('total_plots');
            $table->boolean('is_promotion')->default(false);
            $table->string('image', 200)->default(false);
            $table->integer('qts_stops')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('plane_id')->references('id')->on('planes')->onDelete('cascade');
            $table->foreign('airport_origin_id')->references('id')->on('airports')->onDelete('cascade');
            $table->foreign('airport_destination_id')->references('id')->on('airports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
