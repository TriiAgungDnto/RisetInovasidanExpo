@extends('layouts.app')

@section('t-script')
    <link rel="stylesheet" href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')
    <section class="single">
        <div class="single-header">
            <h1 class="single-header-title">Seminar</h1>
        </div>
        <div class="container">
            <div class="row my-4">
                <div class="col-12">
                    <table class="table table-responsive table-striped table-sm" id="table-data" style="font-size: 14px">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 800px;">Nama</th>
                                <th scope="col" style="width: 100px;">Anggota</th>
                                <th scope="col" style="width: 800px;">Judul</th>
                                <th scope="col" style="width: 100px;">Jenis</th>
                                <th scope="col" style="width: 800px;">Nama</th>
                                <th scope="col" style="width: 100px;">Pelaksana</th>
                                <th scope="col" style="width: 100px;">Lokasi</th>
                                <th scope="col" style="width: 100px;">Tanggal Pelaksanaan</th>
                                <th scope="col" style="width: 100px;">ISBN</th>
                                <th scope="col" class="text-center" style="width: 400px;">Link Jurnal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($conferences as $conference)
                                <tr>
                                    <th scope="row">{{ $conference->member->name }}</th>
                                    <td class="d-flex flex-column">
                                        @foreach (json_decode($conference->team) as $item)
                                            <small class="bg-secondary rounded-lg p-1 my-1 text-white"
                                                style="line-height: 1">{{ $item->value }}</small>
                                        @endforeach
                                    </td>
                                    <td>{{ $conference->title }}</td>
                                    <td>{{ $conference->type }}</td>
                                    <td>{{ $conference->name }}</td>
                                    <td>{{ $conference->organizer }}</td>
                                    <td>{{ $conference->location }}</td>
                                    <td>{{ $conference->start_date->isoFormat('DD MMMM Y') }}</td>
                                    <td>{{ $conference->isbn }}</td>
                                    <td style="text-align: center; height: 100px; line-height: 100px;">
                                        @if (!is_null($conference->url))
                                            <a href="{{ $conference->url }}" target="_blank"><i class="fas fa-file-alt"
                                                    style="font-size: 28px;"></i></a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    {{-- <td class="text-center">
                                        <a href="{{ asset('file/conference/' . $conference->file) }}">
                                            <button class="btn btn-sm btn-info"><i class="fas fa-download"></i></button>
                                        </a>
                                    </td> --}}
                                </tr>


                            @empty
                                <tr>
                                    <th scope="row" colspan="10" class="text-center">Tidak ada data</th>
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
