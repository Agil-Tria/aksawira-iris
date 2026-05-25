<?php

use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(
            'dictionary_validations',
            function (Blueprint $table)
        {

            // DROP FK LAMA
            $table->dropForeign([
                'dictionary_id'
            ]);

        });

        Schema::table(
            'dictionary_validations',
            function (Blueprint $table)
        {

            // FK BARU
            $table->foreign('dictionary_id')

                ->references('id')

                ->on('dictionary_entries')

                ->cascadeOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table(
            'dictionary_validations',
            function (Blueprint $table)
        {

            $table->dropForeign([
                'dictionary_id'
            ]);

        });
    }
};