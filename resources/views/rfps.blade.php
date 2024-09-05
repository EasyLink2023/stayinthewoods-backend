@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('adminlte/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@section('content')
<div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <form method="GET" action="{{ route('rfps.index') }}">
                                    <div class="row">
                                        <div class="col-3 ms-auto">
                                            <label for="">Start Date</label>
                                            <input type="date" name="start_date" required class="form-control" value="{{ app('request')->input('start_date') }}">
                                        </div>
                                        <div class="col-3">
                                            <label for="">End Date</label>
                                            <input type="date" name="end_date"  required class="form-control" value="{{ app('request')->input('end_date') }}">
                                        </div>
                                        <div class="col-1">
                                            <input type="submit" value="Filter" class="btn btn-warning" style="margin-top: 23px;">
                                        </div>
                                        @if( app('request')->input('end_date') && app('request')->input('start_date'))
                                            <div class="col-1">
                                                <a href="{{ route('rfps.index') }}" class="btn btn-primary" style="margin-top: 23px;"> Clear </a>
                                            </div>
                                        @endif
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <table id="rfps-table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID #</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Contact Method</th>
                                    <th>Type Of Reunion</th>
                                    <th>When is the Event</th>
                                    <th>How Many Guests</th>
                                    <th>More Info</th>
                                    <th>Page Name</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($rfps) && count($rfps) > 0)
                                    @foreach ($rfps as $key => $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->first_name ?? 'N/A' }}</td>
                                            <td>{{ $value->last_name }}</td>
                                            <td><a href="mailto:{{ $value->email }}">{{ $value->email ?? 'N/A' }}</a></td>
                                            <td><a href="callto:{{ $value->phone }}">{{ $value->phone ?? 'N/A' }}</a></td>
                                            <td>{{ $value->contact_method ?? 'N/A' }}</td>
                                            <td>{{ $value->type_reunion ?? 'N/A' }}</td>
                                            <td>{{ $value->when_is_the_event ?? 'N/A' }}</td>
                                            <td>{{ $value->how_many_guests ?? 'N/A' }}</td>
                                            <td>{{ $value->more_info ?? 'N/A' }}</td>
                                            <td>{{ $value->page_name ?? 'N/A' }}</td>
                                            <td>{{ Carbon\Carbon::parse($value->created_at)->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="12" class="text-center">No RFPS found</td>
                                    </tr>
                                @endif
                            </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@push('scipts')
<script src="{{ asset('jquery-3.5.1.min.js') }}"></script>

    <script src="{{ asset('adminlte/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminlte/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('adminlte/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('adminlte/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('adminlte/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $(function() {
            $("#rfps-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "order": [[0, "desc"]],
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#rfps-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
