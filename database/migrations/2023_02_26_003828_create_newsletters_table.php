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
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id('NewsletterID');
            $table->string('Logo', 256)->nullable()->default(null);
            $table->date('Date')->nullable()->default(null);
            $table->string('Title', 256) ->nullable()->default(null);
            $table->boolean('IsActive') ->nullable()->default(null);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsletters');
    }
};
