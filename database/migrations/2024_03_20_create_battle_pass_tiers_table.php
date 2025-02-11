<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('battle_pass_tiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('battle_pass_id')->constrained()->onDelete('cascade');
            $table->integer('level');
            $table->string('reward_type');
            $table->string('reward_value');
            $table->boolean('is_premium')->default(false);
            $table->integer('required_exp');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('battle_pass_tiers');
    }
}; 