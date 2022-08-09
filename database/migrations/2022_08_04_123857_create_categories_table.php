<?php

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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_ru');
            $table->string('name_ro');
            $table->string('slug_ru');
            $table->string('slug_ro');
            $table->text('description_ru')->nullable();
            $table->text('description_ro')->nullable();
            $table->string('meta_title_ru');
            $table->string('meta_title_ro');
            $table->text('meta_description_ru')->nullable();
            $table->text('meta_description_ro')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
