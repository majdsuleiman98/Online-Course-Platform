@extends('layouts.app', ['title' => __('Video Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Video')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Video Management') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include("includes.errors")
                        <form method="post" action="{{ route('videos.store') }}" enctype="multipart/form-data" autocomplete="off">  {{--{{ route('users.store') }}--}}
                            @csrf
                            <h6 class="heading-small text-muted mb-4">{{ __('video information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('link') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-link">{{ __('link') }}</label>
                                    <input type="text" name="link" id="input-link" class="form-control form-control-alternative{{ $errors->has('link') ? ' is-invalid' : '' }}" placeholder="{{ __('link') }}" value="" required>
                                    @if ($errors->has('link'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('link') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('course') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-course">{{ __('course') }}</label>
                                    <div class="controls">
                                        <select name="course_id" class="form-control" required>
                                            @isset($course)
                                            <option value="{{$course->id}}">{{$course->title}}</option>
                                            @endisset
                                        </select>
                                    </div>
                                    @if ($errors->has('course_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('course_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
