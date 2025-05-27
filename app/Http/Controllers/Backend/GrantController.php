<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Grant;
use App\Models\Member;
use Illuminate\Http\Request;

class GrantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grants = Grant::all();

        return view('pages.backend.grant.index', compact('grants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::all();

        return view('pages.backend.grant.create', compact('members'));
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
            'teams' => 'required',
            'title' => 'required',
            'schema' => 'required',
            'year' => 'required',
            'funding' => 'required',
            'url' => 'required',
        ]);

        Grant::create([
            'member_id' => $request->member,
            'team' => implode($request->teams),
            'title' => $request->title,
            'schema' => $request->schema,
            'year' => $request->year,
            'funding' => $request->funding,
            'url' => $request->url,
        ]);

        return redirect()->route('grant.index')->withToastSuccess('Hibah berhasil dibuat');
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
    public function edit(Grant $grant)
    {
        $members = Member::all();

        return view('pages.backend.grant.edit', compact('grant', 'members'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grant $grant)
    {
        $request->validate([
            'member' => 'required',
            'teams' => 'required',
            'title' => 'required',
            'schema' => 'required',
            'year' => 'required',
            'funding' => 'required',
            'url' => 'required',
        ]);

        $grant->update([
            'member_id' => $request->member,
            'team' => implode($request->teams),
            'title' => $request->title,
            'schema' => $request->schema,
            'year' => $request->year,
            'funding' => $request->funding,
            'url' => $request->url,
        ]);

        return redirect()->route('grant.index')->withToastSuccess('Hibah berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grant $grant)
    {
        $grant->delete();

        return redirect()->route('grant.index')->withToastSuccess('Hiba berhasil dihapus');
    }
}
