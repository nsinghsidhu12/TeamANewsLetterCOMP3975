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
        Schema::create('articles', function (Blueprint $table) {
            $table->id('ArticleID');
            $table->unsignedBigInteger('NewsletterID');
            $table->string('Title', 256);
            $table->string('Description', 1024);
            $table->string('Image', 256);
            $table->string('ImagePlacement', 128);
            $table->foreign('NewsletterID')->references('NewsletterID')->on('newsletters');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
