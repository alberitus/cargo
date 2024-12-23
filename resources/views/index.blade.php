@extends('layout.template')
@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Dashboard</h3>
            <h6 class="op-7 mb-2">System {{ session('role_name', 'No role assigned') }} Dashboard</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('transaction.index')}}" class="btn btn-primary btn-round">Add Order</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Company</p>
                                <h4 class="card-title">{{ $totalCompanies }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                <i class="far fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Order</p>
                                <h4 class="card-title">{{ $orderCount }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="fas fa-user-check"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Transaction</p>
                                <h4 class="card-title">{{ $totalTransaction }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-luggage-cart"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Income</p>
                                <h4 class="card-title"> Rp {{ number_format($totalIncome, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Transaction History</div>
                        <div class="card-tools">
                            <div class="dropdown">
                                <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('invoice.index')}}">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Payment Number</th>
                                    <th scope="col" class="text-end">Date & Time</th>
                                    <th scope="col" class="text-end">Amount</th>
                                    <th scope="col" class="text-end">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                <tr>
                                    <th scope="row">
                                        <button class="btn btn-icon btn-round btn-{{ $transaction->status == 2 ? 'success' : 'warning' }} btn-sm me-2">
                                            <i class="fa fa-{{ $transaction->status == 2 ? 'check' : 'clock' }}"></i>
                                        </button>
                                        Payment from #{{ $transaction->transaction_id }}
                                    </th>
                                    <td class="text-end">
                                        {{ $transaction->created_at->format('D, d M Y, H:i') }}
                                    </td>
                                    <td class="text-end">
                                        Rp {{ number_format($transaction->transactionDetails->sum('total_price'), 0, ',', '.') }}
                                    </td>
                                    <td class="text-end">
                                        @if($transaction->status == 1)
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($transaction->status == 2)
                                            <span class="badge badge-success">Completed</span>
                                        @else
                                            <span class="badge badge-danger">Cancelled</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-primary card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Daily Sales</div>
                    </div>
                    <div class="card-category">{{ date('F d', strtotime($startDate)) }} - {{ date('F d, Y', strtotime($endDate)) }}</div>
                </div>
                <div class="card-body pb-0">
                    <div class="mb-4 mt-2">
                        <h1>Rp {{ number_format(array_sum($data), 0, ',', '.') }}</h1>
                    </div>
                    <div class="pull-in">
                        <canvas id="dailySalesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var labels = {!! json_encode($labels) !!}; 
        var incomeData = {!! json_encode($data) !!};
    
        var dailySalesChart = document.getElementById('dailySalesChart').getContext('2d');
    
        new Chart(dailySalesChart, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: "Sales Analytics",
                    fill: true,
                    backgroundColor: "rgba(255,255,255,0.2)",
                    borderColor: "#fff",
                    borderCapStyle: "butt",
                    borderDash: [],
                    borderDashOffset: 0,
                    pointBorderColor: "#fff",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 1,
                    pointRadius: 1,
                    pointHitRadius: 5,
                    data: incomeData
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                animation: {
                    easing: "easeInOutBack"
                },
                scales: {
                    yAxes: [{
                        display: false,
                        ticks: {
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "bold",
                            beginAtZero: true,
                            maxTicksLimit: 10,
                            padding: 0,
                            beginAtZero: true,
            autoSkip: true
                        },
                        gridLines: {
                            drawTicks: false,
                            display: true
                        }
                    }],
                    xAxes: [{
                        display: false,
                        gridLines: {
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            padding: -20,
                            fontColor: "rgba(255,255,255,0.2)",
                            fontStyle: "bold"
                        }
                    }]
                }
            }
        });
    });
    </script>
@endSection