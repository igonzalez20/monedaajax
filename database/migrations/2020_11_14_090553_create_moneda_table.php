<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonedaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moneda', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40);
            $table->string('symbol', 3);
            $table->string('country', 60);
            $table->decimal('value', 6, 5);
            $table->date('date')->nullable();
            $table->timestamps();
            
             $table->unique(['name', 'country']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moneda');
    }
}
