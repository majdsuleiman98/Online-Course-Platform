@extends('layouts.app', ['title' => __('Question Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Question')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Question Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('quizzes.show',$question->quiz) }}" class="btn btn-sm btn-primary">{{ __('Back to Quiz') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include("includes.errors")
                        <form method="post" action="{{ route('questions.update',$question) }}" autocomplete="off"> 
                            @csrf
                            @method("put")
                            <h6 class="heading-small text-muted mb-4">{{ __('Question information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('title') }}</label>
                                    <input type="text" value="{{$question->title}}" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('title') }}" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('answers') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-answers">{{ __('answers') }}</label>
                                    <input type="text" value="{{$question->answers}}" name="answers" id="input-answers" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('answers') }}" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('answers'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('answers') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('right_answer') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-right_answer">{{ __('right_answer') }}</label>
                                    <input type="text" value="{{$question->right_answer}}" name="right_answer" id="input-right_answer" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('right answer') }}" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('right_answer'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('right_answer') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('score') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-score">{{ __('score') }}</label>
                                    <div class="controls">
                                        <select name="score" class="form-control" required>
                                            @for($i=5; $i<=25;$i+=5)
                                            <option <?php if($question->score==$i) echo "selected"?> value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    @if ($errors->has('score'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('score') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('quiz') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-quiz">{{ __('quiz') }}</label>
                                    <div class="controls">
                                        <select name="quiz_id" class="form-control" required>
                                            <option value="{{$question->quiz->id}}">{{$question->quiz->name}}</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('quiz_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('quiz_id') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
