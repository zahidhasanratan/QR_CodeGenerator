@extends('layouts.superadmin')
@section('title')
    <title>Product List | Nurjahan Bazar</title>
@endsection
@section('main')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{ $warehouse->name }} Warehouse All Product List</h4>
                    </div>

                    <!-- data table -->
                    <div class="table-wrapper">
                        <div class="card-body">
                            <div class="add-button text-right">
                                <a href="{{ route('product.create') }}" class="btn btn-primary text-capitalize"><span>Add Product</span></a>
                                <button id="printButton" class="btn btn-secondary text-capitalize"><span>Print All List</span></button>
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
                                        <th>Product Name</th>
                                        <th>Category Name</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Unit</th>
                                        <th class="text-right">Action</th>
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
                                            <td class="td-actions text-left">
                                                <button type="button" onclick="window.location='{{ route('product.edit', $list->id) }}'" rel="tooltip" class="btn btn-primary btn-link btn-sm" title="Edit list">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                                <form id="delete-form-{{ $list->id }}" action="{{ route('product.destroy', $list->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button type="button" rel="tooltip" class="btn btn-danger btn-link btn-sm" title="Remove" onclick="if(confirm('Are you sure you want to delete this item?')) { event.preventDefault(); document.getElementById('delete-form-{{ $list->id }}').submit(); }">
                                                    <i class="material-icons">close</i>
                                                </button>
                                                <button type="button" rel="tooltip" title="Add Quantity" class="btn btn-danger btn-link btn-sm" data-toggle="modal" data-target="#priceModal" data-product-id="{{ $list->id }}" data-product-name="{{ $list->name }}">
                                                    <i class="material-icons">attach_money</i>
                                                </button>
                                            </td>
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
                            $('#warehouseTable').DataTable({
                                paging: false, // Disable pagination
                                dom: 'Bfrtip',
                                buttons: [
                                    {
                                        extend: 'print',
                                        title: '{{ $warehouse->name }} Warehouse All Product List',
                                        exportOptions: {
                                            columns: ':not(.text-right)' // Exclude the action column
                                        },
                                        customize: function (win) {
                                            // Hide any unwanted elements in print view
                                            $(win.document.body).find('.dataTables_filter, .dataTables_length, .dataTables_info, .dataTables_paginate').hide();
                                            $(win.document.body).find('table').css('font-size', 'inherit');
                                        }
                                    }
                                ]
                            });

                            // Trigger DataTable's print button when our custom print button is clicked
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
