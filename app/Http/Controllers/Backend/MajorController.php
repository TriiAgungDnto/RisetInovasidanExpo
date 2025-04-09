<?php

namespace App\Http\Controllers\Backend;

use App\Models\Major;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $majors = Major::all();
        
        return view('pages.backend.major.index', compact('majors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.backend.major.create');
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
            'name' => 'required|unique:majors,name'
        ]);

        Major::create([
            'name' => Str::title($request->name)
        ]);

        return redirect()->route('major.index')->withToastSuccess('New major has been added successfully');
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
    public function edit(Major $major)
    {
        return view('pages.backend.major.edit', compact('major'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Major $major)
    {
        $request->validate([
            'name' => 'required|unique:majors,name,' . $major->id
        ]);

        $major->update([
            'name' => Str::title($request->name)
        ]);

        return redirect()->route('major.index')->withToastSuccess('The major has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Major $major)
    {
        $major->delete();

        return redirect()->route('major.index')->withToastSuccess('The major has been deleted');
    }
}
