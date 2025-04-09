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
                <h1 class="m-0">Journal</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Journal</li>
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
                        <a href="{{ route('journal.create') }}">
                            <button class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Journal</button>
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="journals-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NIP/NIDN</th>
                                    <th scope="col">Program Studi</th>
                                    <th scope="col">Anggota</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Nama Jurnal</th>
                                    <th scope="col">Volume dan Nomor</th>
                                    <th scope="col">Halaman</th>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">P-ISSN</th>
                                    <th scope="col">E-ISSN</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">File</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($journals as $journal)
                                <tr>
                                    <td>{{ $journal->member->name }}</td>
                                    <td>{{ $journal->member->nip }}</td>
                                    <td>{{ $journal->major->name }}</td>
                                    <td class="d-flex flex-column">
                                        @foreach (json_decode($journal->team) as $item)
                                        <small class="bg-secondary rounded-lg px-1 my-1">{{ $item->value }}</small>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ $journal->url }}" target="_blank">
                                            {{ $journal->title }}
                                        </a>
                                    </td>
                                    <td>{{ $journal->name }}</td>
                                    <td>{{ $journal->volume }}</td>
                                    <td>{{ $journal->page }}</td>
                                    <td>{{ $journal->year }}</td>
                                    <td>{{ $journal->p_issn }}</td>
                                    <td>{{ $journal->e_issn }}</td>
                                    <td>{{ $journal->type }}</td>
                                    <td>
                                        <a href="{{ asset('file/journal/'. $journal->file) }}">
                                            <button class="btn btn-xs btn-primary"><i
                                                    class="fas fa-download"></i></button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('journal.edit', $journal) }}"><button
                                                class="btn btn-info btn-xs"><i class="fa fa-edit"></i></button></a>
                                        <button class="btn btn-danger btn-xs" id="btn-delete" data-toggle="modal"
                                            data-target="#modal-delete"
                                            data-url="{{ route('journal.destroy', $journal) }}"
                                            data-title="{{ $journal->title }}"><i class="fa fa-trash"></i></button>
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
                <h4 class="modal-title">Deleting Journal</h4>
            </div>
            <form id="form-delete" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p class="text-center">Do you want to delete "<span id="journal-title" class="text-danger"></span>"
                        ?
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
        $('#journals-table').DataTable({
            "responsive": true,
        });

        $('#modal-delete').on('show.bs.modal', function (e) {
            const url = $(e.relatedTarget).data('url');
            const title = $(e.relatedTarget).data('title');
            $('#form-delete').attr('action', url);
            $('.modal-body #journal-title').text(title);
        });
    });

</script>
@endpush
