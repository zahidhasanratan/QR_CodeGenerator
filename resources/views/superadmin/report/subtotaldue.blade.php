@extends('layouts.subadmin')
@section('title')
    <title>Payment Details | Nurjahan Bazar</title>
@endsection
@section('main')

    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">All Payment Details</h4>
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
                                        <th>Payment</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $orders = \App\Models\Orders::where('user_id', Auth::id())->get();
                                        $payments = \App\Models\Payment::where('user_id', Auth::id())->get();
                                    @endphp

                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                            <td>#{{ $order->id }}</td>
                                            <td>{{ $order->total_amount }}</td>
                                            <td> -- </td> <!-- Payment will be blank -->
                                        </tr>
                                    @endforeach

                                    @foreach($payments as $payment)
                                        <tr>
                                            <td>{{ $payment->payment_date }}</td>
                                            <td> -- </td> <!-- Order Number will be blank -->
                                            <td> -- </td> <!-- Order Total will be blank -->
                                            <td>{{ $payment->amount }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="2">Total</th>
                                        <th id="totalOrderAmount">0</th>
                                        <th id="totalPaymentAmount">0</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3">Due</th>
                                        <th id="dueAmount">0</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    var table = $('#warehouseTable').DataTable({
                                        "order": [[0, "desc"]]
                                    });

                                    $('#filter-button').on('click', function() {
                                        var startDate = new Date($('#start-date').val());
                                        var endDate = new Date($('#end-date').val());

                                        table.search('').draw();

                                        $.fn.dataTable.ext.search.push(
                                            function(settings, data, dataIndex) {
                                                var date = new Date(data[0]);
                                                if (
                                                    (isNaN(startDate) && isNaN(endDate)) ||
                                                    (isNaN(startDate) && date <= endDate) ||
                                                    (startDate <= date && isNaN(endDate)) ||
                                                    (startDate <= date && date <= endDate)
                                                ) {
                                                    return true;
                                                }
                                                return false;
                                            }
                                        );

                                        table.draw();
                                        calculateTotals();
                                    });

                                    function calculateTotals() {
                                        var totalOrderAmount = 0;
                                        var totalPaymentAmount = 0;

                                        table.rows({ filter: 'applied' }).every(function() {
                                            var data = this.data();
                                            var orderTotal = parseFloat(data[2]) || 0;
                                            var paymentTotal = parseFloat(data[3]) || 0;

                                            totalOrderAmount += orderTotal;
                                            totalPaymentAmount += paymentTotal;
                                        });

                                        $('#totalOrderAmount').text(totalOrderAmount.toFixed(2));
                                        $('#totalPaymentAmount').text(totalPaymentAmount.toFixed(2));
                                        var dueAmount = totalOrderAmount - totalPaymentAmount;
                                        $('#dueAmount').text(dueAmount > 0 ? dueAmount.toFixed(2) : 'Paid');
                                    }

                                    calculateTotals();

                                    // Print functionality
                                    $('#print-button').on('click', function() {
                                        var printContent = '<table><thead>' + $('#warehouseTable thead').html() + '</thead><tbody>';

                                        // Loop through each filtered row and append it to the print content
                                        table.rows({ filter: 'applied' }).every(function() {
                                            printContent += '<tr>' + this.nodes().to$().html() + '</tr>';
                                        });

                                        printContent += '</tbody><tfoot>' + $('#warehouseTable tfoot').html() + '</tfoot></table>';

                                        var printWindow = window.open('', '', 'height=500, width=800');
                                        printWindow.document.write('<html><head><title>Total Due List</title>');
                                        printWindow.document.write('</head><body >');
                                        printWindow.document.write(printContent);
                                        printWindow.document.write('</body></html>');

                                        printWindow.document.close();
                                        printWindow.print();
                                    });
                                });
                            </script>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
