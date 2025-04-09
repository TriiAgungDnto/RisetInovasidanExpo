@extends('layouts.backend.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Poster</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Poster</li>
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
                    <div class="card-body">
                        <form @if (is_null($poster)) action="{{ route('poster.store') }}" @else
                            action="{{ route('poster.update', $poster) }}" @endif method="POST"
                            enctype="multipart/form-data">
                            <div class="row">
                                @csrf
                                @if (!is_null($poster))
                                @method('PATCH')
                                @endif
                                <div class="col-md-6 text-center">
                                    @if (!is_null($poster))
                                    <img src="{{ asset('file/poster/'.$poster->poster) }}" alt="Poster Riset Inovasi"
                                        class="img-fluid" style="max-width: 50%;">
                                    @endif

                                    <div class="form-group text-left mt-3">
                                        <label for="name">Nama Poster</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ (!is_null($poster) ? $poster->name : '') }}"
                                            placeholder="Poster riset inovasi">
                                    </div>
                                    <div class="form-group text-left">
                                        <label for="poster">Poster</label>
                                        <input type="file" class="form-control-file" id="poster" name="poster">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <label for="about">Tentang Riset &amp; Inovasi Expo</label>
                                    <textarea class="form-control" name="about" id="about"
                                        rows="20">{{ (!is_null($poster) ? $poster->about : '') }}</textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <button class="btn btn-info btn-block">Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>
@endsection