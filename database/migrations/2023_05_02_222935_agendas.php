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

        Schema::create('agendas', function (Blueprint $table) {
            $table->engine="InnoDB"; 
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('telefono');
            $table->string('direccion');
            $table->dateTime('fecha_hora')->nullable();
            $table->unsignedBigInteger('combo_ids')->nullable();
            $table->decimal('precio', 8, 2);
            $table->decimal('descuento', 8, 2)->default(0);
            $table->decimal('precio_final', 8, 2)->default(0);
            $table->enum('metodo_pago', ['Efectivo', 'Transferencia']);
            $table->enum('estado', ['Hecho', 'Pendiente', 'Cancelado'])->default('Pendiente');
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
