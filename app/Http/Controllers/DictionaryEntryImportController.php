<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\DictionaryEntryImport;
use Maatwebsite\Excel\Facades\Excel;

class DictionaryEntryImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([

            'file' =>
                'required|mimes:xlsx,csv'

        ]);

        Excel::import(

            new DictionaryEntryImport,

            $request->file('file')

        );

        return back()->with(
            'success',
            'Dataset berhasil diimport'
        );
    }
}
