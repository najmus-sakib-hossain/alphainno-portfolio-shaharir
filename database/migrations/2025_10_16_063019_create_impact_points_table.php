<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('impact_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('impact_id')->constrained('impacts')->cascadeOnDelete();
            $table->string('point');
            $table->integer('order_no')->default(1);
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('impact_points');
    }
};
