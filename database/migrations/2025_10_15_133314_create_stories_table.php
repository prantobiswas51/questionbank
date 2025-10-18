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
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paper_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('story_name');
            $table->enum('story_type', ['essay', 'poem', 'epic', 'ode', 'haiku', 'limerick', 'sonnet', 'prose', 'article', 'letter', 'note', 'memoir', 'vignette', 'anecdote', 'parable', 'fable', 'novel', 'novella', 'short story', 'biography', 'autobiography', 'journal', 'diary', 'narrative', 'play', 'drama', 'screenplay', 'monologue', 'sermon', 'treatise', 'manifesto']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};
