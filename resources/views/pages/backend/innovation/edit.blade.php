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
                <h1 class="m-0">Edit Innovation</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('innovation.index') }}">Innovation</a>
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
        <form action="{{ route('innovation.update', $innovation) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Produk Inovasi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Produk <small>*</small></label>
                                <input type="text" class="form-control form-control-sm" id="name" name="name"
                                    value="{{ old('name') ?? $innovation->name }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi <small>*</small></label>
                                <input type="text" class="form-control form-control-sm" id="description"
                                    name="description" value="{{ old('description') ?? $innovation->description }}">
                            </div>
                            <div class="form-group">
                                <label for="video">Tautan Video</label>
                                <input type="text" class="form-control form-control-sm" id="video" name="video"
                                    value="{{ old('video') }}">
                                <small class="text-muted">Kosongkan jika tidak mengubah tautan video</small>
                            </div>
                            <div class="form-group">
                                <label for="image">Gambar</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                        id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                    <small class="text-muted">Kosongkan jika tidak mengubah gambar</small>
                                    @error('image')
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
                            <h3 class="card-title">Informasi Lanjutan</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="member">Nama <small>*</small></label>
                                <select name="member" id="member" class="form-control form-control-sm">
                                    <option disabled selected></option>
                                    @foreach ($members as $member)
                                    <option value="{{ $member->id}}"
                                        {{ old('member') == $member->id ? 'selected' : ''  }}
                                        {{ $innovation->member_id == $member->id ? 'selected' : ''  }}>
                                        {{ $member->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="major">Program Studi <small>*</small></label>
                                <select name="major" id="major" class="form-control form-control-sm">
                                    <option disabled selected></option>
                                    @foreach ($majors as $major)
                                    <option value="{{ $major->id}}" {{ old('major') == $major->id ? 'selected' : ''  }}
                                        {{ $innovation->major_id == $major->id ? 'selected' : ''  }}>
                                        {{ $major->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="team">Anggota <small>*</small></label>
                                <input type="text" id="team" name="teams[]" class="@error('teams') is-invalid @enderror"
                                    value="{{ old('teams.0') ?? $innovation->team }}" data-role="tagsinput" required />
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

                    <button type="submit" class="btn btn-info btn-xs">Update</button>
                    <button type="button" onclick="location.href='{{ route('innovation.index') }}'"
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
