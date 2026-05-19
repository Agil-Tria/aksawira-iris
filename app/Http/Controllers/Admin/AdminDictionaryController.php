<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dictionary;
use Illuminate\Http\Request;

class AdminDictionaryController extends Controller
{
    public function destroy(Dictionary $dictionary)
    {
        $dictionary->delete();

        return back()->with(
            'success',
            'Dictionary berhasil dihapus'
        );
    }
}
