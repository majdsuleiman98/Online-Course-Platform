<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- toastr --}}
    <link rel="stylesheet" href="//cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <title>{{ config('app.name', 'Argon Dashboard') }}</title>
    <!-- Favicon -->
    <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link
        href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    <!-- Extra details for Live View on GitHub Pages -->
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://www.creative-tim.com/product/argon-dashboard-laravel" />
    <!--  Social tags      -->
    <meta name="keywords"
        content="dashboard, bootstrap 4 dashboard, bootstrap 4 design, bootstrap 4 system, bootstrap 4, bootstrap 4 uit kit, bootstrap 4 kit, argon, argon ui kit, creative tim, html kit, html css template, web template, bootstrap, bootstrap 4, css3 template, frontend, responsive bootstrap template, bootstrap ui kit, responsive ui kit, argon dashboard">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Argon - Free Dashboard for Bootstrap 4 by Creative Tim">
    <meta itemprop="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta itemprop="image"
        content="https://s3.amazonaws.com/creativetim_bucket/products/638/original/opt_ad_laravel_thumbnail.jpg?1651243728">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@creativetim">
    <meta name="twitter:title" content="Argon - Free Dashboard for Bootstrap 4 by Creative Tim">
    <meta name="twitter:description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="twitter:creator" content="@creativetim">
    <meta name="twitter:image"
        content="https://s3.amazonaws.com/creativetim_bucket/products/638/original/opt_ad_laravel_thumbnail.jpg?1651243728">
    <!-- Open Graph data -->
    <meta property="fb:app_id" content="655968634437471">
    <meta property="og:title" content="Argon - Free Dashboard for Bootstrap 4 by Creative Tim" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://demos.creative-tim.com/argon-dashboard/index.html" />
    <meta property="og:image"
        content="https://s3.amazonaws.com/creativetim_bucket/products/638/original/opt_ad_laravel_thumbnail.jpg?1651243728" />
    <meta property="og:description" content="Start your development with a Dashboard for Bootstrap 4." />
    <meta property="og:site_name" content="Creative Tim" />
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-NKDMSK6');
    </script>
    <!-- End Google Tag Manager -->
</head>

<body class="clickup-chrome-ext_installed">
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @include("layouts.navbars.sidebar")
    <div class="main-content">
        @include("layouts.navbars.navbar")
        @include("layouts.headers.cards")
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Quiz</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{route('quizzes.create')}}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add New Quiz</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                        </div>
                        @include("includes.errors")
                        @if (count($quizzes))
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    @if (\Session::has('msg'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 90%; margin-left: auto; margin-right: auto;">
                                            {!! \Session::get('msg') !!}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <tr>
                                        <th scope="col">Quiz</th>
                                        <th scope="col">Number of Quesion</th>
                                        <th scope="col">Course</th>
                                        <th scope="col">Creation Date</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($quizzes as $quiz)
                                    <tr>
                                        <td><a href="{{route('quizzes.show',$quiz)}}">{{ $quiz->name }}</a></td>
                                        <td>{{ count($quiz->questions) }} questions</td>
                                        <td>{{ $quiz->course->title }}</td>
                                        <td>{{ $quiz->created_at }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                                        <form action="{{ route('quizzes.destroy', $quiz) }}" method="post">
                                                            @csrf
                                                            @method('delete')

                                                            <a class="dropdown-item" href="{{ route('quizzes.edit', $quiz) }}">{{ __('Edit') }}</a>
                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __('Are you sure you want to delete this user?') }}') ? this.parentElement.submit() : ''">
                                                                {{ __('Delete') }}
                                                            </button>
                                                        </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr> @endforeach
                                </tbody>
                            </table>
                        </div>
@else
<div class="alert
        alert-danger" role="alert">
    No Track Found
    </div>
    @endif
    <div class="card-footer py-4">
        <nav class="d-flex justify-content-end" aria-label="...">

        </nav>
    </div>
    </div>
    </div>
    </div>

    </div>
    </div>


    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Argon JS -->
    <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
    @include("includes.toastr")
    </body>

</html>
