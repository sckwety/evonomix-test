@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Email for ') }} <strong>{{ $user->name }} <small>({{ $user->email }})</small></strong></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.user.email.send', $user->id) }}">
                            @csrf

                            <div class="form-group row">
                                <label for="subject" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Subject') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="subject" type="text"
                                           class="form-control @error('subject') is-invalid @enderror"
                                           name="subject" value="{{ old('subject', 'Predefined Subject') }}"
                                           required autocomplete="subject" autofocus>

                                    @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="message" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Message') }}
                                </label>

                                <div class="col-md-6">
                                    <textarea id="message"
                                              class="form-control @error('message') is-invalid @enderror"
                                              name="message" required>{{
                                                    old('message', 'Predefined Message')
                                              }}</textarea>

                                    @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send') }}
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
