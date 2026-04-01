@extends('layout.admin')

@section('content')
  <section class="container">
    <div class="d-flex gap-3 mb-4">
      <div>Recent requests for</div>
      <div><span class="fw-semibold">Day: </span><span id="statistic-day"></span></div>
      <div><span class="fw-semibold">Week: </span><span id="statistic-week"></span></div>
      <div><span class="fw-semibold">Month: </span><span id="statistic-month"></span></div>
    </div>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col" class="p-0 text-center align-middle">
            <a href="{{ route('admin', ['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}"
              class="btn fw-semibold text-primary text-decoration-none justify-content-center d-flex gap-1">
              Id
              <span class="text-primary">
                @if ($sort == 'id')
                  @if ($direction == 'desc')
                    &#8593;
                  @else
                    &#8595;
                  @endif
                @endif
              </span>
            </a>
          </th>
          <th scope="col" class="text-center fw-semibold">Customer</th>
          <th scope="col" class="p-0 align-middle">
            <a href="{{ route('admin', ['sort' => 'email', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}"
              class="btn fw-semibold text-primary text-decoration-none justify-content-center d-flex gap-1">
              Email
              <span class="text-primary">
                @if ($sort == 'email')
                  @if ($direction == 'desc')
                    &#8593;
                  @else
                    &#8595;
                  @endif
                @endif
              </span>
            </a>
          </th>
          <th scope="col" class="p-0 text-center align-middle">
            <a href="{{ route('admin', ['sort' => 'number', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}"
              class="btn fw-semibold text-primary text-decoration-none justify-content-center d-flex gap-1">
              Number
              <span class="text-primary">
                @if ($sort == 'number')
                  @if ($direction == 'desc')
                    &#8593;
                  @else
                    &#8595;
                  @endif
                @endif
              </span>
            </a>
          </th>
          <th scope="col" class="text-center fw-semibold">Theme</th>
          <th class="w-25 text-center fw-semibold" scope="col">Description</th>
          <th scope="col" class="p-0 text-center align-middle">
            <a href="{{ route('admin', ['sort' => 'status', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}"
              class="btn fw-semibold text-primary text-decoration-none justify-content-center d-flex gap-1">
              Status
              <span class="text-primary">
                @if ($sort == 'status')
                  @if ($direction == 'desc')
                    &#8593;
                  @else
                    &#8595;
                  @endif
                @endif
              </span>
            </a>
          </th>
          <th scope="col" class="text-center fw-semibold">Answered_at</th>
          <th scope="col" class="p-0 text-center align-middle">
            <a href="{{ route('admin', ['sort' => 'created', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}"
              class="btn fw-semibold text-primary text-decoration-none justify-content-center d-flex gap-1">
              Created_at
              <span class="text-primary">
                @if ($sort == 'created')
                  @if ($direction == 'desc')
                    &#8593;
                  @else
                    &#8595;
                  @endif
                @endif
              </span>
            </a>
          </th>
          <th scope="col" class="text-center fw-semibold">Actions</th>
        </tr>
      </thead>
      @if (!empty($tickets))
        <tbody class="table-group-divider">
          @foreach ($tickets as $ticket)
            <tr>
              <th scope="row" class="text-center">{{ $ticket->id }}</th>
              <td>{{ $ticket->customer->name }}</td>
              <td>{{ $ticket->customer->email }}</td>
              <td>{{ $ticket->customer->number }}</td>
              <td>{{ $ticket->theme }}</td>
              <td>{{ $ticket->description }}</td>
              <td class="text-center">{{ $ticket->status }}</td>
              <td>{{ $ticket->answered_at }}</td>
              <td>{{ $ticket->created_at }}</td>
              <td class="text-center">Actions</td>
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
