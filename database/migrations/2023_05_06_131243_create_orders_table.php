<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->index('order_number');
            $table->index('vehicle_id');
            $table->string('vehicle_type');
            $table->string('vehicle_price');
            $table->string('customers_name');
            $table->string('customers_address');
            $table->string('created_by');
            $table->string('updated_by');
            $table->string('is_active');
            $table->string('status');
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
        Schema::dropIfExists('orders');
    }
}
