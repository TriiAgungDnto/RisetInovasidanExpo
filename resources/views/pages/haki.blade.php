@extends('layouts.app')

@section('t-script')
<link rel="stylesheet" href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')
<section class="single">
    <div class="single-header">
        <h1 class="single-header-title">HAKI</h1>
    </div>
    <div class="container">
        <div class="row my-4">
            <div class="col-12">
                <table class="table table-responsive table-striped table-sm" id="table-data" style="font-size: 14px">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Anggota</th>
                            <th scope="col">No. Pendaftaran</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($hakis as $haki)
                        <tr>
                            <th scope="row">{{ $haki->member->name }}</th>
                            <td class="d-flex flex-column">
                                @foreach (json_decode($haki->team) as $item)
                                <small class="bg-secondary rounded-lg p-1 my-1 text-white" style="line-height: 1">{{
                                    $item->value }}</small>
                                @endforeach
                            </td>
                            <td>
                                @if (!is_null($haki->url))
                                <a href="{{ $haki->url }}" target="_blank">{{ $haki->register_number }}</a>
                                @else
                                {{ $haki->register_number }}
                                @endif
                            </td>
                            <td>{{ $haki->title }}</td>
                            <td>{{ $haki->type }}</td>
                            <td class="text-center">
                                <a href="{{ asset('file/haki/'. $haki->file) }}">
                                    <button class="btn btn-sm btn-info"><i class="fas fa-download"></i></button>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <th scope="row" colspan="6" class="text-center">Tidak ada data</th>
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
    $(document).ready(function () {
        $('#table-data').DataTable({
            responsive: true
        });
    });

</script>
@endpush