@extends('layout.admin')

@section('content')
  <section class="container">
    <h1 class="text-center">Ticket # {{ $ticket->id }}</h1>
    <div class="shadow card p-3 mt-4 w-50 mx-auto">
      <div class="w-100">
        <a href="{{ route('tickets') }}" class="btn btn-primary px-4">back to tickets</a>
      </div>
      <div class="my-3">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th class="w-25">field</th>
              <th>action | name</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>Customer:</th>
              <th class="fw-light">{{ $ticket->customer->name }}</th>
            </tr>
            <tr>
              <th>Email:</th>
              <th class="fw-light">{{ $ticket->customer->email }}</th>
            </tr>
            <tr>
              <th>Number:</th>
              <th class="fw-light">{{ $ticket->customer->number }}</th>
            </tr>
            <tr>
              <th>Theme:</th>
              <th class="fw-light">{{ $ticket->theme }}</th>
            </tr>
            <tr>
              <th>Description:</th>
              <th class="fw-light">{{ $ticket->description }}</th>
            </tr>
            <tr>
              <th>Status:</th>
              @php
                $statusColor = match($ticket->status) {
                    'new' => 'text-success',
                    'in_process' => 'text-warning',
                    'closed' => 'text-primary',
                };
              @endphp
              <th class="fw-light">
                <form action="{{route('tickets.status', $ticket->id)}}" method="POST">
                  @csrf
                  @method('PATCH')
                  <select name="status" class="form-select {{$statusColor}}" aria-label="Default select example" onchange="this.form.submit()">
                    <option class="" {{ $ticket->status === 'new' ? 'selected' : '' }} value="new">New</option>
                    <option {{ $ticket->status === 'in_process' ? 'selected' : '' }} value="in_process">In process</option>
                    <option {{ $ticket->status === 'closed' ? 'selected' : '' }} value="closed">Closed</option>
                  </select>
                </form>
              </th>
            </tr>
            <tr>
              <th>Answered_at:</th>
              <th class="fw-light">
                @if ($ticket->answered_at)
                  {{ $ticket->answered_at }}
                @else
                  <span>no one answered yet</span>
                @endif
              </th>
            </tr>
            <tr>
              <th>Created_at:</th>
              <th class="fw-light">{{ $ticket->created_at }}</th>
            </tr>
            <tr>
              <th>Updated_at:</th>
              <th class="fw-light">{{ $ticket->updated_at }}</th>
            </tr>
            <tr>
              <th>Files:</th>
              @if ($mediaItems->count() > 0)
                <th class="fw-light files-grid">
                  @foreach ($mediaItems as $media)
                    <a href="{{ $media->getUrl() }}" download
                      class="d-inline-flex shadow flex-column justify-content-center align-items-center p-2 rounded-2">
                      @if (str_starts_with($media->mime_type, 'image/'))
                        <img width="70" src="{{ $media->getUrl() }}" alt="{{ $media->file_name }}">
                      @else
                        <img width="70" src="{{ asset('image/no-image2.png') }}" alt="no-image">
                      @endif
                      <span>{{ $media->file_name }}</span>
                    </a>
                  @endforeach
                </th>
              @else
                <th class="fw-light">There's no attached files here</th>
              @endif
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
@endsection
