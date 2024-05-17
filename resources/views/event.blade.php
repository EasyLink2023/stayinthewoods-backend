@extends('layouts.app')

@section('content')
    <div class="container-jumbotron px-5">
        <div class="row">
            <div class="col-3">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        Event Form
                    </div>
                    <div class="card-body">
                        <form action="{{ route('event.create') }}" method="POST" enctype="multipart/form-data"
                            class="py-3 event_form" novalidate>
                            @csrf
                            <label for="Event Name">Event Name</label>
                            <input type="text" class="form-control mb-2" id="event_name" name="event_name" required>
                            <label for="Event address">Event Address</label>
                            <input type="text" class="form-control mt-2 mb-2" id="event_address" name="event_address"
                                required>
                            <label for="Event Image">Event Image</label>
                            <input type="file" class="form-control mt-2 mb-2" id="event_image" name="event_image"
                                required>
                            <label for="Date">Event Date</label>
                            <input type="date" class="form-control mt-2 mb-2" id="date" name="date" required>
                            <label for="Date">Event Time</label>
                            <input type="time" class="form-control mt-2 mb-2" id="time" name="time" required>
                            <label for="Note">Note</label>
                            <textarea id="summernote" class="form-control mt-2 mb-2" name="note"></textarea>
                            <input type="submit" value="Submit" class="form-control btn btn-success mt-3">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-9">
                @if (session()->has('success-delete'))
                    <div class="alert alert-success">
                        {{ session()->get('success-delete') }}
                    </div>
                @endif
                @if (session()->has('error-delete'))
                    <div class="alert alert-danger">
                        {{ session()->get('error-delete') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        All Events
                    </div>
                    <div class="card-body mx-auto">
                        <table class="table table-responsive table-bordered">
                            <thead>
                                <th>ID #</th>
                                <th>Event Name</th>
                                <th>Event Address</th>
                                <th>Event Image</th>
                                <th>Event Date</th>
                                <th>Event Time</th>
                                <th>Event Note</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @if (isset($events) && count($events) > 0)
                                    @foreach ($events as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->event_name }}</td>
                                            <td>{{ $value->event_address }}</td>
                                            <td>
                                                <image src="{{ asset('uploads/event-images') }}/{{ $value->cover_image }}"
                                                    style="width: 100px" />
                                            </td>
                                            <td>
                                                @php
                                                    $carbonDate = Carbon\Carbon::createFromFormat(
                                                        'Y-m-d',
                                                        $value->date,
                                                    );
                                                    $convertedDate = $carbonDate->format('l, M j');
                                                @endphp
                                                {{ $convertedDate ?? $value->date }}</td>
                                            <td>{{ $value->time }}</td>
                                            <td style="word-wrap: break-word;max-width: 150px;overflow: hidden;">
                                                {!! $value->note !!}</td>
                                            <td>
                                                <a href="{{ route('event.delete', $value->id) }}"
                                                    class="btn btn-danger">Delete</a>
                                                @if ($value->status == '0')
                                                    <a href="{{ route('event.update-status', $value->id) }}"
                                                        class="btn btn-success">Activate</a>
                                                @else
                                                    <a href="{{ route('event.update-status', $value->id) }}"
                                                        class="btn btn-danger">Deactivate</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center">No events found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        @if ($events->hasPages())
                            <div class="pagination-wrapper d-flex justify-content-center">
                                {{ $events->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scipts')
        <script src="{{ asset('jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('summernote/summernote-lite.min.js') }}"></script>

        <script>
            (function() {
                'use strict'
                var forms = document.querySelectorAll('.event_form')
                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    })
            })()
        </script>
        <script>
            $(document).ready(function() {
                $('#summernote').summernote();
            });
        </script>
    @endpush
@endsection
