@extends('layouts.superadmin')
@section('title')
<title>Trip List | Nurjahan Bazar</title>
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

                                    {{-- Generate QR Code for vCard --}}
                                    <td>
                                        @php
                                        $vCard = "BEGIN:VCARD\n";
                                        $vCard .= "VERSION:3.0\n";
                                        $vCard .= "FN:{$list->name}\n";
                                        $vCard .= "EMAIL:{$list->email}\n";
                                        $vCard .= "TEL:{$list->phone}\n";
                                        $vCard .= "ADR:{$list->driver}\n";
                                        $vCard .= "ORG:{$list->description}\n";
                                        $vCard .= "TITLE:{$list->fare}\n";
                                        $vCard .= "END:VCARD";

                                        // Generate QR code with Bacon QR Code package as SVG
                                        $svgQrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->generate($vCard);
                                        @endphp

                                        <img src="data:image/svg+xml;base64,{{ base64_encode($svgQrCode) }}" alt="QR Code" width="100" height="100">
                                    </td>

                                    {{-- Action Buttons --}}
                                    <td class="td-actions text-right">
                                        {{-- QR Code Download Button --}}
                                        <button type="button" onclick="downloadQRCode('{{ $list->id }}')" rel="tooltip"
                                                class="btn btn-primary btn-link btn-sm" title="Download QR Code">
                                            <i class="material-icons">qr_code</i>
                                        </button>

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
                            function downloadQRCode(id) {
                                const qrCode = document.querySelector(`img[src^="data:image/svg+xml;base64,"]`);
                                if (qrCode) {
                                    const link = document.createElement('a');
                                    link.href = qrCode.src;
                                    link.download = `qr-code-${id}.svg`;
                                    document.body.appendChild(link);
                                    link.click();
                                    document.body.removeChild(link);
                                }
                            }
                        </script>



                    </div>
                </div>

                <!-- DataTable Initialization Script -->


            </div>
        </div>
    </div>
</div>
@endsection
