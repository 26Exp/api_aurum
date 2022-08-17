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
        Schema::create('promocodes', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->decimal('discount', 8, 2);
            $table->boolean('active')->default(true);
            $table->integer('uses')->default(0);
            $table->integer('max_uses')->nullable();
            $table->boolean('multiple_use')->default(false);
            $table->boolean('is_percentage')->default(false);
            $table->json('users')->nullable();
            $table->dateTime('expires_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promocodes');
    }
};
