<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Major;
use App\Models\Member;
use App\Models\Conference;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ConferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conferences = Conference::all();
        
        return view('pages.backend.conference.index', compact('conferences'));
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

        return view('pages.backend.conference.create', compact('members', 'majors'));
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
            'organizer' => 'required|string',
            'location' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'isbn' => 'required|string',
            'type' => 'required|string',
            'url' => 'required|url',
            'file' => 'nullable|mimes:pdf'
        ]);
        
        DB::transaction(function () use ($request) {
            $file = $request->file('file');
            // $path = 'conference/';
            // $filename = Str::slug($request->title) . '-' . time() . '.' . $file->extension();
            // $file->storeAs($path, $filename, 'file');
            
            Conference::create([
                'member_id' => $request->member,
                'major_id' => $request->major,
                'team' => implode($request->teams),
                'title' => $request->title,
                'name' => $request->name,
                'organizer' => $request->organizer,
                'location' => $request->location,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'isbn' => $request->isbn,
                'type' => $request->type,
                'url' => $request->url,
                'file' => $file
            ]);
        });

        return redirect()->route('conference.index')->withToastSuccess('Seminar berhasil disimpan');
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
    public function edit(Conference $conference)
    {
        $members = Member::all();
        $majors = Major::all();

        return view('pages.backend.conference.edit', compact('conference', 'members', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conference $conference)
    {
        $request->validate([
            'member' => 'required|string',
            'major' => 'required|string',
            'teams' => 'required',
            'title' => 'required|string',
            'name' => 'required|string',
            'organizer' => 'required|string',
            'location' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'isbn' => 'required|string',
            'type' => 'required|string',
            'url' => 'required|url',
            'file' => 'nullable|mimes:pdf'
        ]);

        DB::transaction(function () use ($request, $conference) {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = 'conference/';
                $filename = Str::slug($request->title) . '-' . time() . '.' . $file->extension();
                $file->storeAs($path, $filename, 'file');

                $oldFilename = $path.$conference->file;
                
                Storage::disk('file')->delete($oldFilename);
                $file->storeAs($path, $filename, 'file');
            }

            $conference->update([
                'member_id' => $request->member,
                'major_id' => $request->major,
                'team' => implode($request->teams),
                'title' => $request->title,
                'name' => $request->name,
                'organizer' => $request->organizer,
                'location' => $request->location,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'isbn' => $request->isbn,
                'type' => $request->type,
                'url' => $request->url,
                'file' => ($request->hasFile('file')) ? $filename : $conference->file
            ]);
        });

        return redirect()->route('conference.index')->withToastSuccess('Seminar berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conference $conference)
    {
        DB::transaction(function () use ($conference) {
            Storage::disk('file')->delete('conference/'.$conference->file);
            $conference->delete();
        });

        return redirect()->route('conference.index')->withToastSuccess('Seminar berhasil dihapus');
    }
}
