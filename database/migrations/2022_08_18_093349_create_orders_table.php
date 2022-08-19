<?php

use App\Models\Order;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('address_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('delivery_method_id');
            $table->unsignedBigInteger('promocode_id')->nullable();
            $table->unsignedBigInteger('total_price');
            $table->integer('status')->default(Order::STATUS_NEW);
            $table->boolean('is_paid')->default(false);
            $table->boolean('free_delivery')->default(false);
            $table->boolean('is_created_by_admin')->default(false);
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
