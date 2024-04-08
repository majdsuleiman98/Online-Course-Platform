@extends('layouts.app', ['title' => __('Course Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Preview Course')])

    <div class="container-fluid mt--7">

        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Course Management') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('courses.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row the_course mb-5">
                        <div class="row">
                            @if (\Session::has('msg'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert"
                                    style="width: 90%; margin-left: auto; margin-right: auto;">
                                    {!! \Session::get('msg') !!}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="col-sm-4">
                                <div class="course-image">
                                    @if ($course->photo)
                                        <img src="{{asset('images/'. $course->photo->filename)}}" class="img-fluid">
                                    @else
                                        <img src="{{asset('images/1.jpg')}}" class="img-fluid">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="course-info">
                                    <h1>{{ \Str::limit($course->title, 50) }}</h1>
                                    <h3>Description</h3>
                                    <h4>{{ \Str::limit($course->description, 200) }}</h4>
                                    <strong>Track : {{ $course->track->name }}</strong><br>
                                    <span class="{{ $course->price == 0 ? 'text-success' : 'text-danger' }}">Price :
                                        {{ $course->price == 0 ? 'FREE' : $course->price }}&#36;</span>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col-10">
                                        <h2 class="mb-0">{{ __('Course Videos') }}</h2>
                                    </div>
                                    <div class="col-1 text-right">
                                        <a href="{{ $course->id }}/video/create"
                                            class="btn btn-sm btn-primary">{{ __('New Video') }}</a>
                                    </div>
                                    <div class="col-1 text-right">
                                        <a href="{{ $course->id }}/quiz/create"
                                            class="btn btn-sm btn-primary">{{ __('New Quiz') }}</a>
                                    </div>
                                </div>
                            </div>
                            @if (count($course->videos) > 0)
                                <div class="row mt-5">
                                    @foreach ($course->videos as $video)
                                        <div class="col-4">
                                            <div class="card" style="width: 18rem;">
                                                <iframe class="img-fluid rounded-start" class="card-img-top"
                                                    src="http://www.youtube.com/embed/{{ $video->link }}" frameborder="0"
                                                    allowfullscreen></iframe>
                                                <div class="card-body">
                                                    <h5 class="card-title">Title : {{ $video->title }}</h5>
                                                    <p class="card-text">Created At : {{ $video->created_at }}</p>
                                                    <form action="{{ route('videos.destroy', $video) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="{{ route('videos.edit', $video) }}"
                                                            class="btn btn-primary">Edit</a>
                                                        <input type="submit" class="btn btn-danger" value="Delete">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-danger" role="alert">
                                    No Video in this course
                                </div>
                            @endif

                            @if (count($course->quizzes) > 0)
                                <div class="row mt-5">
                                    @foreach ($course->quizzes as $quiz)
                                        <div class="col-4">
                                            <div class="card text-center">
                                                <div class="card-header">
                                                    Quiz
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $quiz->name }}</h5>
                                                    <p class="card-text">{{ count($quiz->questions) }} Questions</p>
                                                    <form action="{{ route('quizzes.destroy', $quiz) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="{{ route('quizzes.edit', $quiz) }}"
                                                            class="btn btn-primary">Edit</a>
                                                        <input type="submit" class="btn btn-danger" value="Delete">
                                                        <a href="{{ route('quizzes.show', $quiz) }}"
                                                            class="btn  btn-info">Show</a>
                                                    </form>
                                                </div>
                                                <div class="card-footer text-body-secondary">
                                                    Created At : {{ $quiz->created_at }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-danger" role="alert">
                                    No Quiz in this course
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
