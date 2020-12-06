<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableParametersCarDataPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_parameters_car_data_pivot', function (Blueprint $table) {
            $table->unsignedBigInteger('parameter_id');
            $table->unsignedBigInteger('car_data_id');

            $table->foreign('parameter_id')->references('id')->on('car_parameters')->onDelete('cascade');
            $table->foreign('car_data_id')->references('id')->on('car_data_registry')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_parameters_car_data_pivot');
    }
}
