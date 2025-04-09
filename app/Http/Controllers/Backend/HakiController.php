<?php

namespace App\Http\Controllers\Backend;

use App\Models\Haki;
use App\Models\Major;
use App\Models\Member;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class HakiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hakis = Haki::all();

        return view('pages.backend.haki.index', compact('hakis'));
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

        return view('pages.backend.haki.create', compact('members', 'majors'));
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
            'member' => 'required',
            'major' => 'required',
            'teams' => 'required',
            'register_number' => 'required',
            'title' => 'required',
            'type' => 'required',
            'file' => 'nullable|mimes:pdf',
            'url' => 'required|url'
        ]);

        $file = $request->file('file');
        $path = 'haki/';
        $filename = Str::slug($request->register_number) . '-' . time() . '.' . $file->extension();
        $file->storeAs($path, $filename, 'file');

        Haki::create([
            'member_id' => $request->member,
            'major_id' => $request->major,
            'team' => implode($request->teams),
            'register_number' => $request->register_number,
            'title' => $request->title,
            'type' => $request->type,
            'file' => $filename,
            'url' => $request->url
        ]);

        return redirect()->route('haki.index')->withToastSuccess('HAKI berhasil disimpan');
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
    public function edit(Haki $haki)
    {
        $members = Member::all();
        $majors = Major::all();

        return view('pages.backend.haki.edit', compact('haki', 'members', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Haki $haki)
    {
        $request->validate([
            'member' => 'required',
            'major' => 'required',
            'teams' => 'required',
            'register_number' => 'required',
            'title' => 'required',
            'type' => 'required',
            'file' => 'nullable|mimes:pdf',
            'url' => 'nullable|url'
        ]);

        DB::transaction(function () use ($request, $haki) {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = 'haki/';
                $filename = Str::slug($request->title) . '-' . time() . '.' . $file->extension();
                $file->storeAs($path, $filename, 'file');

                $oldFilename = $path.$haki->file;
                
                Storage::disk('file')->delete($oldFilename);
                $file->storeAs($path, $filename, 'file');
            }

            $haki->update([
                'member_id' => $request->member,
                'major_id' => $request->major,
                'team' => implode($request->teams),
                'register_number' => $request->register_number,
                'title' => $request->title,
                'type' => $request->type,
                'file' => ($request->hasFile('file')) ? $filename : $haki->file,
                'url' => $request->url
            ]);
        });

        return redirect()->route('haki.index')->withToastSuccess('HAKI berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Haki $haki)
    {
        DB::transaction(function () use ($haki) {
            Storage::disk('file')->delete('haki/'.$haki->file);
            $haki->delete();
        });

        return redirect()->route('journal.index')->withToastSuccess('HAKI berhasil dihapus');
    }
}
