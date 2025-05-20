@extends('layouts.app')

@section('t-script')
    <link rel="stylesheet" href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')
    <section class="single">
        <div class="single-header">
            <h1 class="single-header-title">Buku</h1>
        </div>
        <div class="container">
            <div class="row my-4">
                <div class="col-12">
                    <table class="table table-responsive table-striped table-sm" id="table-data" style="font-size: 14px">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Anggota</th>
                                <th scope="col">Judul Buku</th>
                                <th scope="col">Penerbit</th>
                                <th scope="col">Jumlah Halaman</th>
                                <th scope="col">Tahun</th>
                                <th scope="col">ISBN</th>
                                <th scope="col" class="text-center" style="width: 100px;">Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($books as $book)
                                <tr>
                                    <th scope="row">{{ $book->member->name }}</th>
                                    <td class="d-flex flex-column">
                                        @foreach (json_decode($book->team) as $item)
                                            <small class="bg-secondary rounded-lg p-1 my-1 text-white"
                                                style="line-height: 1">{{ $item->value }}</small>
                                        @endforeach
                                    </td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->publisher }}</td>
                                    <td>{{ $book->page }}</td>
                                    <td>{{ $book->year }}</td>
                                    <td>{{ $book->isbn }}</td>
                                    <td style="text-align: center; height: 100px; line-height: 100px;">
                                        @if (!is_null($book->url))
                                            <a href="{{ $book->url }}" target="_blank"><i class="fas fa-file-alt"
                                                    style="font-size: 28px;"></i></a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th scope="row" colspan="8" class="text-center">Tidak ada data</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('b-script')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#table-data').DataTable({
                responsive: true
            });
        });
    </script>
@endpush
