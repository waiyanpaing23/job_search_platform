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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_title');
            $table->text('description');
            $table->string('job_type');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('location');
            $table->text('requirement');
            $table->text('benefit')->nullable();
            $table->decimal('min_salary', 10, 2)->nullable();
            $table->decimal('max_salary', 10, 2)->nullable();
            $table->date('expiry_date')->nullable();
            $table->foreignId('employer_id')->constrained()->onDelete('cascade');
            $table->string('contact_email');
            $table->enum('status',['Open', 'Closed'])->default('Open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
