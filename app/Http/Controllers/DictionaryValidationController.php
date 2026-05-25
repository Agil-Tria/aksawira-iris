<?php

namespace App\Http\Controllers;

use App\Models\DictionaryEntry;
use App\Models\DictionaryValidation;
use Illuminate\Http\Request;

class DictionaryValidationController extends Controller
{
public function index()
{
    $words = DictionaryEntry::where(

        'status',

        'pending'

    )

    ->latest()

    ->get();

    return view(

        'dictionary-validation.index',

        compact('words')
    );
}

    public function process(
        Request $request,
        DictionaryEntry $dictionary
    ) {

        $request->validate([

            'action' => 'required',

            'notes' =>

                $request->action === 'reject'

                ? 'required|string|max:500'

                : 'nullable'
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

            $request->validate([

                'notes' =>

                    'required|string|max:500'
            ]);

            $dictionary->update([

                'status' => 'rejected',

                'reject_reason' =>

                    $request->notes,
            ]);
        }

        return back()->with(
            'success',
            'Validasi kata berhasil.'
        );
    }
}
