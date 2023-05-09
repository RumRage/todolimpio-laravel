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

	    Schema::create('productos', function (Blueprint $table) {
		    $table->engine="InnoDB"; 
		    $table->bigIncrements('id');
		    $table->string('nombre');
            $table->string('descripcion');
            $table->decimal('precio', 8, 2);
            $table->string('proveedor');
            $table->integer('stock')->default(0);
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
