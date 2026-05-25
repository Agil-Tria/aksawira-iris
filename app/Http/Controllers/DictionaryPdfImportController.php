<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\Auth;

class DictionaryPdfImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([

            'file' => 'required|mimes:pdf'

        ]);

        $parser = new Parser();

        $pdf = $parser->parseFile(
            $request->file('file')->getPathname()
        );

        $text = $pdf->getText();

        $lines = explode("\n", $text);

        $inserted = 0;

        foreach ($lines as $line) {

            $line = trim($line);

            /*
            contoh:
            abas [abas] n awan
            */

            if (preg_match(
                '/^([a-zA-Z\-]+)\s+\[[^\]]+\]\s+[a-z]+\s+(.+)$/u',
                $line,
                $matches
            )) {

                $wordSource = trim($matches[1]);

                $meaningPart = trim($matches[2]);

                /*
                ambil arti pertama saja
                sebelum titik koma / titik dua
                */

                $meaningPart = preg_split(
                    '/[:;]/',
                    $meaningPart
                )[0];

                $wordTarget = trim($meaningPart);

                /*
                skip terlalu panjang
                */

                if (
                    strlen($wordSource) < 2 ||
                    strlen($wordTarget) < 2
                ) {
                    continue;
                }

                /*
                hindari duplicate
                */

                $exists = Dictionary::where(
                    'word_source',
                    $wordSource
                )->where(
                    'word_target',
                    $wordTarget
                )->exists();

                if (!$exists) {

                    Dictionary::create([

                        'user_id' => Auth::id(),

                        'contributor_id' => Auth::id(),

                        'word_source' => $wordSource,

                        'word_target' => $wordTarget,

                        'status' => 'approved'

                    ]);

                    $inserted++;
                }
            }
        }

        return back()->with(
            'success',
            $inserted . ' dictionary berhasil diimport'
        );
    }
}
