<?php

namespace App\Http\Controllers\Backend;

use App\Models\Poster;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PosterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $poster = Poster::first();
        
        return view('pages.backend.poster.index', compact('poster'));
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
            'name' => 'required|string',
            'poster' => 'required|image|mimes:jpeg,png',
            'about' => 'required|string'
        ]);

        DB::transaction(function () use ($request) {
            $file = $request->file('poster');
            $path = 'poster/';
            $filename = Str::slug($request->name) . '-' . time() . '.' . $file->extension();
            $file->storeAs($path, $filename, 'file');
            
            Poster::create([
                'name' => $request->name,
                'poster' => $filename,
                'about' => $request->about
            ]);
        });

        return redirect()->route('poster.index')->withToastSuccess('Poster/Tentang telah berhasil disimpan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poster $poster)
    {
        $request->validate([
            'name' => 'required|string',
            'poster' => 'nullable|image|mimes:jpeg,png',
            'about' => 'required|string'
        ]);

        DB::transaction(function () use ($request, $poster) {
            if ($request->hasFile('poster')) {
                $file = $request->file('poster');
                $path = 'poster/';
                $filename = Str::slug($request->name) . '-' . time() . '.' . $file->extension();
                $file->storeAs($path, $filename, 'file');

                $oldFilename = $path.$poster->poster;
                
                Storage::disk('file')->delete($oldFilename);
                $file->storeAs($path, $filename, 'file');
            }

            $poster->update([
                'name' => $request->name,
                'poster' => ($request->hasFile('poster')) ? $filename : $poster->poster,
                'about' => $request->about
            ]);
        });

        return redirect()->route('poster.index')->withToastSuccess('Poster/Tentang berhasil diubah');
    }
}
