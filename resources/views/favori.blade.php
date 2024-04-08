<?php
if (Auth::check()) {
    $enrolled_courses = Auth::user()
        ->courses()
        ->pluck('id');
    $fav_courses_ids = Auth::user()
        ->favoris()
        ->pluck('id');
}
$ids_in_cart = [];
if (session()->has('cart')) {
    $cart = new App\Models\Cart(session()->get('cart'));
    foreach ($cart->items as $coursee) {
        array_push($ids_in_cart, $coursee['id']);
    }
}
?>
@extends('layouts.user_layout')

@section('content')
    <div class="container mt-5">
            <div class="col-md-1"></div>
            @if (count($fav_courses) > 0)
                <div class="row">
                    @foreach ($fav_courses as $course)
                        <div class="col-4">
                            <div class="card" style="width: 23rem; height: 26rem; margin-bottom: 8px;">
                                @if ($course->photo)
                                    <a href="{{ route('course-info', $course->slug) }}">
                                        <img src="{{ asset('images/' . $course->photo->filename) }}" class="card-img-top"
                                            alt="...">
                                    </a>
                                @else
                                    <a href="{{ route('course-info', $course->slug) }}">
                                        <img src="{{ asset('images/1.jpg') }}" class="card-img-top" alt="...">
                                    </a>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ Str::limit($course->title, 30) }}</h5>
                                    <p class="card-text" style="overflow: hidden;text-overflow: ellipsis;">
                                        {{ Str::limit($course->description, 80) }}
                                    </p>
                                    <div style="display: flex; justify-content: space-between; align-items: center">
                                        <span style=" font-weight: 500; margin-top: 5px;"
                                            class="{{ $course->price == 0 ? 'text-success' : 'text-danger' }}">{{ $course->price == 0 ? 'FREE' : $course->price }}&#36;
                                        </span>
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
                                            <a href="{{ route('favorilerim.store') }}"><i
                                                    class="fas fa-heart fa-2x fav"></i></a>
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
                    @endforeach
                </div>
            @else
                <div class="cont_img" style="width:400px; height: 400px; margin: 10px 350px;">
                    <img src="{{ asset('images/empty.jpg') }}" alt=""
                    style="width:360px; height: 360px; border-radius: 20%;">
                </div>
            @endif
    </div>

    <div style="height: 150px;"></div>
    <style>
        body {
            background-color: #ecf0f1;
        }

        /* i:hover {
                    color: #1c5996;
                } */
        .btn-fav {
            color: rgb(244, 52, 52);
            background-color: white;
            border: none;
        }

        .btn-fav:hover {
            color: #1c5996;
            scale: 1.1;
        }
    </style>
    @include('includes.footer')




@endsection
