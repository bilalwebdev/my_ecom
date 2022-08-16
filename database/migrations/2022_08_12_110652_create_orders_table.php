<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Ramsey\Uuid\v1;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id');
            $table->string('username');
            $table->string('mobile');
            $table->string('email');
            $table->string('city');
            $table->string('district');
            $table->string('address');
            $table->string('coupon_code')->nullable();
            $table->string('pin_code');
            $table->string('payment_id')->nullable();
            $table->integer('coupon_value')->nullable();
            $table->string('payment_status')->nullable();
            $table->enum('payment_type', ['COD', 'Gateway']);
            $table->string('order_status')->nullable();
            $table->integer('total_amt');
            $table->dateTime('added_on');
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
};
