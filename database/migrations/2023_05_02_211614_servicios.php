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

        Schema::create('servicios', function (Blueprint $table) {
            $table->engine="InnoDB"; 
            $table->bigIncrements('id');
            $table->bigInteger('categoria_id')->unsigned();
            $table->string('nombre');
            $table->decimal('precio', 8, 2)->default(0);
            $table->timestamps();
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete("cascade");
    
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
