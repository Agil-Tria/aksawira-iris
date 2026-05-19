<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\DictionaryValidation;
use Illuminate\Http\Request;

class DictionaryValidationController extends Controller
{
     public function index()
    {
        $words = Dictionary::where(
            'status',
            'pending'
        )->latest()->get();

        return view(
            'dictionary-validation.index',
            compact('words')
        );
    }

    public function process(
        Request $request,
        Dictionary $dictionary
    ) {

        $request->validate([
            'action' => 'required',
        ]);

        DictionaryValidation::create([
            'dictionary_id' => $dictionary->id,
            'validator_id' => auth()->id(),
            'action' => $request->action,
            'notes' => $request->notes,
        ]);

        if ($request->action === 'approve') {

            $dictionary->update([
                'status' => 'approved',
            ]);
        }

        if ($request->action === 'reject') {

            $dictionary->update([
                'status' => 'rejected',
            ]);
        }

        return back()->with(
            'success',
            'Validasi kata berhasil.'
        );
    }
}
