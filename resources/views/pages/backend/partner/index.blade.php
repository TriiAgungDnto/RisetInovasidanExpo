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
                <h1 class="m-0">Partners</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Partners</li>
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
                        <a href="{{ route('partner.create') }}">
                            <button class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Partner</button>
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="partners-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Position</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Logo</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($partners as $partner)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $partner->name }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-xs btn-primary" data-toggle="modal"
                                            data-target="#modal-logo" data-logo={{ asset('file/partner/'.$partner->logo)
                                            }}>
                                            <i class="fas fa-image"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('partner.edit', $partner) }}"><button
                                                class="btn btn-info btn-xs"><i class="fa fa-edit"></i></button></a>
                                        <button class="btn btn-danger btn-xs" id="btn-delete" data-toggle="modal"
                                            data-target="#modal-delete"
                                            data-url="{{ route('partner.destroy', $partner) }}"
                                            data-name="{{ $partner->name }}"><i class="fa fa-trash"></i></button>
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

<!-- Logo modal -->
<div class="modal fade" id="modal-logo" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Partner Logo</h4>
            </div>
            <div class="modal-body text-center">
                <img class="img-fluid partner-logo">
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
                <h4 class="modal-title">Deleting Partner</h4>
            </div>
            <form id="form-delete" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p class="text-center">Do you want to delete "<span id="partner-name" class="text-danger"></span>"
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
        $('#partners-table').DataTable({
            "responsive": true,
        });

        $('#modal-logo').on('show.bs.modal', function (e) {
            const logo = $(e.relatedTarget).data('logo');
            $('.modal-body .partner-logo').attr('src', logo);
        });
        $('#modal-delete').on('show.bs.modal', function (e) {
            const url = $(e.relatedTarget).data('url');
            const name = $(e.relatedTarget).data('name');
            $('#form-delete').attr('action', url);
            $('.modal-body #partner-name').text(name);
        });
    });

</script>
@endpush