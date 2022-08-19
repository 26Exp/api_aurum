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
            $table->unsignedBigInteger('address_id')->nullable();
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->unsignedBigInteger('delivery_method_id')->nullable();
            $table->unsignedBigInteger('promocode_id')->nullable();
            $table->unsignedBigInteger('total_price');
            $table->integer('status')->default(Order::STATUS_NEW);
            $table->boolean('is_paid')->default(false);
            $table->boolean('free_delivery')->default(false);
            $table->boolean('is_created_by_admin')->default(false);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('address_id')->references('id')->on('user_addresses')->nullOnDelete();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->nullOnDelete();
            $table->foreign('delivery_method_id')->references('id')->on('delivery_methods')->nullOnDelete();
            $table->foreign('promocode_id')->references('id')->on('promocodes')->nullOnDelete();

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
