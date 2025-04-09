<?php

namespace App\Http\Controllers\Backend;

use App\Models\Book;
use App\Models\Haki;
use App\Models\Journal;
use App\Models\Conference;
use App\Models\Innovation;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Major;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        $conference = Conference::count();
        $journal = Journal::count();
        $book = Book::count();
        $haki = Haki::count();
        $innovation = Innovation::count();
        $member = Member::count();
        $major = Major::count();
        $activity = Activity::count();
        
        return view('pages.backend.dashboard', compact([
            'conference',
            'journal',
            'book',
            'haki',
            'innovation',
            'member',
            'major',
            'activity'
        ]));
    }
}
