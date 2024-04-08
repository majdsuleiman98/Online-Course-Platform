@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4">
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Last added courses</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('courses.index') }}" class="btn btn-sm btn-primary">See All</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Track</th>
                                    <th scope="col">No of Users</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <th scope="row">
                                            {{ $course->title }}
                                        </th>
                                        <td>
                                            {{ $course->track->name }}
                                        </td>
                                        <td>
                                            {{ count($course->users) }}
                                        </td>
                                        @if ($course->price == 0)
                                            <td class="text-success">Free</td>
                                        @else
                                            <td class="text-danger">{{$course->price}}&#36;</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Last added tracks</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{route('tracks.index')}}" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">No of Courses</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tracks as $track)
                                    <tr>
                                        <td>{{$track->name}}</td>
                                        <td>{{count($track->courses)}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
