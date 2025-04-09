@extends('layouts.backend.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Partner</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('partner.index') }}">Partner</a>
                    </li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form action="{{ route('partner.update', $partner) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <!-- left column -->
                <div class="col-md-6 offset-md-3">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Partner</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Partner <small>*</small></label>
                                <input type="text" class="form-control form-control-sm" id="name" name="name"
                                    value="{{ old('name') ?? $partner->name }}">
                            </div>
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <input type="file" class="custom-file" id="logo" name="logo">
                                <small>Kosongkan jika tidak mengubah logo</small>
                            </div>
                            <button type="submit" class="btn btn-info btn-xs">Update</button>
                            <button type="button" onclick="location.href='{{ route('partner.index') }}'"
                                class="btn btn-secondary btn-xs">Cancel</button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection