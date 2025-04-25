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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients')
            ->onDelete('set null');
            $table->string('name');
            $table->string('specie'); 
            $table->string('breed'); 
            $table->string('color'); 
            $table->decimal('height',12,3); 
            $table->decimal('weight',12,3); 
            $table->string('gender'); 
            $table->date('birth_date');
            $table->string('father'); 
            $table->string('mother'); 
            $table->text('observations');

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
        Schema::dropIfExists('pets');
    }
};
