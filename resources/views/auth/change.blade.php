@extends('layouts.backend.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Change Password</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Change Password</li>
                </ol>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form action="{{ route('profile.password.change', auth()->id()) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row">
                <!-- left column -->
                <div class="col-md-4 offset-md-4">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Pengguna</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <label class="control-label" for="current_password">Password lama</label>
                                <input type="password" class="form-control form-control-sm" name="current_password"
                                    id="current_password" required>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="form-group @error('password') is-invalid @enderror">
                                <label class="control-label" for="password">Password baru</label>
                                <input type="password" class="form-control form-control-sm" name="password"
                                    id="password" required>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password_confirm">Konfirmasi password baru</label>
                                <input type="password" class="form-control form-control-sm" name="password_confirmation"
                                    id="password_confirm" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info btn-sm">Update</button>
                            <button type="button" onclick="location.href='{{ url()->previous() }}'"
                                class="btn btn-secondary btn-sm">Cancel</button>
                        </div>
                        <!-- /.card-footer -->
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
