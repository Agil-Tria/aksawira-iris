<?php

namespace App\Http\Controllers;

use App\Models\Sentence;
use App\Models\Dictionary;
use Illuminate\Http\Request;

class ContributorDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $totalCorpus = Sentence::where(
            'contributor_id',
            $userId
        )->count();

        $approvedCorpus = Sentence::where(
            'contributor_id',
            $userId
        )->where(
            'status',
            'approved'
        )->count();

        $pendingCorpus = Sentence::where(
            'contributor_id',
            $userId
        )->where(
            'status',
            'pending'
        )->count();

        $totalDictionary = Dictionary::where(
            'contributor_id',
            $userId
        )->count();

        $approvedDictionary = Dictionary::where(
            'contributor_id',
            $userId
        )->where(
            'status',
            'approved'
        )->count();

        return view(
            'contributor-dashboard.index',
            compact(
                'totalCorpus',
                'approvedCorpus',
                'pendingCorpus',
                'totalDictionary',
                'approvedDictionary'
            )
        );
    }
}
