@extends('layouts.user_layout')
@section('content')

    <div class="row">
        @if (count($course->videos) <= 0)
            <div class="alert alert-danger" style="margin: 175px auto;" role="alert">
                There are No Videos in this course
            </div>
        @else
            <div id="mySidenav" class="sidenav">
                @foreach ($course->videos as $key => $video)
                    <div class="key">
                        <a class="video-link" href="{{ $video->link }}"> {{ $key + 1 }}. {{ $video->title }}</a>
                    </div>
                @endforeach
                <br>
                @foreach ($course->quizzes as $quiz)
                    <a href="{{route("show-quiz",[$course->slug,$quiz->name])}}" class="btn btn-info" style="margin-left: 16px;">{{$quiz->name}}</a>
                @endforeach
            </div>
            <div class="col-4"></div>
            <div class="col-6">
                <div style="margin: 150px auto;">
                    <iframe class="img-fluid rounded-start" id="showvideo" style="width: 800px; height: 400px;"
                        src="http://www.youtube.com/embed/{{ $video->link }}" frameborder="0" allowfullscreen>
                    </iframe>
                </div>
            </div>
        @endif
    </div>




    <script type="text/javascript">
        $(document).ready(function() {
            $(".video-link").click(function(event) {
                event.preventDefault(); // prevent default link behavior
                var newSrc = $(this).attr("href"); // get the href attribute of the clicked link
                //console.log(newSrc)
                $("#showvideo").attr("src", "http://www.youtube.com/embed/" +
                    newSrc); // set the src attribute of the image to the new source
            });
        });
    </script>



    <style>
        body {
            font-family: "Lato", sans-serif;
        }

        .sidenav {
            height: 100%;
            width: 220px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #31557a;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav .key {
            display: flex;
            flex-direction: row;
        }

        .key:hover,
        .key:hover .video-link {
            color: #fff;
        }

        .sidenav div a {
            padding: 8px 8px 8px 10px;
            text-decoration: none;
            font-size: 20px;
            color: #cfcece;
            display: block;
            transition: 0.3s;
            cursor: pointer;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        #main {
            transition: margin-left .5s;
            padding: 16px;
        }







        .sidenav div {
            display: flex;
            align-items: center justify-content: center;
            border-bottom: 1px #818181 solid;
            padding: 6px 0px;
        }

        .sidenav div i {
            margin: 16px 10px 0px 12px;
        }
    </style>


@endsection
