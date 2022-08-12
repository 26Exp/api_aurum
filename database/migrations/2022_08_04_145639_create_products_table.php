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
            $table->unsignedBigInteger('category_id')->index();
            $table->unsignedBigInteger('manufacturer_id')->index();
            $table->string('name_ru');
            $table->string('name_ro');
            $table->string('slug_ru');
            $table->string('slug_ro');
            $table->string('description_ru')->nullable();
            $table->string('description_ro')->nullable();
            $table->string('meta_title_ru');
            $table->string('meta_description_ru');
            $table->string('meta_title_ro');
            $table->string('meta_description_ro');
            $table->json('images')->nullable();
            $table->float('price');
            $table->float('sale_price')->nullable();
            $table->integer('sku');
            $table->float('weight')->nullable();
            $table->boolean('has_variation')->default(false);
            $table->boolean('has_discount')->default(false);
            $table->boolean('has_badge')->default(false);
            $table->boolean('has_custom_msg')->default(false);
            $table->integer('stock')->default(0);
            $table->integer('status')->default(Product::STATUS_DRAFT);
            $table->string('out_of_stock_text_ro')->nullable();
            $table->string('out_of_stock_text_ru')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('cascade');
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
