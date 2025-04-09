<?php

namespace App\Http\Controllers\Backend;

use App\Models\Book;
use App\Models\Major;
use App\Models\Member;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::query()
            ->with('member', 'major')
            ->get();
            
        return view('pages.backend.book.index', compact('books'));
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

        return view('pages.backend.book.create', compact('members', 'majors'));
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
            'publisher' => 'required|string',
            'page' => 'required|string',
            'year' => 'required|string',
            'isbn' => 'required|string',
            'url' => 'nullable|url',
            'file' => 'required|mimes:pdf'
        ]);
        
        DB::transaction(function () use ($request) {
            $file = $request->file('file');
            $path = 'book/';
            $filename = Str::slug($request->title) . '-' . time() . '.' . $file->extension();
            $file->storeAs($path, $filename, 'file');
            
            Book::create([
                'member_id' => $request->member,
                'major_id' => $request->major,
                'team' => implode($request->teams),
                'title' => $request->title,
                'publisher' => $request->publisher,
                'page' => $request->page,
                'year' => $request->year,
                'isbn' => $request->isbn,
                'url' => $request->url,
                'file' => $filename
            ]);
        });

        return redirect()->route('book.index')->withToastSuccess('Buku berhasil disimpan');
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
    public function edit(Book $book)
    {
        $members = Member::all();
        $majors = Major::all();

        return view('pages.backend.book.edit', compact('book', 'members', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'member' => 'required|string',
            'major' => 'required|string',
            'teams' => 'required',
            'title' => 'required|string',
            'publisher' => 'required|string',
            'page' => 'required|string',
            'year' => 'required|string',
            'isbn' => 'required|string',
            'url' => 'nullable|url',
            'file' => 'nullable|mimes:pdf'
        ]);

        DB::transaction(function () use ($request, $book) {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = 'book/';
                $filename = Str::slug($request->title) . '-' . time() . '.' . $file->extension();
                $file->storeAs($path, $filename, 'file');

                $oldFilename = $path.$book->file;
                
                Storage::disk('file')->delete($oldFilename);
                $file->storeAs($path, $filename, 'file');
            }

            $book->update([
                'member_id' => $request->member,
                'major_id' => $request->major,
                'team' => implode($request->teams),
                'title' => $request->title,
                'volume' => $request->volume,
                'page' => $request->page,
                'year' => $request->year,
                'p_issn' => $request->p_issn,
                'e_issn' => $request->e_issn,
                'type' => $request->type,
                'url' => $request->url,
                'file' => ($request->hasFile('file')) ? $filename : $book->file
            ]);
        });

        return redirect()->route('book.index')->withToastSuccess('Buku berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        DB::transaction(function () use ($book) {
            Storage::disk('file')->delete('book/'.$book->file);
            $book->delete();
        });

        return redirect()->route('book.index')->withToastSuccess('Buku berhasil dihapus');
    }
}
