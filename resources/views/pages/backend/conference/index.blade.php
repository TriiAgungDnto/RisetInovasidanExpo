@extends('layouts.backend.app')

@section('t-script')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('cms/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('cms/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Conference</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Conference</li>
                </ol>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-end">
                        <a href="{{ route('conference.create') }}">
                            <button class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Conference</button>
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="conferences-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NIP/NIDN</th>
                                    <th scope="col">Program Studi</th>
                                    <th scope="col">Anggota</th>
                                    <th scope="col">Judul Artikel</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Nama Seminar</th>
                                    <th scope="col">Pelaksana</th>
                                    <th scope="col">Lokasi</th>
                                    <th scope="col">Tanggal Pelaksana</th>
                                    <th scope="col">ISBN</th>
                                    <th scope="col">File</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($conferences as $conference)
                                <tr>
                                    <td>{{ $conference->member->name }}</td>
                                    <td>{{ $conference->member->nip }}</td>
                                    <td>{{ $conference->major->name }}</td>
                                    <td class="d-flex flex-column">
                                        @foreach (json_decode($conference->team) as $item)
                                        <small class="bg-secondary rounded-lg px-1 my-1">{{ $item->value }}</small>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ $conference->url }}" target="_blank">
                                            {{ $conference->title }}
                                        </a>
                                    </td>
                                    <td>{{ $conference->type }}</td>
                                    <td>{{ $conference->name }}</td>
                                    <td>{{ $conference->organizer }}</td>
                                    <td>{{ $conference->location }}</td>
                                    <td class="d-flex flex-column align-items-center">
                                        {{ $conference->start_date->isoFormat('DD MMMM Y') }}
                                        <span>s.d</span>
                                        {{ $conference->end_date->isoFormat('DD MMMM Y') }}
                                    </td>
                                    <td>{{ $conference->isbn }}</td>
                                    <td>
                                        <a href="{{ asset('file/conference/'. $conference->file) }}">
                                            <button class="btn btn-xs btn-primary"><i
                                                    class="fas fa-download"></i></button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('conference.edit', $conference) }}"><button
                                                class="btn btn-info btn-xs"><i class="fa fa-edit"></i></button></a>
                                        <button class="btn btn-danger btn-xs" id="btn-delete" data-toggle="modal"
                                            data-target="#modal-delete"
                                            data-url="{{ route('conference.destroy', $conference) }}"
                                            data-title="{{ $conference->title }}"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="14">Belum ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>

<!-- Delete modal -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Deleting Conference</h4>
            </div>
            <form id="form-delete" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p class="text-center">Do you want to delete "<span id="conference-title"
                            class="text-danger"></span>" ?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /modals -->
@endsection

@push('b-script')
<!-- DataTables  & Plugins -->
<script src="{{ asset('cms/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('cms/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('cms/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('cms/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#conferences-table').DataTable({
            "responsive": true,
        });

        $('#modal-delete').on('show.bs.modal', function (e) {
            const url = $(e.relatedTarget).data('url');
            const title = $(e.relatedTarget).data('title');
            $('#form-delete').attr('action', url);
            $('.modal-body #conference-title').text(title);
        });
    });

</script>
@endpush
