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
                <h1 class="m-0">Innovation</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Innovation</li>
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
                        <a href="{{ route('innovation.create') }}">
                            <button class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Innovation</button>
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="innovations-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NIP/NIDN</th>
                                    <th scope="col">Program Studi</th>
                                    <th scope="col">Anggota</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Video</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($innovations as $innovation)
                                <tr>
                                    <td>{{ $innovation->member->name }}</td>
                                    <td>{{ $innovation->member->nip }}</td>
                                    <td>{{ $innovation->major->name }}</td>
                                    <td class="d-flex flex-column">
                                        @foreach (json_decode($innovation->team) as $item)
                                        <small class="bg-secondary rounded-lg p-1 my-1">{{ $item->value }}</small>
                                        @endforeach
                                    </td>
                                    <td>{{ $innovation->name }}</td>
                                    <td>{{ $innovation->description }}</td>
                                    <td>
                                        @if ($innovation->video !== null)
                                        <a href="https://www.youtube.com/watch?v={{ $innovation->video }}"
                                            target="_blank" rel="noopener noreferrer">
                                            <button class="btn btn-xs btn-danger">
                                                <i class="fab fa-youtube"></i>
                                            </button>
                                        </a>
                                        @else
                                        No Video
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-xs btn-primary" data-toggle="modal"
                                            data-target="#modal-image" data-name="{{ $innovation->name }}"
                                            data-image="{{ asset('file/innovation/'.$innovation->image) }}">
                                            <i class="fa fa-image"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <a href="{{ route('innovation.edit', $innovation) }}"><button
                                                class="btn btn-info btn-xs"><i class="fa fa-edit"></i></button></a>
                                        <button class="btn btn-danger btn-xs" id="btn-delete" data-toggle="modal"
                                            data-target="#modal-delete"
                                            data-url="{{ route('innovation.destroy', $innovation) }}"
                                            data-name="{{ $innovation->name }}"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="13">Belum ada data</td>
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

<!-- Image modal -->
<div class="modal fade" id="modal-image" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <img id="innovation-image" class="img-fluid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete modal -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Deleting Innovation</h4>
            </div>
            <form id="form-delete" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p class="text-center">Do you want to delete "<span id="innovation-title"
                            class="text-danger"></span>"
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
        $('#innovations-table').DataTable({
            "responsive": true,
        });

        $('#modal-image').on('show.bs.modal', function (e) {
            const image = $(e.relatedTarget).data('image');
            const name = $(e.relatedTarget).data('name');
            $('.modal-header .modal-title').text(name);
            $('.modal-body #innovation-image').attr('src', image);
        });

        $('#modal-delete').on('show.bs.modal', function (e) {
            const url = $(e.relatedTarget).data('url');
            const name = $(e.relatedTarget).data('name');
            $('#form-delete').attr('action', url);
            $('.modal-body #innovation-title').text(name);
        });
    });

</script>
@endpush
