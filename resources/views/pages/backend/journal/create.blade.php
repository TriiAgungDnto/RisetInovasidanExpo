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
                <h1 class="m-0">Create Journal</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('journal.index') }}">Journal</a>
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
        <form action="{{ route('journal.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Jurnal</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Judul <small>*</small></label>
                                <input type="text" class="form-control form-control-sm" id="title" name="title"
                                    value="{{ old('title') }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Nama Jurnal <small>*</small></label>
                                <input type="text" class="form-control form-control-sm" id="name" name="name"
                                    value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="volume">Volume dan Nomor <small>*</small></label>
                                <input type="text" class="form-control form-control-sm" id="volume" name="volume"
                                    value="{{ old('volume') }}">
                            </div>
                            <div class="form-group">
                                <label for="page">Halaman <small>*</small></label>
                                <input type="text" class="form-control form-control-sm" id="page" name="page"
                                    value="{{ old('page') }}">
                            </div>
                            <div class="form-group">
                                <label for="year">Tahun <small>*</small></label>
                                <input type="text" class="form-control form-control-sm" id="year" name="year"
                                    value="{{ old('year') }}">
                            </div>
                            <div class="form-group">
                                <label for="type">Jenis <small>*</small></label>
                                <select name="type" id="type" class="form-control form-control-sm">
                                    <option disabled selected></option>
                                    <option value="nasional" {{ old('type') == 'nasional' ? 'selected' : '' }}>Nasional
                                    </option>
                                    <option value="internasional"
                                        {{ old('type') == 'internasional' ? 'selected' : '' }}>Internasional</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="p_issn">P-ISSN</label>
                                <input type="text" class="form-control form-control-sm" id="p_issn" name="p_issn"
                                    value="{{ old('p_issn') }}">
                            </div>
                            <div class="form-group">
                                <label for="e_issn">E-ISSN <small>*</small></label>
                                <input type="text" class="form-control form-control-sm" id="e_issn" name="e_issn"
                                    value="{{ old('e_issn') }}">
                            </div>
                            <div class="form-group">
                                <label for="url">URL <small>*</small></label>
                                <input type="text" class="form-control form-control-sm" id="url" name="url"
                                    value="{{ old('url') }}">
                            </div>
                            <div class="form-group">
                                <label for="file">File <small>*</small></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('file') is-invalid @enderror"
                                        id="file" name="file">
                                    <label class="custom-file-label" for="file">Choose file</label>
                                    @error('file')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">
                    <!-- Form Element sizes -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Penulis</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="member">Nama <small>*</small></label>
                                <select name="member" id="member" class="form-control form-control-sm">
                                    <option disabled selected></option>
                                    @foreach ($members as $member)
                                    <option value="{{ $member->id}}"
                                        {{ old('member') == $member->id ? 'selected' : ''  }}>{{ $member->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="major">Program Studi <small>*</small></label>
                                <select name="major" id="major" class="form-control form-control-sm">
                                    <option disabled selected></option>
                                    @foreach ($majors as $major)
                                    <option value="{{ $major->id}}" {{ old('major') == $major->id ? 'selected' : ''  }}>
                                        {{ $major->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="team">Anggota <small>*</small></label>
                                <input type="text" id="team" name="teams[]" class="@error('teams') is-invalid @enderror"
                                    value="{{ old('teams.0') }}" data-role="tagsinput" required />
                                @error('teams')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <button type="submit" class="btn btn-primary btn-xs">Create</button>
                    <button type="button" onclick="location.href='{{ route('journal.index') }}'"
                        class="btn btn-secondary btn-xs">Cancel</button>
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@push('b-script')
<!-- Tagify -->
<script src="{{ asset('cms/tagify/tagify.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $(function () {
            bsCustomFileInput.init();
        });

        let input = document.querySelector('#team');
        new Tagify(input);
    });

</script>
@endpush
