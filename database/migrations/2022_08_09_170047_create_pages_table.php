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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title_ru');
            $table->string('title_ro');
            $table->string('slug_ru');
            $table->string('slug_ro');
            $table->text('content_ru');
            $table->text('content_ro');
            $table->string('meta_title_ru')->nullable();
            $table->string('meta_title_ro')->nullable();
            $table->text('meta_description_ru')->nullable();
            $table->text('meta_description_ro')->nullable();
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
        Schema::dropIfExists('pages');
    }
};
