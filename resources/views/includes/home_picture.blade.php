<?php
            $tracks_count=App\Models\Track::all()->count();
            $courses_count=App\Models\Course::all()->count();
            $users_count=App\Models\User::where("is_admin","0")->count();
?>

<div class="home_picture">


	<div class="container-fluid">

		<div class="background_text">

			<p class="text-center">Start learning over <span class="number">{{$courses_count}}</span> courses for <strong>Free</strong>.</p>
			<p class="text-center">More than <span>{{ $users_count }}</span> users have enrolled in <span>{{ $courses_count }}</span> courses in <span>{{ $tracks_count }}</span> different Tracks</p>
			<div class="actions">
				<a class="btn btn-primary" href="/register">Start Learning</a>
				<a class="btn" href="{{route('my-courses')}}">My Courses</a>
			</div>
		</div>

	</div>


</div>
