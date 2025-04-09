<?php

namespace App\Http\Controllers\Backend;

use App\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::all();
        
        return view('pages.backend.activity.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.backend.activity.create');
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
            'title' => 'required|string|unique:activities',
            'description' => 'required|string|max:255',
            'video' => 'required|url'
        ]);

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

        Activity::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'video' => $video,
            'author' => auth()->id()
        ]);

        return redirect()->route('activity.index')->withToastSuccess('Aktivitas berhasil disimpan');
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
    public function edit(Activity $activity)
    {
        return view('pages.backend.activity.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'title' => 'required|string|unique:activities,title,' . $activity->id,
            'description' => 'required|string|max:255',
            'video' => 'nullable|url'
        ]);

        if (!is_null($request->video)) {
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

        $activity->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'video' => (!is_null($request->video)) ? $video : $activity->video,
            'author' => auth()->id()
        ]);

        return redirect()->route('activity.index')->withToastSuccess('Aktivitas berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()->route('activity.index')->withToastSuccess('Aktivitas berhasil dihapus');
    }
}
