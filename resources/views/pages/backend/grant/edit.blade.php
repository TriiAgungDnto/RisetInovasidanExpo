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
                    <h1 class="m-0">Edit Grant</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('grant.index') }}">Grant</a>
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
            <form action="{{ route('grant.update', $grant) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Informasi Hibah</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Judul Penelitian <small>*</small></label>
                                    <input type="text" class="form-control form-control-sm" id="title" name="title"
                                        value="{{ old('title') ?? $grant->title }}">
                                </div>

                                <div class="form-group">
                                    <label for="schema">Skema <small>*</small></label>
                                    <input type="text" class="form-control form-control-sm" id="schema" name="schema"
                                        value="{{ old('schema') ?? $grant->schema }}">
                                </div>

                                <div class="form-group">
                                    <label for="year">Tahun <small>*</small></label>
                                    <input type="text" class="form-control form-control-sm" id="year" name="year"
                                        value="{{ old('year') ?? $grant->year }}">
                                </div>

                                <div class="form-group">
                                    <label for="funding">Sumber Pendanaan <small>*</small></label>
                                    <input type="text" class="form-control form-control-sm" id="funding" name="funding"
                                        value="{{ old('funding') ?? $grant->funding }}">
                                </div>
                                <div class="form-group">
                                    <label for="url">Url Link <small>*</small></label>
                                    <input type="text" class="form-control form-control-sm" id="url" name="url"
                                        value="{{ old('url') ?? $grant->url }}">
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
                                            <option value="{{ $member->id }}"
                                                {{ old('member') == $member->id ? 'selected' : '' }}
                                                {{ $grant->member_id == $member->id ? 'selected' : '' }}>
                                                {{ $member->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="team">Anggota <small>*</small></label>
                                    <input type="text" id="team" name="teams[]"
                                        class="@error('teams') is-invalid @enderror"
                                        value="{{ old('teams.0') ?? $grant->team }}" data-role="tagsinput" required />
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
                        <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        <button type="button" onclick="window.location.href='{{ route('grant.index') }}'"
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
        $(document).ready(function() {
            $(function() {
                bsCustomFileInput.init();
            });

            let input = document.querySelector('#team');
            new Tagify(input);
        });
    </script>
@endpush
