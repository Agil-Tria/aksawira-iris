<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminCorpusController extends Controller
{
    public function destroy(Sentence $sentence)
    {
        $sentence->delete();

        return back()->with(
            'success',
            'Corpus berhasil dihapus'
        );
    }
}
