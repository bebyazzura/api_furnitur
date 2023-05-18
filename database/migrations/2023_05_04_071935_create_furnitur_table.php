<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('furnitur', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller');
            $table->string('name', 100);
            $table->text('description')->nullable()->default('text');
            $table->integer('price');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('seller')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('furnitur');
    }
};
