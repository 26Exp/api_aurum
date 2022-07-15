<?php

use App\Models\Product;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')
                   ->foreignId('categories')
                   ->constrained();
            $table->unsignedBigInteger('vendor_id')
                   ->foreignId('vendors')
                   ->constrained();
            $table->unsignedBigInteger('discount_id')
                   ->foreignId('discounts')
                   ->constrained()
                   ->nullable();
            $table->unsignedBigInteger('user_id')
                   ->foreignId('users')
                   ->constrained();
            $table->boolean('hasCustomMessage')->default(false);

            $table->integer('status')->default(Product::STATUS_DRAFT);
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
        Schema::dropIfExists('products');
    }
};
