<?php

namespace App\Http\Controllers;

use App\Models\DictionaryEntry;
use Illuminate\Http\Request;

class DictionaryController extends Controller
{
      public function index(Request $request)
{
$words = DictionaryEntry::query();


// =====================================
// GUEST
// =====================================

if(!auth()->check()){

    $words->where(
        'status',
        'approved'
    );
}


// =====================================
// CONTRIBUTOR
// =====================================

elseif(

    !auth()->user()->hasRole('admin')

    &&

    !auth()->user()->hasRole('validator')

){

    $words->where(function ($q) {

        // =================================
        // APPROVED UNTUK SEMUA
        // =================================

        $q->where(
            'status',
            'approved'
        )

        // =================================
        // MILIK SENDIRI
        // =================================

        ->orWhere(function ($sub) {

            $sub->where(
                'contributor_id',
                auth()->id()
            );

        });
    });
}


// =====================================
// ADMIN / VALIDATOR
// =====================================

else {

    // admin & validator:
    // lihat semua
}


// =====================================
// SEARCH
// =====================================

if($request->search){

    $search = $request->search;

    $words->where(function ($q)
    use ($search) {

        $q->where(
            'lemma',
            'ILIKE',
            '%' . $search . '%'
        )

        ->orWhere(
            'meaning',
            'ILIKE',
            '%' . $search . '%'
        );
    });
}


// =====================================
// FINAL
// =====================================

$words = $words

    ->latest()

    ->paginate(10);

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

            'word_source' =>

                'required|string|max:255',

            'word_target' =>

                'required|string|max:255',
        ]);

        $exists = DictionaryEntry::where(

            'lemma',

            strtolower(
                trim(
                    $request->word_target
                )
            )

        )

        ->where(

            'meaning',

            strtolower(
                trim(
                    $request->word_source
                )
            )

        )

        ->exists();

        if($exists){

            return back()->withErrors([

                'duplicate' =>

                    'Kata sudah ada di kamus.'
            ]);
        }

        DictionaryEntry::create([

    'lemma' =>
        $request->word_target,

    'meaning' =>
        $request->word_source,

    'dialect' =>
        'uluan',

    'status' =>
        'pending',

    'contributor_id' =>
        auth()->id(),
]);

        return redirect()
            ->route('dictionary.index')
            ->with(
                'success',
                'Kata berhasil ditambahkan.'
            );
    }

    public function deleteAll()
    {
        \App\Models\DictionaryEntry::truncate();

        return back()->with(
            'success',
            'Semua data dictionary berhasil dihapus.'
        );
    }

    public function destroy(
    DictionaryEntry $word
)
{
    $word->delete();

    return back()->with(

        'success',

        'Kata berhasil dihapus.'
    );
}
}
