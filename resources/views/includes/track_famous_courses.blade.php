<?php
$enrolled_courses = Auth::user()
    ->courses()
    ->pluck('id');
$fav_courses_ids = Auth::user()
    ->favoris()
    ->pluck('id');

$ids_in_cart = [];
if (session()->has('cart')) {
    $cart = new App\Models\Cart(session()->get('cart'));
    foreach ($cart->items as $course) {
        array_push($ids_in_cart, $course['id']);
    }
}
?>

<div class="container">
    <div class="famous-courses">
        <h4>New Tracks</h4>
        <?php $i = 0; ?>
        @foreach ($tracks_courses as $track)
            @if (count($track->courses) > 0)
                <h5>Last {{ $track->name }} courses</h5>
                <div class="row" style="margin-bottom: 40px;">
                    @foreach ($track->courses()->limit(4)->get() as $course)
                        <div class="col-4">
                            <div class="card" style="width: 23rem; height: 26rem; margin-bottom: 12px;">
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
                                        {{ Str::limit($course->description, 70) }}</p>
                                    <div style="display: flex; justify-content: space-between">
                                        <span style=" font-weight: 500; margin-top: 5px;"
                                            class="{{ $course->price == 0 ? 'text-success' : 'text-danger' }}">{{ $course->price == 0 ? 'FREE' : $course->price }}&#36;
                                        </span>
                                        @auth
                                            @if ($fav_courses_ids->contains($course->id))
                                                <form action="{{ route('favorilerim.destroy', $course->id) }}"
                                                    method="post">
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


                @if ($i == 1)
                    @if (count($recommended_courses) > 0)
                        <div class="recommended-courses mb-5">
                            <h4>Recommended courses for you: </h4>
                            <div class="courses">
                                @foreach ($recommended_courses as $course)
                                    <div class="course">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="course-image">
                                                    @if ($course->photo)
                                                        <a href="{{ route('course-info', $course->slug) }}"><img
                                                                src="{{ asset('images/' . $course->photo->filename) }}"></a>
                                                    @else
                                                        <a href="{{ route('course-info', $course->slug) }}"><img
                                                                src="{{ asset('images/1.jpg') }}"></a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="course-details">
                                                    <p class="course-title" style="margin-bottom: 0px;">{{ \Str::limit($course->title, 60) }}</p>
                                                    <div class="cont" style="display: flex; justify-content: space-around; align-items: center;">
                                                        <span style="margin-left: 10px; font-weight: 500;"
                                                        class="{{ $course->price == 0 ? 'text-success' : 'text-danger' }}">{{ $course->price == 0 ? 'FREE' : $course->price }}&#36;
                                                    </span>
                                                    <span style="margin-left: 15px">{{ count($course->users) }}
                                                        students</span>
                                                    <span style="margin-left: 15px">{{ count($course->videos) }}
                                                        videos</span>
                                                    @auth
                                                        @if ($fav_courses_ids->contains($course->id))
                                                            <form action="{{ route('favorilerim.destroy', $course->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <input type="hidden" name="user_id"
                                                                    value="{{ auth()->user()->id }}">
                                                                <input type="hidden" name="course_id"
                                                                    value="{{ $course->id }}">
                                                                <button type="submit" class="btn-fav"><i
                                                                        class="fas fa-heart fa-2x fav"
                                                                        style="color: red;"></i></button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('favorilerim.store') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="user_id"
                                                                    value="{{ auth()->user()->id }}">
                                                                <input type="hidden" name="course_id"
                                                                    value="{{ $course->id }}">
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
                                                            <a href="{{ route('show-course', $course->slug) }}"
                                                                id="addtocart" style="text-decoration:underline;" class="text-info">Go To Course</a>
                                                        @elseif (session()->has('cart') && in_array($course->id, $ids_in_cart))
                                                            <a href="{{ route('cart.show', $course->id) }}"
                                                                id="addtocart" style="text-decoration:underline;" class="text-info">Go To Cart</a>
                                                        @else
                                                            <a href="{{ route('cart.add', $course->id) }}" id="addtocart"
                                                                >Add To Cart</a>
                                                        @endif
                                                    @endauth
                                                    @guest
                                                        @if (session()->has('cart') && in_array($course->id, $ids_in_cart))
                                                            <a href="{{ route('cart.show', $course->id) }}"
                                                                id="addtocart" style="text-decoration:underline;" class="text-info">Go To Cart</a>
                                                        @else
                                                            <a href="{{ route('cart.add', $course->id) }}" id="addtocart"
                                                                style="text-decoration:underline;" class="text-info">Add To Cart</a>
                                                        @endif
                                                    @endguest
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif
                <?php $i++; ?>
            @endif
        @endforeach
    </div>

</div>
<style>
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
