@extends('layouts.subadmin')
@section('title')
    <title>Product List | Nurjahan Bazar</title>
@endsection
@section('main')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ $warehouse->name }} Warehouse All Product List</h4>
                    </div>

                    <!-- Data table -->
                    <div class="table-wrapper">
                        <div class="card-body">
                            <!-- Print Button -->


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
                                        <th>Product Name</th>
                                        <th>Category Name</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Unit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product as $key=>$list)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $list->name }}</td>
                                            <td>{{ \App\Models\Category::where('id', $list->categoryId)->first()->name }}</td>
                                            <td>{{ $list->price }}</td>
                                            <td>{{ \App\Models\StockIn::where('productId', $list->id)->where('warehouseId', $warehouse->id)->sum('quantity') }}</td>
                                            <td>{{ $list->unit }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- DataTable Initialization Script -->
                    <script>
                        $(document).ready(function() {
                            // Initialize DataTable with print button
                            $('#warehouseTable').DataTable({
                                paging: true, // Pagination remains enabled for regular view
                                dom: 'Bfrtip', // Include buttons (print)
                                buttons: [
                                    {
                                        extend: 'print',
                                        title: '{{ $warehouse->name }} Warehouse All Product List',
                                        exportOptions: {
                                            columns: ':not(.text-right)' // Exclude the action column from print
                                        },
                                        customize: function (win) {
                                            // Hide pagination and search in the print view
                                            $(win.document.body).find('.dataTables_filter, .dataTables_length, .dataTables_info, .dataTables_paginate').hide();
                                            $(win.document.body).find('table').css('font-size', 'inherit');
                                        }
                                    }
                                ]
                            });

                            // Trigger DataTable's print button when custom print button is clicked
                            $('#printButton').on('click', function() {
                                $('.buttons-print').click();
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

@endsection
