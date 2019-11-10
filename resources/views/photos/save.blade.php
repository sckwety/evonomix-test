@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ isset($photo) ? 'Update' : 'Create' }} Photo</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('photos.update', $photo->id ?? '') }}"
                              method="post" enctype="multipart/form-data">
                            @csrf
                            @if(isset($photo)) @method('put') @endif

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Description') }}
                                </label>

                                <div class="col-md-6">
                                    <textarea id="description" type="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              name="description" required>{{
                                                    old('description', $photo->description ?? '')
                                              }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="publish_date" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Publish Date') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="publish_date" type="text"
                                           class="form-control datetimepicker @error('publish_date') is-invalid @enderror"
                                           name="publish_date"
                                           value="{{ old('publish_date', $photo->publish_date ?? date('Y-m-d H:i:s')) }}"
                                           required autocomplete="publish_date" autofocus>

                                    @error('publish_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="upload-image-container col-form-label row"
                                           title="Click to select photo"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           style="cursor: pointer;">
                                        <span class="col-md-4 text-md-right">
                                            {{ __('Upload img') }}
                                        </span>
                                        <img src="{{ $photoUrl ?? '/images/default.png' }}" alt="Upload img"
                                             class="col-md-6 contain-center preview"
                                             style="max-height: 200px">
                                        <input type="file" name="photo"
                                               class="d-none form-control @error('photo') is-invalid @enderror">
                                        @error('photo')
                                        <span class="invalid-feedback col-md-6 offset-md-4" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit Art') }}
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
