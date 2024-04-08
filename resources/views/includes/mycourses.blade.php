

<!--Carousel Wrapper-->
<div id="carousel-with-lb" class="carousel slide carousel-multi-item" data-interval="false" data-ride="carousel">

    <!--Controls-->
    <a class="btn-floating btn-primary left-arrow" href="#carousel-with-lb" data-slide="prev"><i
            class="fas fa-chevron-left"></i></a>
    <a class="btn-floating btn-primary right-arrow" href="#carousel-with-lb" data-slide="next"><i
            class="fas fa-chevron-right"></i></a>
    <!--/.Controls-->

    <!--Slides and lightbox-->

    <div class="carousel-inner mdb-lightbox" role="listbox">
        <div id="mdb-lightbox-ui"></div>
        <!--First slide-->

        <div id="courses-header">
            <h4>Resume Learning</h4>
            <a href="{{ route('my-courses') }}">My courses</a>
            <div class="clearfix"></div>
        </div>
        @if (count($user_courses) > 0)
            @foreach ($user_courses as $course)
                <div class="course carousel-item <?php if ($loop->first) {
                    echo 'active';
                } ?>">
                    <div class="row">
                        <div class="col-sm-4 offset-sm-2">
                            <figure class="col-md-4 d-md-inline-block">
                                <a href="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(2).jpg"
                                    data-size="1600x1067">
                                    @if ($course->photo)
                                        <a href="{{ route('show-course', $course->slug) }}"><img
                                                src="{{ asset('images/' . $course->photo->filename) }}"></a>
                                    @else
                                        <a href="{{ route('show-course', $course->slug) }}"><img src="/images/1.jpg"></a>
                                    @endif
                                </a>
                            </figure>
                        </div>
                        <div class="col-sm-4">
                            <h3><a
                                    href="{{ route('show-course', $course->slug) }}">{{ \Str::limit($course->title, 30) }}</a>
                            </h3>
                            @if ($course->track)
                                <h4>Track: <a href="">{{ $course->track->name }}</a></h4><br>
                            @else
                                <h4>There is no track for this course</h4><br>
                            @endif
                            <h6>{{ count($course->users) }} students are learning this course.</h6>
                            <h6>there are {{ count($course->videos) }} videos in this course.</h6>

                        </div>
                    </div>
                </div>
                <!--/.First slide-->
            @endforeach
        @else
            <div class="alert alert-info" role="alert" style="width: 600px; margin:90px auto; padding-left:150px;">
                <i class="fas fa-exclamation"></i> You have not enrolled in any course yet
            </div>
        @endif
    </div>
</div>

</div>
<style>
    a:hover {
        opacity: .8;
    }
</style>
<!--/.Carousel Wrapper-->
