<?php

namespace App\Http\Controllers\Backend;

use App\Models\Partner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::all();

        return view('pages.backend.partner.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.backend.partner.create');
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
            'name' => 'required|string|unique:partners',
            'logo' => 'required|image|mimes:jpeg,png'
        ]);

        DB::transaction(function () use ($request) {
            $file = $request->file('logo');
            $path = 'partner/';
            $filename = Str::slug($request->name) . '-' . time() . '.' . $file->extension();
            $file->storeAs($path, $filename, 'file');
            
            Partner::create([
                'name' => $request->name,
                'logo' => $filename,
            ]);
        });

        return redirect()->route('partner.index')->withToastSuccess('Partner telah berhasil disimpan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        return view('pages.backend.partner.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png',
        ]);

        DB::transaction(function () use ($request, $partner) {
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $path = 'partner/';
                $filename = Str::slug($request->name) . '-' . time() . '.' . $file->extension();
                $file->storeAs($path, $filename, 'file');

                $oldFilename = $path.$partner->logo;
                
                Storage::disk('file')->delete($oldFilename);
                $file->storeAs($path, $filename, 'file');
            }

            $partner->update([
                'name' => $request->name,
                'logo' => ($request->hasFile('logo')) ? $filename : $partner->logo,
            ]);
        });

        return redirect()->route('partner.index')->withToastSuccess('Partner berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        DB::transaction(function () use ($partner) {
            Storage::disk('file')->delete('partner/'.$partner->logo);
            $partner->delete();
        });

        return redirect()->route('partner.index')->withToastSuccess('Partner berhasil dihapus');
    }
}
