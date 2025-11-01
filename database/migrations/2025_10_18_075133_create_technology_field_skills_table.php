<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('technology_field_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('technology_field_id')->constrained('technology_fields')->onDelete('cascade');
            $table->string('icon');
            $table->string('name')->nullable();
            $table->integer('order_no')->default(0);
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('technology_field_skills');
    }
};
