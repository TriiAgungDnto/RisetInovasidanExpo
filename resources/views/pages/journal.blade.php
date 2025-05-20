@extends('layouts.app')

@section('t-script')
    <link rel="stylesheet" href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')
    <section class="single">
        <div class="single-header">
            <h1 class="single-header-title">Jurnal</h1>
        </div>
        <div class="container">
            <div class="row my-4">
                <div class="col-12">
                    <table class="table table-responsive table-striped table-sm" id="table-data" style="font-size: 14px">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Anggota</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Nama Jurnal</th>
                                <th scope="col">Volume dan Nomor</th>
                                <th scope="col">Halaman</th>
                                <th scope="col">Tahun</th>
                                <th scope="col">Jenis</th>
                                <th scope="col">P-ISSN</th>
                                <th scope="col">E-ISSN</th>
                                <th scope="col" class="text-center" style="width: 400px;">Link Jurnal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($journals as $journal)
                                <tr>
                                    <th scope="row">{{ $journal->member->name }}</th>
                                    <td class="d-flex flex-column">
                                        @foreach (json_decode($journal->team) as $item)
                                            <small class="bg-secondary rounded-lg p-1 my-1 text-white"
                                                style="line-height: 1">{{ $item->value }}</small>
                                        @endforeach
                                    </td>
                                    <td>{{ $journal->title }}</td>
                                    <td>{{ $journal->name }}</td>
                                    <td>{{ $journal->volume }}</td>
                                    <td>{{ $journal->page }}</td>
                                    <td>{{ $journal->year }}</td>
                                    <td>{{ $journal->type }}</td>
                                    <td>{{ $journal->p_issn }}</td>
                                    <td>{{ $journal->e_issn }}</td>
                                    <td class="text-center align-middle h-[50px]">
                                        @if (!is_null($journal->url))
                                            <a href="{{ $journal->url }}" target="_blank"><i class="fas fa-file-alt"
                                                    style="font-size: 28px;"></i></a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th scope="row" colspan="11" class="text-center">Tidak ada data</th>
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
