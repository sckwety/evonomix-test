@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card overflow-auto">
                    <div class="card-header">Photos</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.photos.index') }}" class="mb-2">
                            <div class="form-group row">
                                <label for="search" class="col-md-4 col-form-label text-md-right">{{ __('Search') }}</label>

                                <div class="col-md-5">
                                    <input id="search" type="text" class="form-control" name="search" value="{{ request('search') }}">
                                </div>

                                <div class="col-md-3">
                                    <button class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>

                        @push('pages')
                            {{ $photos->appends(request()->query())->links() }}
                        @endpush

                        @stack('pages')

                        <table class="table table-striped table-hover w-100">
                            <thead>
                            <tr>
                                <th scope="col">Photo</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Publish Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($photos as $photo)
                                <tr>
                                    <td>
                                        <img src="{{ Storage::url($photo->photo_path) }}"
                                             alt="Photo not found"
                                             class="contain-center" width="100px" height="100px">
                                    </td>
                                    <td>
                                        {{ $photo->user->name }}
                                    </td>
                                    <td>
                                        {{ $photo->description }}
                                    </td>
                                    <td>
                                        {{ $photo->ispublished() ? 'published' : 'Not Published' }}
                                    </td>
                                    <td>
                                        {{ $photo->publish_date }}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle"
                                                    type="button" id="dropdownMenuActionsButton"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuActionsButton">
                                                <div class="dropdown-item">
                                                    <a href="{{ route('admin.user.email.create', $photo->user->id) }}" class="btn btn-success">Send Email</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        @stack('pages')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
