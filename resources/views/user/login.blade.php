@extends('layout.app')

@section('content')
<section class="container p-4 d-flex justify-content-center flex-column align-items-center">
    <h1 class="text-center">Login page</h1>
    <form action="{{route('login.store')}}" method="post">
        @csrf
        <div class="mt-4">
            <label class="form-label" for="email">Your email</label><br>
            <input class="form-control" type="@error('email') error-input @enderror" type="email" value="{{old('email')}}" name="email" placeholder="Write your email">
            @if ($errors->has('email'))
                <p class="text-danger"">{{ $errors->first('email') }}</p>
            @endif
        </div>
        <div class="mt-4">
            <label class="form-label" for="password">Your password</label><br>
            <input class="form-control" type="@error('password') error-input @enderror" type="password" value="{{old('password')}}" name="password" placeholder="Write your password">
            @if ($errors->has('password'))
                <p class="text-danger">{{ $errors->first('password') }}</p>
            @endif
        </div>
        <button type="submit" class="btn btn-primary mt-3">Login</button>
    </form>
</section>
@endsection
