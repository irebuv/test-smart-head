@extends('layout.admin')

@section('content')
  <section class="container">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Customer</th>
          <th scope="col">Number</th>
          <th scope="col">Email</th>
          <th scope="col">Theme</th>
          <th class="w-25" scope="col">Description</th>
          <th scope="col">Status</th>
          <th scope="col">Answered_at</th>
          <th scope="col">Created_at</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      @if (!empty($tickets))
        <tbody class="table-group-divider">
          @foreach ($tickets as $ticket)
            <tr>
              <th scope="row">{{ $ticket->id }}</th>
              <td>{{ $ticket->customer->name }}</td>
              <td>{{ $ticket->customer->email }}</td>
              <td>{{ $ticket->customer->number }}</td>
              <td>{{ $ticket->theme }}</td>
              <td>{{ $ticket->description }}</td>
              <td>{{ $ticket->status }}</td>
              <td>{{ $ticket->answered_at }}</td>
              <td>{{ $ticket->created_at }}</td>
              <td>Actions</td>
            </tr>
          @endforeach
        </tbody>
      @else
        <div>There's no data here</div>
      @endif
    </table>
    @dump($ticket)
  </section>
@endsection
