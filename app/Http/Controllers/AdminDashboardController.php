<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sentence;
use App\Models\Dictionary;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $totalValidators = User::role(
            'validator'
        )->count();

        $totalAdmins = User::role(
            'admin'
        )->count();

        $totalCorpus = Sentence::count();

        $approvedCorpus = Sentence::where(
            'status',
            'approved'
        )->count();

        $pendingCorpus = Sentence::where(
            'status',
            'pending'
        )->count();

        $totalDictionary = Dictionary::count();

        $approvedDictionary = Dictionary::where(
            'status',
            'approved'
        )->count();

        return view(
            'admin-dashboard.index',
            compact(
                'totalUsers',
                'totalValidators',
                'totalAdmins',
                'totalCorpus',
                'approvedCorpus',
                'pendingCorpus',
                'totalDictionary',
                'approvedDictionary'
            )
        );
    }
}
