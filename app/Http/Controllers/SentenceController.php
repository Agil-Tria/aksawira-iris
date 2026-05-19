<?php

namespace App\Http\Controllers;

use App\Models\Sentence;
use Illuminate\Http\Request;

class SentenceController extends Controller
{
     public function index()
    {
        $sentences = Sentence::latest()->paginate(10);

        return view('sentences.index', compact('sentences'));
    }

    public function create()
    {
        return view('sentences.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'source_text' => 'required',
            'target_text' => 'required',
        ]);

        Sentence::create([
            'user_id' => auth()->id(),
            'source_text' => $request->source_text,
            'target_text' => $request->target_text,
            'source_lang' => 'id',
            'target_lang' => 'kom',
            'contributor_id' => auth()->id(),
            'status' => 'pending',
            'quality_level' => 'raw',
        ]);

        return redirect()
            ->route('sentences.index')
            ->with('success', 'Corpus berhasil ditambahkan.');
    }
}
