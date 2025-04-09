@extends('layouts.backend.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Member</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('member.index') }}">Members</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $member->name }}</li>
                </ol>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form action="{{ route('member.update', $member) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row justify-content-center">
                <!-- left column -->
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Informasi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">NIP/NIDN <small>*</small></label>
                                <input type="text" id="nip" name="nip"
                                    class="form-control form-control-sm @error('nip') is-invalid @enderror"
                                    value="{{ old('nip') ?? $member->nip }}" required>
                                @error('nip')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Nama <small>*</small></label>
                                <input type="text" id="name" name="name"
                                    class="form-control form-control-sm @error('name') is-invalid @enderror"
                                    value="{{ old('name') ?? $member->name }}" required>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info btn-xs">Update</button>
                            <button type="button" onclick="location.href='{{ route('member.index') }}'"
                                class="btn btn-secondary btn-xs">Cancel</button>
                        </div>
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
