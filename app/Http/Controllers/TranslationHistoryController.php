<?php

namespace App\Http\Controllers;

use App\Models\TranslationHistory;
use Illuminate\Http\Request;

class TranslationHistoryController extends Controller
{
     public function index()
    {
        $histories = TranslationHistory::where(
            'user_id',
            auth()->id()
        )

        ->latest()

        ->paginate(10);

        return view(
            'translation-history.index',
            compact('histories')
        );
    }
}
