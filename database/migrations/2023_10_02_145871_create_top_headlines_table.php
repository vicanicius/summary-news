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
        Schema::create('top_headlines', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->text('sourceId')->nullable();
            $table->text('sourceName')->nullable();
            $table->text('author')->nullable();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->text('url')->nullable();
            $table->text('urlToImage')->nullable();
            $table->text('publishedAt')->nullable();
            $table->text('content')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_headlines');
    }
};
