<?php
if (Auth::check()) {
    $fav_courses_ids = Auth::user()
        ->favoris()
        ->pluck('id');
}
?>

@extends('layouts.user_layout')
@section('content')
    @if (count($user_courses) > 0)
        <div class="container">
            <div class="row mt-5">
                @if (\Session::has('msg'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert"
                        style="width: 90%; margin-left: auto; margin-right: auto;">
                        {!! \Session::get('msg') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @foreach ($user_courses as $course)
                    <div class="col-4">
                        <div class="card" style="width: 23rem; height: 28rem; margin-bottom: 8px;">
                            @if ($course->photo)
                                <a href="{{ route('show-course', $course->slug) }}">
                                    <img src="{{ asset('images/' . $course->photo->filename) }}" class="card-img-top"
                                        alt="...">
                                </a>
                            @else
                                <a href="{{ route('show-course', $course->slug) }}">
                                    <img src="{{ asset('images/1.jpg') }}" class="card-img-top" alt="...">
                                </a>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ Str::limit($course->title, 35) }}</h5>
                                <p class="card-text" style="overflow: hidden;text-overflow: ellipsis;">
                                    {{ Str::limit($course->description, 80) }}</p>
                                <div class="cont" style="display: flex; justify-content: space-between">
                                    <span style="margin-left: 10px; font-weight: 500;">{{ count($course->videos) }}
                                        videos</span>
                                    <span style=" font-weight: 500;">{{ count($course->users) }}
                                        students</span>
                                    @auth
                                        @if ($fav_courses_ids->contains($course->id))
                                            <form action="{{ route('favorilerim.destroy', $course->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                <button type="submit" class="btn-fav"><i class="fas fa-heart fa-2x fav"
                                                        style="color: red;"></i></button>
                                            </form>
                                        @else
                                            <form action="{{ route('favorilerim.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                <button type="submit" class="btn-fav"><i
                                                        class="fas fa-heart fa-2x fav"></i></button>
                                            </form>
                                        @endif
                                    @endauth
                                    @guest
                                        <a href="{{ route('favorilerim.store') }}"><i class="fas fa-heart fa-2x fav"></i></a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="cont_img" style="width:400px; height: 420px; margin: 10px 400px;">
            <img src="{{ asset('images/empty.jpg') }}" alt=""
                style="width:360px; height: 360px; margin-left: 80px;">
        </div>
    @endif

    @include('includes.footer')

@endsection


<style>
    a:hover {
        opacity: 0.8;
    }

    .btn-fav {

        color: #1c5996;
        background-color: white;
        border: none;
    }

    .btn-fav:hover {
        color: rgb(244, 52, 52);
        scale: 1.1;
    }
</style>
