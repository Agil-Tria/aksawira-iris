<?php

namespace App\Imports;

use App\Models\Dictionary;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DictionaryImport implements ToModel, WithHeadingRow
{
    // /**
    // * @param array $row
    // *
    // * @return \Illuminate\Database\Eloquent\Model|null
    // */
    public function model(array $row)
    {
        return new Dictionary([
            'user_id' => Auth::id(),

            'word_source' => $row['word_source'],

            'word_target' => $row['word_target'],

            'status' => 'pending',
        ]);
    }
}
