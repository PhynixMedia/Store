<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebStoreOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_store_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('order_code');
            $table->string('barcode')->nullable();
            $table->dateTime('shipped_date')->default(now());
            $table->string('pickup')->nullable();
            $table->integer('payment_option_id');
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('delivery_charge', 10, 2)->default(0);
            $table->integer('address_id');
            $table->text('comment')->nullable();
            $table->string('order_source');
            $table->integer('status');
            $table->text('cart_checkout');
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
        Schema::dropIfExists('web_store_orders');
    }
}
