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
          <th scope="col">Created_at</th>
        </tr>
      </thead>
      @if (!empty($customers))
        <tbody class="table-group-divider">
          @foreach ($customers as $customer)
            <tr>
              <th scope="row">{{ $customer->id }}</th>
              <td>{{ $customer->name }}</td>
              <td>{{ $customer->email }}</td>
              <td>{{ $customer->number }}</td>
              <td>{{ $customer->created_at }}</td>
            </tr>
          @endforeach
        </tbody>
      @else
        <div>There's no data here</div>
      @endif
    </table>
  </section>
@endsection
