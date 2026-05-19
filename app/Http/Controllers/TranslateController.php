<?php

namespace App\Http\Controllers;

use App\Models\TranslationHistory;
use App\Models\Dictionary;
use Illuminate\Http\Request;

class TranslateController extends Controller
{
     public function index()
    {
        return view('translate.index');
    }

    public function translate(Request $request)
    {
        $request->validate([
            'text' => 'required',
            'direction' => 'required',
        ]);

        $input = strtolower($request->text);

        $words = explode(' ', $input);

        $translatedWords = [];

        foreach ($words as $word) {

            if ($request->direction === 'id_to_komering') {

                $dictionary = Dictionary::where(
                    'status',
                    'approved'
                )

                ->where(
                    'word_source',
                    $word
                )

                ->first();

                if ($dictionary) {

                    $translatedWords[] =
                        $dictionary->word_target;

                } else {

                    $translatedWords[] = $word;
                }
            }

            if ($request->direction === 'komering_to_id') {

                $dictionary = Dictionary::where(
                    'status',
                    'approved'
                )

                ->where(
                    'word_target',
                    $word
                )

                ->first();

                if ($dictionary) {

                    $translatedWords[] =
                        $dictionary->word_source;

                } else {

                    $translatedWords[] = $word;
                }
            }
        }

        $result = implode(
            ' ',
            $translatedWords
        );

        TranslationHistory::create([

            'user_id' => auth()->id(),

            'input_text' => $request->text,

            'translated_text' => $result,

            'direction' => $request->direction,

        ]);
        return view(
            'translate.index',
            compact(
                'result'
            )
        );
    }
}
