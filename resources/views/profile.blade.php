@include('layouts.user_layout')
<div class="container">
    <div class="row mt-5 mb-5">
        @if (\Session::has('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert"
                style="width: 90%; margin-left: auto; margin-right: auto;">
                {!! \Session::get('msg') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="col-4">
            <div class="cart">
                <div class="img">
                    @if ($user->photo)
                        <img src="{{ asset('images/' . $user->photo->filename) }}" alt=""
                            style="width: 140px; height: 140px; border-radius: 50%; border: 1px #ddd solid;">
                    @else
                        <img src="{{ asset('images/Unknown_person.jpg') }}" alt=""
                            style="width: 140px; height: 140px; border-radius: 50%; border: 1px #ddd solid;">
                    @endif
                    <form action="{{ route('upload_image', $user) }}" method="post" enctype="multipart/form-data"
                        style="margin-top: 10px;">
                        @csrf
                        <input type="file" name="image">
                        <button type="submit" name="image" class="btn btn-primary" style="margin:6px 34px;"><i
                                class="fas fa-upload"> Upload</i></button>
                    </form>
                </div>
                <p class="mt-3">
                    <span>{{ $user->name }}</span><br>
                    <span>you have enrolled in {{ count($user->courses) }} courses</span>
                </p>
            </div>
        </div>
        <div class="col-6">
            @include('includes.errors')
            <form method="post" action="{{ route('update-user-profile', $user) }}" autocomplete="off">
                @csrf
                @method('put')
                <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                <div class="pl-lg-4">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <input type="text" name="name" id="input-name"
                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Name') }}" value="{{ old('name', $user->name) }}" required
                            autofocus>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <input type="email" name="email" id="input-email"
                            class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Email') }}" value="{{ old('email', $user->email) }}" required>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <input type="password" name="password" id="input-password"
                            class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Password') }}" value="">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label"
                            for="input-password-confirmation">{{ __('Confirm Password') }}</label>
                        <input type="password" name="password_confirmation" id="input-password-confirmation"
                            class="form-control form-control-alternative" placeholder="{{ __('Confirm Password') }}"
                            value="">
                    </div>
                    <div class="text-center">
                        <button type="submit" id="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- <div class="cont-footer" style="position: fixed; bottom: 0; width:100%;"> --}}
    @include('includes.footer')
{{-- </div> --}}



