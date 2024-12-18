@extends('layouts.superadmin')
@section('title')
    <title>Total Sale | Nurjahan Bazar</title>
@endsection
@section('main')

    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">All Sales List</h4>
                    </div>

                    <!-- Data Table -->
                    <div class="table-wrapper">
                        <div class="card-body">
                            <div class="filter-date mb-3">
                                <label for="start-date">Start Date:</label>
                                <input type="date" id="start-date" class="form-control" style="display: inline; width: auto;" />

                                <label for="end-date">End Date:</label>
                                <input type="date" id="end-date" class="form-control" style="display: inline; width: auto;" />

                                <button id="filter-button" class="btn btn-primary mt-2">Filter</button>
                                <button id="print-button" class="btn btn-secondary mt-2">Print</button>
                            </div>


                            <div class="table-responsive">

                                <table id="warehouseTable" class="table table-hover" cellspacing="0" width="100%">
                                    <thead class="text-primary">
                                    <tr>

                                        <th>Date</th>
                                        <th>Order Number</th>
                                        <th>Order Total</th>
                                        <th>Shop Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $orders = \App\Models\Orders::all(); // Correct model call here
                                    @endphp

                                    @foreach($orders as $key=>$order)
                                        <tr>

                                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                            <td>{{ $order->id }}</td>

                                            <td>{{ $order->total_amount }}</td>
                                           
                                                    <td>{{ optional(\App\Models\SrShop::where('id', $order->shop_id)->first())->shopName ?? 'N/A' }}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="2">Total</th>
                                        <th id="totalOrderAmount">0</th>
                                    </tr>
                                    </tfoot>
                                </table>

                            </div>
                            <script>
                                $(document).ready(function() {
                                    var table = $('#warehouseTable').DataTable({
                                        "order": [[1, "desc"]] // Sort by the first column (Date)
                                    });

                                    // Filter by date range
                                    $('#filter-button').on('click', function() {
                                        var startDate = new Date($('#start-date').val());
                                        var endDate = new Date($('#end-date').val());

                                        // Clear any previous search
                                        table.search('').draw();

                                        // Apply the date filter
                                        $.fn.dataTable.ext.search.push(
                                            function(settings, data, dataIndex) {
                                                var date = new Date(data[0]); // Date is in the first column
                                                if (
                                                    (isNaN(startDate) && isNaN(endDate)) || // No filter
                                                    (isNaN(startDate) && date <= endDate) || // Start date not set, but end date is set
                                                    (startDate <= date && isNaN(endDate)) || // End date not set, but start date is set
                                                    (startDate <= date && date <= endDate) // Both dates are set
                                                ) {
                                                    return true;
                                                }
                                                return false;
                                            }
                                        );

                                        // Redraw the table with the new filter
                                        table.draw();

                                        // Calculate totals based on filtered rows
                                        calculateTotals();
                                    });

                                    // Print filtered table
                                    $('#print-button').on('click', function() {
                                        var startDateText = $('#start-date').val() || 'N/A';
                                        var endDateText = $('#end-date').val() || 'N/A';

                                        // Create a custom header for print view
                                        var printHeader = `<h2>All Sales List (Start Date: ${startDateText}, End Date: ${endDateText})</h2>`;

                                        // Save current table settings
                                        var currentPaging = table.settings()[0]._iDisplayLength;

                                        // Show all rows for printing
                                        table.page.len(-1).draw();

                                        // Hide DataTables controls
                                        $('.dataTables_length, .dataTables_filter, .dataTables_info, .dataTables_paginate').hide();

                                        // Print the table
                                        var printContent = printHeader + $('.table-responsive').html();
                                        var originalContent = document.body.innerHTML;

                                        document.body.innerHTML = printContent;
                                        window.print();

                                        // Restore original content and settings
                                        document.body.innerHTML = originalContent;
                                        location.reload(); // Reload to restore the original page
                                        table.page.len(currentPaging).draw(); // Restore pagination setting
                                    });

                                    function calculateTotals() {
                                        var totalOrderAmount = 0;

                                        // Iterate through the filtered rows
                                        table.rows({ filter: 'applied' }).every(function() {
                                            var data = this.data();
                                            var orderTotal = parseFloat(data[2]) || 0; // Order Total is in the third column
                                            totalOrderAmount += orderTotal;
                                        });

                                        // Update the totals in the footer
                                        $('#totalOrderAmount').text(totalOrderAmount.toFixed(2));
                                    }

                                    // Initial calculation
                                    calculateTotals();
                                });
                            </script>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
