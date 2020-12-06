<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParameterInsuranceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameter_insurance', function (Blueprint $table) {
            $table->unsignedBigInteger('parameter_id');
            $table->unsignedBigInteger('insurance_id');

            $table->foreign('parameter_id')->references('id')->on('car_parameters')->onDelete('cascade');
            $table->foreign('insurance_id')->references('id')->on('insurance_plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parameter_insurance');
    }
}
