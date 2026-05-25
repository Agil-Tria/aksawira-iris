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
Schema::create(
            'dictionary_entries',
            function (Blueprint $table)
        {

            $table->id();

            $table->string('lemma');

            $table->text('meaning');

            $table->string('dialect')
                ->default('uluan');

            $table->string('word_class')
                ->nullable();

            $table->string('phonetic')
                ->nullable();

            $table->boolean('is_sublemma')
                ->default(false);

            $table->string('parent_lemma')
                ->nullable();

            $table->integer('homonym_no')
                ->nullable();

            $table->text('morphology_raw')
                ->nullable();

            $table->enum(
                'status',
                [
                    'pending',
                    'approved',
                    'rejected'
                ]
            )->default('approved');

            $table->foreignId('contributor_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dictionary_entries');
    }
};
