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
        Schema::create('main_pages', function (Blueprint $table) {
            $table->id();
            $table->text('banner_text');
            $table->text('moto');
            $table->unsignedSmallInteger('experience')->default(11);
            $table->unsignedSmallInteger('projects')->default(10);
            $table->unsignedSmallInteger('certification')->default(6);
            $table->unsignedSmallInteger('article')->default(1);
            $table->unsignedSmallInteger('books')->default(1);
            $table->unsignedSmallInteger('mentoring')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_pages');
    }
};
