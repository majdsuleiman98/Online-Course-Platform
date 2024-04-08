<?php
if (Auth::check()) {
    $enrolled_courses = Auth::user()->courses()->pluck('id');
    $fav_courses = Auth::user()->favoris()->pluck('id');
}
$ids_in_cart = [];
if (session()->has('cart')) {
    $cart = new App\Models\Cart(session()->get('cart'));
    foreach ($cart->items as $course) {
        array_push($ids_in_cart, $course['id']);
    }
}
?>
@extends('layouts.user_layout')
@section('content')
    <div class="container">
        <div class="row mb-5 mt-5">
            <div class="col-3">
                @foreach ($tracks as $track)
                    <form action="{{ route('search') }}" method="get">
                        @csrf
                        <ol class="list-group list-group-numbered">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold"><input type="submit" name="track" value="{{ $track->name }}">
                                    </div>
                                </div>
                            </li>
                        </ol>
                    </form>
                @endforeach
            </div>
            <div class="col-9">
                @if (count($courses) > 0)
                    @foreach ($courses as $course)
                        <div class="card mb-3" style="max-width: 940px;">
                            <div class="row g-0">
                                <div class="col-md-4" style="margin: auto auto">
                                    @if ($course->photo)
                                        <a href="{{ route('course-info', $course->slug) }}"><img
                                                src="{{ asset('images/' . $course->photo->filename) }}"
                                                class="img-fluid rounded-start" alt="..."></a>
                                    @else
                                        <a href="{{ route('course-info', $course->slug) }}"><img
                                                src="{{ asset('images/1.jpg') }}" class="img-fluid rounded-start"
                                                alt="..."></a>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ Str::limit($course->title, 40) }}</h5>
                                        <p class="card-text">{{ Str::limit($course->description, 60) }}</p>
                                        <div style="display: flex; justify-content: space-around">
                                            <span style="margin-left: 10px; font-weight: 500;"
                                                class="{{ $course->price == 0 ? 'text-success' : 'text-danger' }}">{{ $course->price == 0 ? 'FREE' : $course->price }}&#36;
                                            </span>
                                            <p class="card-text"><small
                                                    class="text-body-secondary"><b>{{ count($course->videos) }}</b>
                                                    videos</small></p>
                                            <p class="card-text"><small
                                                    class="text-body-secondary"><b>{{ count($course->users) }}</b>
                                                    Students</small></p>
                                                    @auth
                                                    @if ($fav_courses->contains($course->id))
                                                    <form action="{{route('favorilerim.destroy',$course->id)}}" method="post">
                                                        @csrf
                                                        @method("delete")
                                                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                                        <input type="hidden" name="course_id" value="{{$course->id}}">
                                                        <button type="submit" class="btn-fav"><i class="fas fa-heart fa-2x fav" style="color: red;"></i></button>
                                                    </form>
                                                    @else
                                                    <form action="{{route('favorilerim.store')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                                        <input type="hidden" name="course_id" value="{{$course->id}}">
                                                        <button type="submit" class="btn-fav"><i class="fas fa-heart fa-2x fav"></i></button>
                                                    </form>
                                                    @endif
                                                @endauth
                                                @guest
                                                    <a href="{{route('favorilerim.store')}}"><i class="fas fa-heart fa-2x fav"></i></a>
                                                @endguest
                                                @auth
                                                    @if ($enrolled_courses->contains($course->id))
                                                        <a href="{{ route('show-course', $course->slug) }}" id="addtocart"
                                                            class="btn btn-primary">Go To Course</a>
                                                    @elseif (session()->has('cart') && in_array($course->id, $ids_in_cart))
                                                        <a href="{{ route('cart.show', $course->id) }}" id="addtocart"
                                                            class="btn btn-primary">Go To Cart</a>
                                                    @else
                                                        <a href="{{ route('cart.add', $course->id) }}" id="addtocart"
                                                            class="btn btn-primary">Add To Cart</a>
                                                    @endif
                                                @endauth
                                                @guest
                                                    @if (session()->has('cart') && in_array($course->id, $ids_in_cart))
                                                        <a href="{{ route('cart.show', $course->id) }}" id="addtocart"
                                                            class="btn btn-primary">Go To Cart</a>
                                                    @else
                                                        <a href="{{ route('cart.add', $course->id) }}" id="addtocart"
                                                            class="btn btn-primary">Add To Cart</a>
                                                    @endif
                                                @endguest
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            There are no course in this Track!!!
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>



    @include('includes.footer')

    <style>
        a:hover {
            opacity: .8;
        }

        input[type=submit] {
            background-color: #fff;
            border: none;
            color: black;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        .fav {
            duration: 0.3ms;
        }

        .fav:hover {
            color: rgb(244, 52, 52);
            scale: 1.1;

        }
        .btn-fav{
            color: #1c5996;
            background-color: white;
            border: 1px transparent solid;
        }
    </style>

@endsection
