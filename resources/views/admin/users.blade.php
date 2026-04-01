@extends('layout.admin')

@section('content')
  <section class="container">
     <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Created_at</th>
        </tr>
      </thead>
      @if (!empty($users))
        <tbody class="table-group-divider">
          @foreach ($users as $user)
            <tr>
              <th scope="row">{{ $user->id }}</th>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->created_at }}</td>
            </tr>
          @endforeach
        </tbody>
      @else
        <div>There's no data here</div>
      @endif
    </table>
    @dump($users)
  </section>
@endsection
