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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_logo', 100);
            $table->string('company_name', 100);
            $table->text('company_description')->nullable();
            $table->string('website_url', 255)->nullable();
            $table->string('industry', 50)->nullable();
            $table->string('company_size', 20)->nullable();
            $table->string('location', 255)->nullable();
            $table->string('contact_email', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
