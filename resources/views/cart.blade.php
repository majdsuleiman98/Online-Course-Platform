@extends('layouts.user_layout')

@section('content')
    <div class="container" style="margin: auto auto">
        <div class="row mt-5">
            <div class="col-md-1"></div>
            @if ($cart)
                <div class="col-md-7">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @foreach ($cart->items as $course)
                        <div class="card mb-2">
                            <div class="card-body " style="display: flex;justify-content:space-between">
                                <section style="display: flex; gap: 10px;">
                                    <img src="{{ asset('images/' . $course['image']) }}" class="card-img-top"
                                        alt="..."style="width:100px; height:100px; border-radius: 50%">
                                    <h5 class="card-title"
                                        style="margin-left: 6px; margin-right: 10px; margin-top: 30px; color: #666">
                                        {{ $course['title'] }} <br> <span
                                            style="font-size: 16px;">{{ $course['price'] }}&#36;</span>
                                    </h5>
                                </section>
                                <div class="card-text d-flex justify-content-end ms-3">
                                    <form action="{{ route('cart.remove', $course['id']) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-secondary btn-sm ms-1"
                                            style="height: 31px; margin-top: 29px; float: right; background-color: #34495e;"><i
                                                class="fas fa-trash"></i> Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <p><strong>Total : {{ $cart->totalprice }} &#36;</strong></p>
                </div>
                <div class="col-md-4">
                    <div class="card text-white" style="background-color: #34495e;">
                        <div class="card-body">
                            <h3 class="card-titel">
                                Your Cart
                                <hr>
                            </h3>
                            <div class="card-text">
                                <p>
                                    Total Amount is : {{ $cart->totalprice }}&#36;
                                </p>
                                <p>
                                    Total Quantities is : {{ $cart->totalQty }}
                                </p>
                                @auth
                                <a href="{{route('show-payment-page')}}" class="btn btn-info">Go to Payment Page</a>
                                @endauth
                                @guest
                                <a href="{{route('login')}}" class="btn btn-info">login</a>
                                @endguest

                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="cont_img" style="width:400px; height: 400px; margin: 10px 350px;">
                    <img src="{{ asset('images/empty.jpg') }}" alt=""
                        style="width:360px; height: 360px; border-radius: 20%;">
                </div>
            @endif
        </div>
    </div>

    @if ($cart)
        <div style="height: 150px;"></div>
    @endif
    @include('includes.footer')


    <style>
        body {
            background-color: #ecf0f1;
        }
        i:hover {
            color: #0dcaf0;
        }
    </style>

@endsection
