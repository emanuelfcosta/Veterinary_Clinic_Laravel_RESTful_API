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
        Schema::create('consultations_procedures', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('procedure_id');
            $table->foreign('procedure_id')
                  ->references('id')
                  ->on('procedures')->onDelete('cascade');

            $table->unsignedBigInteger('consultation_id');
            $table->foreign('consultation_id')
                ->references('id')
                ->on('consultations')->onDelete('cascade');
                
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
        Schema::dropIfExists('consultations_procedures');
    }
};
