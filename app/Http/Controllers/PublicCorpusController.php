<?php

namespace App\Http\Controllers;

use App\Models\Sentence;
use Illuminate\Http\Request;

class PublicCorpusController extends Controller
{
    public function index(Request $request)
    {
        $query = Sentence::query();

        $query->where('status', 'approved');

        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'source_text',
                    'ILIKE',
                    '%' . $request->search . '%'
                )

                ->orWhere(
                    'target_text',
                    'ILIKE',
                    '%' . $request->search . '%'
                );

            });
        }

        $sentences = $query
            ->latest()
            ->paginate(10);

        return view(
            'public-corpus.index',
            compact('sentences')
        );
    }
}
