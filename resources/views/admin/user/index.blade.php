@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card overflow-auto">
                    <div class="card-header">Users</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.users.index') }}" class="mb-2">
                            <div class="form-group row">
                                <label for="search" class="col-md-4 col-form-label text-md-right">{{ __('Search') }}</label>

                                <div class="col-md-6">
                                    <input id="search" type="text" class="form-control" name="search" value="{{ request('search') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="gender" id="gender">
                                        <option value="">~{{ __('All') }}~</option>

                                        <option value="male" @if(request('gender') == 'male') selected @endif >{{ __('Male') }}</option>
                                        <option value="female" @if(request('gender') == 'female') selected @endif >{{ __('Female') }}</option>
                                        <option value="other" @if(request('gender') == 'other') selected @endif >{{ __('Other') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="age-interval" class="col-md-4 col-form-label text-md-right">{{ __('Age Interval') }}</label>

                                <div class="col-md-3">
                                    <input id="start_age" type="number" class="form-control"
                                           name="start_age" value="{{ request('start_age') }}"
                                           placeholder="Start Age">
                                </div>
                                <div class="col-md-3">
                                    <input id="end_age" type="number" class="form-control"
                                           name="end_age" value="{{ request('end_age') }}"
                                           placeholder="End Age">
                                </div>
                            </div>

                            <div class="d-flex">
                                <button class="btn btn-primary m-auto">Filter</button>
                            </div>
                        </form>

                        @push('pages')
                            {{ $users->appends(request()->query())->links() }}
                        @endpush

                        @stack('pages')

                        <table class="table table-striped table-hover w-100">
                            <thead>
                            <tr>
                                <th scope="col">User Name</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Birthday</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->gender }}
                                    </td>
                                    <td>
                                        {{ $user->birthday }}
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
                                                    <a href="{{ route('admin.user.email.create', $user->id) }}" class="btn btn-success">Send Email</a>
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
