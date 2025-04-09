<?php

namespace App\Http\Controllers\Backend;

use App\Models\Major;
use App\Models\Member;
use App\Models\Innovation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class InnovationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $innovations = Innovation::all();

        return view('pages.backend.innovation.index', compact('innovations'));
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

        return view('pages.backend.innovation.create', compact('members', 'majors'));
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
            'name' => 'required|string',
            'description' => 'required|string',
            'video' => 'nullable|url',
            'image' => 'required|mimes:jpeg,png|max:2000'
        ]);

        if ($request->video !== null) {
            $url = $request->video;
            if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $videoId)) {
                $video = $videoId[1];
            } elseif (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $videoId)) {
                $video = $videoId[1];
            } elseif (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $url, $videoId)) {
                $video = $videoId[1];
            } elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $videoId)) {
                $video = $videoId[1];
            } elseif (preg_match('/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $url, $id)) {
                $video = $videoId[1];
            } else {
                $video = null;
            }
        }

        DB::transaction(function () use ($request, &$video) {
            $file = $request->file('image');
            $path = 'innovation/';
            $filename = Str::slug($request->name) . '-' . time() . '.' . $file->extension();
            $file->storeAs($path, $filename, 'file');
            
            Innovation::create([
                'member_id' => $request->member,
                'major_id' => $request->major,
                'team' => implode($request->teams),
                'name' => $request->name,
                'description' => $request->description,
                'video' => $video,
                'image' => $filename
            ]);
        });
        
        return redirect()->route('innovation.index')->withToastSuccess('Produk inovasi berhasil ditambah');
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
    public function edit(Innovation $innovation)
    {
        $members = Member::all();
        $majors = Major::all();

        return view('pages.backend.innovation.edit', compact('innovation', 'members', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Innovation $innovation)
    {
        $request->validate([
            'member' => 'required|string',
            'major' => 'required|string',
            'teams' => 'required',
            'name' => 'required|string',
            'description' => 'required|string',
            'video' => 'nullable|url',
            'image' => 'nullable|mimes:jpeg|max:2000'
        ]);

        if ($request->video !== null) {
            $url = $request->video;
            if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $videoId)) {
                $video = $videoId[1];
            } elseif (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $videoId)) {
                $video = $videoId[1];
            } elseif (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $url, $videoId)) {
                $video = $videoId[1];
            } elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $videoId)) {
                $video = $videoId[1];
            } elseif (preg_match('/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $url, $id)) {
                $video = $videoId[1];
            } else {
                $video = null;
            }
        }

        DB::transaction(function () use ($request, $innovation, &$video) {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = 'innovation/';
                $filename = Str::slug($request->name) . '-' . time() . '.' . $file->extension();
                $file->storeAs($path, $filename, 'file');

                $oldFilename = $path.$innovation->image;
                
                Storage::disk('file')->delete($oldFilename);
                $file->storeAs($path, $filename, 'file');
            }

            $innovation->update([
                'member_id' => $request->member,
                'major_id' => $request->major,
                'team' => implode($request->teams),
                'name' => $request->name,
                'description' => $request->description,
                'video' => ($request->video !== null) ? $video : $innovation->video,
                'image' => ($request->hasFile('image')) ? $filename : $innovation->image,
            ]);
        });

        return redirect()->route('innovation.index')->withToastSuccess('Produk inovasi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Innovation $innovation)
    {
        DB::transaction(function () use ($innovation) {
            Storage::disk('file')->delete('innovation/' . $innovation->image);
            $innovation->delete();
        });

        return redirect()->route('innovation.index')->withToastSuccess('Produk inovasi berhasil dihapus');
    }
}
