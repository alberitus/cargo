@extends('layout/template')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Report</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="/">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Tables</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Report</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Report</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Customer</th>
                                    <th>Tax</th>
                                    <th>Grand Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($transactions as $report)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $report->transaction_id }}</td>
                                    <td>{{ $report->company->name }}</td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                            
                                    <!-- Menampilkan detail transaksi (tax satuan) -->
                                    @foreach ($report->transactionDetails as $detail)
                                    <tr>
                                        <!-- Menampilkan Item ID, Amount, Price, Tax Satuan, dan Total Price -->
                                        <td>{{ $detail->item->nama_item }}</td>
                                        <td>{{ $detail->amount }}</td>
                                        <td>{{ 'Rp ' . number_format($detail->price, 0, ',', '.') }}</td>
                                        <td>{{ 'Rp ' . number_format($detail->tax, 0, ',', '.') }}</td> <!-- Menampilkan Tax Satuan -->
                                        <td>{{ 'Rp ' . number_format($detail->total_price, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                            
                                    <!-- Menampilkan total tax untuk transaksi -->
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Total Tax</strong></td>
                                        <td colspan="2">{{ 'Rp ' . number_format($report->total_tax, 0, ',', '.') }}</td>
                                    </tr>
                            
                                    <!-- Menampilkan grand total untuk transaksi -->
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Grand Total</strong></td>
                                        <td colspan="2">{{ 'Rp ' . number_format($report->grand_total, 0, ',', '.') }}</td>
                                    </tr>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endSection
