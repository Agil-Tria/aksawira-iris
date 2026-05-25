<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DictionaryEntry;

class TranslateController extends Controller
{
    public function index()
    {
        return view('translate.index');
    }

    public function liveTranslate(
        Request $request
    )
    {
        $text = strtolower(
            trim(
                $request->text
            )
        );

        $direction =
            $request->direction;

        // =====================================
        // ID -> KOM
        // =====================================

        if(
            $direction === 'id_to_kom'
        ) {

$entry = DictionaryEntry::query()

    ->where(

        'lemma',

        'ILIKE',

        $word
    )

    ->orWhere(

        'meaning',

        'ILIKE',

        $word
    )

    ->orderByRaw(

        "
        CASE

            WHEN lemma ILIKE ? THEN 1

            WHEN meaning ILIKE ? THEN 2

            ELSE 3

        END
        ",

        [
            $word,
            $word
        ]
    )

    ->first();

            return response()->json([

                'translation' =>
                    $entry
                        ? $entry->lemma
                        : 'Terjemahan tidak ditemukan'
            ]);
        }

        // =====================================
        // KOM -> ID
        // =====================================

       $entry = DictionaryEntry::query()

    ->where(

        'lemma',

        'ILIKE',

        $word
    )

    ->orWhere(

        'meaning',

        'ILIKE',

        $word
    )

    ->orderByRaw(

        "
        CASE

            WHEN lemma ILIKE ? THEN 1

            WHEN meaning ILIKE ? THEN 2

            ELSE 3

        END
        ",

        [
            $word,
            $word
        ]
    )

    ->first();
        return response()->json([

            'translation' =>
                $entry
                    ? $entry->meaning
                    : 'Terjemahan tidak ditemukan'
        ]);
    }

        public function autocomplete(
        Request $request
    )
    {
        $query = strtolower(
            trim(
                $request->q
            )
        );

        if(strlen($query) < 1){

            return response()->json([]);
        }

        $results = DictionaryEntry::query()

            ->select([
                'lemma',
                'meaning'
            ])

            ->where(function($q) use ($query){

                $q->where(
                    'lemma',
                    'ILIKE',
                    '%' . $query . '%'
                )

                ->orWhere(
                    'meaning',
                    'ILIKE',
                    '%' . $query . '%'
                );
            })

            // =====================================
            // SMART RANKING
            // =====================================

            ->orderByRaw(

                "
                CASE

                    WHEN lemma ILIKE ? THEN 1

                    WHEN lemma ILIKE ? THEN 2

                    WHEN meaning ILIKE ? THEN 3

                    ELSE 4

                END
                ",

                [

                    $query,

                    $query . '%',

                    $query . '%'
                ]
            )

            ->limit(8)

            ->get();

        return response()->json(
            $results
        );
    }
}