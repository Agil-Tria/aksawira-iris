<?php

namespace App\Imports;

use App\Models\DictionaryEntry;

use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DictionaryEntryImport
implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // =====================================
        // CLEAN DATA
        // =====================================

        $lemma = strtolower(
            trim(
                $row['lemma'] ?? ''
            )
        );

        $meaning = strtolower(
            trim(
                $row['meaning'] ?? ''
            )
        );

        // =====================================
        // REMOVE EXTRA SPACE
        // =====================================

        $lemma = preg_replace(
            '/\s+/',
            ' ',
            $lemma
        );

        $meaning = preg_replace(
            '/\s+/',
            ' ',
            $meaning
        );

        // =====================================
        // REMOVE INVALID CHARACTER
        // =====================================

        $lemma = preg_replace(
            '/[^a-zA-Z\s\-]/',
            '',
            $lemma
        );

        // =====================================
        // EMPTY VALIDATION
        // =====================================

        if(
            empty($lemma) ||
            empty($meaning)
        ){
            return null;
        }

        // =====================================
        // TOO SHORT VALIDATION
        // =====================================

        if(
            strlen($lemma) < 2 ||
            strlen($meaning) < 1
        ){
            return null;
        }

        // =====================================
        // DUPLICATE PREVENTION
        // =====================================

        return DictionaryEntry::firstOrCreate(

            [

                'lemma' =>
                    $lemma,

                'meaning' =>
                    $meaning,
            ],

            [

                'dialect' =>
                    strtolower(
                        trim(
                            $row['dialect']
                            ?? 'uluan'
                        )
                    ),

                'word_class' =>
                    $row['word_class']
                    ?? null,

                'phonetic' =>
                    $row['phonetic']
                    ?? null,

                'is_sublemma' =>
                    false,

                'status' =>
                    'approved',
            ]
        );
    }
}