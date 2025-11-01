<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('corporates', function (Blueprint $table) {
            $table->id();
            $table->integer('step_number');
            $table->string('title');
            $table->string('company_name')->nullable();
            $table->string('position_years')->nullable();
            $table->string('image_path')->nullable();
            $table->text('description')->nullable();
            $table->integer('order_no')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('corporates');
    }
};
