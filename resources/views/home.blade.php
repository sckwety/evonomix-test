@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Gallery</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @push('pages')
                        {{ $photos->appends(request()->query())->links() }}
                    @endpush

                    @stack('pages')

                    <table class="table table-striped table-hover w-100">
                        <thead>
                        <tr>
                            <th scope="col">Photo</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Publish Date</th>
                            <th scope="col">Description</th>
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
                                    {{ $photo->publish_date }}
                                </td>
                                <td>
                                    {{ $photo->description }}
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
