@extends('layouts.app', ['title' => __('Quiz Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Quiz')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Quiz Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('quizzes.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include("includes.errors")
                        <form method="post" action="{{ route('quizzes.update',$quiz) }}" autocomplete="off"> 
                            @csrf
                            @method("PUT")
                            <h6 class="heading-small text-muted mb-4">{{ __('Quiz information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" value="{{$quiz->name}}" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('course') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-course">{{ __('course') }}</label>
                                    <div class="controls">
                                        <select name="course_id" class="form-control" required>
                                            <option selected>Open this select menu</option>
                                            @foreach ($courses as $course)
                                            @isset($course)
                                            <option <?php if($quiz->course->id==$course->id) echo "selected"?> value="{{$course->id}}">{{$course->title}}</option>
                                            @endisset
                                            @endforeach
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
