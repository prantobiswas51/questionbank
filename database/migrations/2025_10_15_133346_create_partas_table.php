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
        Schema::create('partas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('story_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('part_a_qs')->nullable();
            $table->longText('part_a_ans')->nullable();
            $table->text('part_a_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partas');
    }
};
