<?php

namespace App\Http\Controllers;

use App\Models\Sentence;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportCorpusCsv()
    {
        $fileName = 'corpus_dataset.csv';

        $sentences = Sentence::where(
            'status',
            'approved'
        )->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' =>
                'attachment; filename="' . $fileName . '"',
        ];

        $callback = function () use ($sentences) {

            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'source_text',
                'target_text',
            ]);

            foreach ($sentences as $sentence) {

                fputcsv($file, [
                    $sentence->source_text,
                    $sentence->target_text,
                ]);
            }

            fclose($file);
        };

        return response()->stream(
            $callback,
            200,
            $headers
        );
    }

    public function exportCorpusJson()
    {
        $sentences = Sentence::where(
            'status',
            'approved'
        )->get([
            'source_text',
            'target_text'
        ]);

        return response()->json(
            $sentences,
            200,
            [],
            JSON_PRETTY_PRINT
        );
    }
}
