@extends('layout.admin')

@section('content')
  <section class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div class="d-flex gap-3 mt-1">
        <div>Recent requests for</div>
        <div><span class="fw-semibold">Day: </span><span id="statistic-day"></span></div>
        <div><span class="fw-semibold">Week: </span><span id="statistic-week"></span></div>
        <div><span class="fw-semibold">Month: </span><span id="statistic-month"></span></div>
      </div>
      <div class="fw-semibold fs-3">
        {{auth()->user()->name}}
      </div>
    </div>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col" class="p-0 text-center align-middle">
            <a href="{{ route('tickets', ['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}"
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
            <a href="{{ route('tickets', ['sort' => 'email', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}"
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
            <a href="{{ route('tickets', ['sort' => 'number', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}"
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
          {{-- <th class="w-25 text-center fw-semibold" scope="col">Description</th> --}}
          <th scope="col" class="p-0 text-center align-middle">
            <a href="{{ route('tickets', ['sort' => 'status', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}"
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
            <a href="{{ route('tickets', ['sort' => 'created', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}"
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
              <td class="text-center">{{ $ticket->customer->email }}</td>
              <td class="text-center">{{ $ticket->customer->number }}</td>
              <td>{{ $ticket->theme }}</td>
              {{-- <td>{{ $ticket->description }}</td> --}}
              @php
                $statusColor = match ($ticket->status) {
                    'new' => 'text-success',
                    'in_process' => 'text-warning',
                    'closed' => 'text-primary',
                };
              @endphp
              <td class="fw-light">
                <form action="{{ route('tickets.status', $ticket->id) }}" method="POST">
                  @csrf
                  @method('PATCH')
                  <select name="status" class="form-select {{ $statusColor }}" aria-label="Default select example"
                    onchange="this.form.submit()" style="min-width: 130px">
                    <option class="" {{ $ticket->status === 'new' ? 'selected' : '' }} value="new">New</option>
                    <option {{ $ticket->status === 'in_process' ? 'selected' : '' }} value="in_process">In process
                    </option>
                    <option {{ $ticket->status === 'closed' ? 'selected' : '' }} value="closed">Closed</option>
                  </select>
                </form>
              </td>
              <td class="text-center">{{ $ticket->answered_at }}</td>
              <td class="text-center">{{ $ticket->created_at }}</td>
              <td class="text-center">
                <div class="d-flex gap-1">
                  <a href="{{ route('tickets.show', $ticket->id) }}"
                    class="d-inline-flex align-items-center justify-content-center btn btn-warning p-2">
                    <img src="{{ asset('image/pencil.png') }}" alt="trash-can" width="18" height="18">
                  </a>
                  @if (auth()->user()->hasRole('admin'))
                    <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                        class="d-inline-flex align-items-center justify-content-center btn btn-danger p-2">
                        <img src="{{ asset('image/trash.png') }}" alt="trash-can" width="18" height="18">
                      </button>
                    </form>
                  @else
                    <button type="button"
                      class="d-inline-flex align-items-center justify-content-center btn btn-secondary p-2" disabled>
                      <img src="{{ asset('image/trash.png') }}" alt="trash-can" width="18" height="18">
                    </button>
                  @endif
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      @else
        <div>There's no data here</div>
      @endif
    </table>
  </section>
@endsection
