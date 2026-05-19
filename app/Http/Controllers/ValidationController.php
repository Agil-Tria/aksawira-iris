<?php

namespace App\Http\Controllers;

use App\Models\Sentence;
use App\Models\Validation;
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function index()
    {
        $sentences = Sentence::where('status', 'pending')
            ->latest()
            ->get();

        return view(
            'validation.dashboard',
            compact('sentences')
        );
    }

    public function validateSentence(
        Request $request,
        Sentence $sentence
    ) {

        $request->validate([
            'action' => 'required',
            'notes' => 'nullable',
        ]);

        Validation::create([
            'sentence_id' => $sentence->id,
            'validator_id' => auth()->id(),
            'action' => $request->action,
            'notes' => $request->notes,
        ]);

        if ($request->action === 'approve') {

            $sentence->update([
                'status' => 'approved',
                'quality_level' => 'verified',
            ]);
        }

        if ($request->action === 'reject') {

            $sentence->update([
                'status' => 'rejected',
            ]);
        }

        return back()
            ->with(
                'success',
                'Validation berhasil diproses.'
            );
    }
}
