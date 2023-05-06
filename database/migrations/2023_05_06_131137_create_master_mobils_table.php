<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterMobilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_mobils', function (Blueprint $table) {
            $table->index('vehicle_id');
            $table->string('machine');
            $table->integer('passenger_capacity');
            $table->string('type');
            $table->string('created_by');
            $table->string('updated_by');
            $table->string('is_active');
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
        Schema::dropIfExists('master_mobils');
    }
}
