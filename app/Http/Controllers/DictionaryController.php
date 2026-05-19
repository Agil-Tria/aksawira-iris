<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Http\Request;

class DictionaryController extends Controller
{
     public function index(Request $request)
    {
        $query = Dictionary::query();

        $query->where('status', 'approved');

        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'word_source',
                    'ILIKE',
                    '%' . $request->search . '%'
                )

                ->orWhere(
                    'word_target',
                    'ILIKE',
                    '%' . $request->search . '%'
                );

            });
        }

        $words = $query
            ->latest()
            ->paginate(20);

        return view(
            'dictionary.index',
            compact('words')
        );
    }

    public function create()
    {
        return view('dictionary.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'word_source' => 'required',
            'word_target' => 'required',
        ]);

        Dictionary::create([
            'user_id' => auth()->id(),
            'word_source' => $request->word_source,
            'word_target' => $request->word_target,
            'example_sentence' => $request->example_sentence,
            'contributor_id' => auth()->id(),
            'status' => 'pending',
        ]);

        return redirect()
            ->route('dictionary.index')
            ->with(
                'success',
                'Kata berhasil ditambahkan.'
            );
    }
}
