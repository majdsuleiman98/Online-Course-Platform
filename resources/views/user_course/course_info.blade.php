<?php
if (Auth::check()) {
    $enrolled_courses = Auth::user()->courses()->pluck('id');
    $fav_courses_ids = Auth::user()->favoris()->pluck('id');
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
    <div class="container">
        <div class="col-12" style="margin-top: 90px; margin-bottom: 33px;">
            <div class="card mb-3" style="max-width: 980px; height: 196px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        @if ($course->photo)
                            <img src="{{ asset('images/' . $course->photo->filename) }}" class="img-fluid rounded-start"
                                alt="...">
                        @else
                            <img src="{{ asset('images/1.jpg') }}" class="img-fluid rounded-start" alt="...">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ Str::limit($course->title, 50) }}</h5>
                            <p class="card-text">{{ $course->description }}</p>
                            <div style="display: flex; justify-content: space-around;">
                                <span style="margin-left: 10px; font-weight: 500px;"
                                    class="{{ $course->price == 0 ? 'text-success' : 'text-danger' }}">{{ $course->price == 0 ? 'FREE' : $course->price }}&#36;
                                </span>
                                <p class="card-text"><small class="text-body-secondary"><b>{{ count($course->videos) }}</b>
                                        videos</small></p>
                                <p class="card-text"><small class="text-body-secondary"><b>{{ count($course->users) }} </b>
                                        students </small></p>
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
        </div>
    </div>

    <div class="cont-footer" style="position: fixed; bottom: 0; width:100%;">
        @include('includes.footer')
    </div>
    <style>
        a:hover {
            opacity: .8;
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
