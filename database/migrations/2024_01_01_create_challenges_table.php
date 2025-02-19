<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->integer('points');
            $table->datetime('due_date');
            $table->enum('difficulty', ['easy', 'medium', 'hard']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('challenges');
    }
}; 