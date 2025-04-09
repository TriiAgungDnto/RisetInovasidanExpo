<?php

namespace App\Http\Controllers\Backend;

use App\Models\Member;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all();

        return view('pages.backend.member.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.backend.member.create');
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
            'nip' => 'required|unique:members,nip|string|between:9,10',
            'name' => 'required|string'
        ]);

        Member::create([
            'nip' => $request->nip,
            'name' => Str::title($request->name)
        ]);

        return redirect()->route('member.index')->withToastSuccess('New member has been added');
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
    public function edit(Member $member)
    {
        return view('pages.backend.member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'nip' => 'required|size:10|string|unique:members,nip,' . $member->id,
            'name' => 'required|string'
        ]);

        $member->update([
            'nip' => $request->nip,
            'name' => Str::title($request->name)
        ]);

        return redirect()->route('member.index')->withToastSuccess('The member has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('member.index')->withToastSuccess('The member has been deleted');
    }
}
