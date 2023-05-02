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
        Schema::create('presence_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('presence_id');
            $table->unsignedBigInteger('student_id');
            $table->enum('status', ['S', 'I', 'A','H']);
            $table->boolean('is_approved')->default(false);
            $table->date('date');
            $table->timestamps();
            $table->foreign('presence_id')->references('id')->on('presences')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presence_details');
    }
};
