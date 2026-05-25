<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\DictionaryEntryImport;

use Maatwebsite\Excel\Facades\Excel;

class DictionaryImportController extends Controller
{
    public function import(
        Request $request
    )
    {
        $request->validate([

            'file' =>
                'required|mimes:xlsx,xls'
        ]);

        try {

            \Maatwebsite\Excel\Facades\Excel::import(

                new \App\Imports\DictionaryEntryImport,

                $request->file('file')
            );

            return back()->with(

                'success',

                'Import dictionary berhasil.'
            );

        } catch (\Exception $e) {

            return back()->withErrors([

                'import' =>
                    $e->getMessage()
            ]);
        }
    }
}
