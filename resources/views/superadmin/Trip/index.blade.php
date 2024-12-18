@extends('layouts.superadmin')
@section('title')
    <title>Participant List | NRB World</title>
@endsection

@section('main')

    <div class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">All Participant List</h4>
                    </div>


                    <!-- Data Table -->
                    <div class="table-wrapper">
                        <div class="card-body">
                            <div class="add-button text-right">
                                <a href="{{ route('trip.create') }}" class="btn btn-primary text-capitalize"><span>Add Participant</span></a>
                            </div>


                            <form action="{{ route('trip.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="file">Upload Excel File:</label>
                                    <input type="file" name="file" id="file" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Import</button>
                            </form>

                            <div class="table-responsive">
                                @if(session('successMsg') || session('dangerMsg'))
                                    <div class="alert @if(session('successMsg')) alert-success @else alert-danger @endif alert-dismissible fade show" role="alert">
                                        {{ session('successMsg') ?? session('dangerMsg') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <table id="warehouseTable" class="table table-hover" cellspacing="0" width="100%">
                                    <thead class="text-primary">
                                    <tr>
                                        <th>Sl.</th>
                                        <th>Participant Name</th>
                                        <th>Phone</th>
                                        <th>Country</th>
                                        <th>Organization</th>
                                        <th>Designation</th>
                                        <th>Category</th>
                                        <th>QR Code</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($driver as $key => $list)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $list->name }}</td>
                                            <td>{{ $list->phone }}</td>
                                            <td>{{ $list->driver }}</td>
                                            <td>{{ $list->description }}</td>
                                            <td>{{ $list->fare }}</td>
                                            <td>{{ $list->route }}</td>

                                            {{-- Display QR Code --}}
                                            <td>
                                                <img src="{{ asset('qrcode') }}/{{ $list->qrcode }}" alt="QR Code" width="100" height="100">
                                            </td>

                                            {{-- Action Buttons --}}
                                            <td class="td-actions text-right">
                                                {{-- QR Code Download Button --}}
                                                <a href="{{ asset('qrcode') }}/{{ $list->qrcode }}" download="{{ $list->name }}_qrcode.png" rel="tooltip"
                                                   class="btn btn-primary btn-link btn-sm" title="Download QR Code">
                                                    <i class="material-icons">qr_code</i>
                                                </a>

                                                {{-- Delete Button --}}
                                                <form id="delete-form-{{ $list->id }}" action="{{ route('trip.destroy', $list->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                                <button type="button" rel="tooltip" class="btn btn-danger btn-link btn-sm" title="Remove"
                                                        onclick="if(confirm('Are you sure you want to delete this item?')) {
                                                                event.preventDefault();
                                                                document.getElementById('delete-form-{{ $list->id }}').submit();
                                                                }">
                                                    <i class="material-icons">close</i>
                                                </button>

                                                {{-- Edit Button --}}
                                                <button type="button" onclick="window.location='{{ route('trip.edit', $list->id) }}'" rel="tooltip"
                                                        class="btn btn-primary btn-link btn-sm" title="Edit list">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>


                            </div>
                            <script>
                                $(document).ready(function () {
                                    $('#warehouseTable').DataTable({
                                        order: [[0, 'desc']], // Set the default order to the first column (Sl.) in descending order
                                        pageLength: 10,      // Optional: Number of rows per page
                                        responsive: true,    // Makes the table responsive
                                        columnDefs: [
                                            { orderable: false, targets: -1 }, // Disable ordering for the Action column
                                        ]
                                    });
                                });
                            </script>



                        </div>
                    </div>

                    <!-- DataTable Initialization Script -->


                </div>
            </div>
        </div>
    </div>
@endsection
