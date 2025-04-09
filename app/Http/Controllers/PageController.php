<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Book;
use App\Models\Conference;
use App\Models\Grant;
use App\Models\Haki;
use App\Models\Innovation;
use App\Models\Journal;
use App\Models\Partner;
use App\Models\Poster;

class PageController extends Controller
{
    public function index()
    {
        $activities = Activity::paginate(12);
        $partners = Partner::all();
        $poster = Poster::first();

        return view('pages.landing', compact('activities', 'partners', 'poster'));
    }

    public function book()
    {
        $books = Book::all();

        return view('pages.book', compact('books'));
    }

    public function haki()
    {
        $hakis = Haki::all();

        return view('pages.haki', compact('hakis'));
    }

    public function innovation()
    {
        $innovations = Innovation::all();

        return view('pages.innovation', compact('innovations'));
    }

    public function journal()
    {
        $journals = Journal::all();

        return view('pages.journal', compact('journals'));
    }

    public function conference()
    {
        $conferences = Conference::all();

        return view('pages.conference', compact('conferences'));
    }

    public function grant()
    {
        $grants = Grant::all();

        return view('pages.grant', compact('grants'));
    }
}
