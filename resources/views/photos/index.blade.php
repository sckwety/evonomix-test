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
                            <a class="btn btn-primary mb-2" href="{{ route('photos.create') }}">New</a>

                        <form action="{{ route('photos.index') }}" class="mb-2">
                            <label for="status">Status</label>
                            <select class="custom-select col-md-3" name="status" id="status"
                                    onchange="$(this).parents('form').submit()">
                                <option value="">All</option>
                                <option value="published"
                                        {{ (request()->status == 'published') ? 'selected' : '' }}>
                                    Published
                                </option>
                                <option value="not-published"
                                        {{ (request()->status == 'not-published') ? 'selected' : '' }}>
                                    Not Published
                                </option>
                            </select>
                        </form>

                        @push('pages')
                            {{ $photos->appends(request()->query())->links() }}
                        @endpush

                        @stack('pages')

                        <table class="table table-striped table-hover w-100">
                            <thead>
                            <tr>
                                <th scope="col">Photo</th>
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
                                                    <a href="{{ route('photos.edit', $photo->id) }}" class="btn btn-success">Edit</a>
                                                </div>
                                                <form action="{{ route('photos.destroy', $photo->id) }}"
                                                      method="post" class="form-confirm dropdown-item">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger">Delete</button>
                                                </form>
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
