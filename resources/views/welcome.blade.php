@extends('layout.app')

@section('content')
  <section class="container">
    <h1 class="text-center mb-3">Home</h1>
    <div class="d-flex justify-content-center">
        <iframe src="http://localhost:8090/widget" height="820px" width="500px" frameborder="0"></iframe>
    </div>
  </section>
@endsection
