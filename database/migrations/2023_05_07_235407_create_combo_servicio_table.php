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
    Schema::create('combo_servicio', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('combo_id');
        $table->foreign('combo_id')->references('id')->on('combos');
        $table->unsignedBigInteger('servicio_id');
        $table->foreign('servicio_id')->references('id')->on('servicios');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combo_servicio');
    }
};
