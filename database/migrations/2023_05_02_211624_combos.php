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
        //

        Schema::create('combos', function (Blueprint $table) {
            $table->engine="InnoDB"; 
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->decimal('precio', 8, 2);
            $table->decimal('descuento', 8, 2)->default(0);
            $table->decimal('precio_final', 8, 2)->default(0);
            $table->timestamps();
            // ...
        });

        Schema::create('combo_servicio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('combo_id');
            $table->foreign('combo_id')->references('id')->on('combos')->onDelete('cascade');
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
        //
    }
};
