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
        Schema::create('dashboard_image', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained(
                table: 'users',
                indexName: 'dashboardImage_author_id' 
            );
            $table->string('image1');
            $table->string('image2');
            $table->string('image3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard_image');
    }
};
