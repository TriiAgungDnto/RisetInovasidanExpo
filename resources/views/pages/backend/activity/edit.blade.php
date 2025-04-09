@extends('layouts.backend.app')

@section('t-script')
<!-- Tagify -->
<link href="{{ asset('cms/tagify/tagify.css') }}" rel="stylesheet">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Activity</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('activity.index') }}">Activity</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form action="{{ route('activity.update', $activity) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Aktivitas</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Judul <small>*</small></label>
                                <input type="text" class="form-control form-control-sm" id="title" name="title"
                                    value="{{ old('title') ?? $activity->title }}">
                            </div>

                            <div class="form-group">
                                <label for="description">Deskripsi <small>*</small></label>
                                <textarea class="form-control form-control-sm" name="description" id="description"
                                    rows="3">{{ old('description') ?? $activity->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="video">Tautan Video <small>*</small></label>
                                <input type="text" class="form-control form-control-sm" id="video" name="video"
                                    value="{{ old('video') }}">
                                <small class="text-muted">Kosongkan jika tidak mengubah video, tautan video hanya dari
                                    YouTube.</small>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <button type="submit" class="btn btn-info btn-xs">Update</button>
                    <button type="button" onclick="location.href='{{ route('activity.index') }}'"
                        class="btn btn-secondary btn-xs">Cancel</button>
                </div>
            </div>
            <!-- /.row -->
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
