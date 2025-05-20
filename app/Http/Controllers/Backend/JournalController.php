<?php

namespace App\Http\Controllers\Backend;

use App\Models\Major;
use App\Models\Member;
use App\Models\Journal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $journals = Journal::query()
            ->with('member', 'major')
            ->get();

        return view('pages.backend.journal.index', compact('journals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::all();
        $majors = Major::all();

        return view('pages.backend.journal.create', compact('members', 'majors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'member' => 'required|string',
            'major' => 'required|string',
            'teams' => 'required',
            'title' => 'required|string',
            'name' => 'required|string',
            'volume' => 'required|string',
            'page' => 'required|string',
            'year' => 'required|string',
            'p_issn' => 'nullable|string',
            'e_issn' => 'required|string',
            'type' => 'required|string',
            'url' => 'nullable|url',
            'file' => 'nullable|mimes:pdf'
        ]);
        
        DB::transaction(function () use ($request) {
            $file = $request->file('file');
            // $path = 'journal/';
            // $filename = Str::slug($request->title) . '-' . time() . '.' . $file->extension();
            // $file->storeAs($path, $filename, 'file');
            
            Journal::create([
                'member_id' => $request->member,
                'major_id' => $request->major,
                'team' => implode($request->teams),
                'title' => $request->title,
                'name' => $request->name,
                'volume' => $request->volume,
                'page' => $request->page,
                'year' => $request->year,
                'p_issn' => $request->p_issn,
                'e_issn' => $request->e_issn,
                'type' => $request->type,
                'url' => $request->url,
                'file' => $file
            ]);
        });

        return redirect()->route('journal.index')->withToastSuccess('Jurnal berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Journal $journal)
    {
        $members = Member::all();
        $majors = Major::all();

        return view('pages.backend.journal.edit', compact('journal', 'members', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Journal $journal)
    {
        $request->validate([
            'member' => 'required|string',
            'major' => 'required|string',
            'teams' => 'required',
            'title' => 'required|string',
            'name' => 'required|string',
            'volume' => 'required|string',
            'page' => 'required|string',
            'year' => 'required|string',
            'p_issn' => 'nullable|string',
            'e_issn' => 'required|string',
            'type' => 'required|string',
            'url' => 'nullable|url',
            'file' => 'nullable|mimes:pdf'
        ]);

        DB::transaction(function () use ($request, $journal) {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = 'journal/';
                $filename = Str::slug($request->title) . '-' . time() . '.' . $file->extension();
                $file->storeAs($path, $filename, 'file');

                $oldFilename = $path.$journal->file;
                
                Storage::disk('file')->delete($oldFilename);
                $file->storeAs($path, $filename, 'file');
            }

            $journal->update([
                'member_id' => $request->member,
                'major_id' => $request->major,
                'team' => implode($request->teams),
                'title' => $request->title,
                'name' => $request->name,
                'volume' => $request->volume,
                'page' => $request->page,
                'year' => $request->year,
                'p_issn' => $request->p_issn,
                'e_issn' => $request->e_issn,
                'type' => $request->type,
                'url' => $request->url,
                'file' => ($request->hasFile('file')) ? $filename : $journal->file
            ]);
        });

        return redirect()->route('journal.index')->withToastSuccess('Jurnal berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Journal $journal)
    {
        DB::transaction(function () use ($journal) {
            Storage::disk('file')->delete('journal/'.$journal->file);
            $journal->delete();
        });

        return redirect()->route('journal.index')->withToastSuccess('Jurnal berhasil dihapus');
    }
}
