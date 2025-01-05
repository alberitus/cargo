@extends('layout/template')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">OUTSTANDING INVOICE</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="/"><i class="icon-home"></i></a>
            </li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="#">Tables</a></li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="#">OUTSTANDING INVOICE</a></li>
        </ul>
    </div>
    <div class="d-grid gap-3 d-md-flex justify-content">
        <h3>Periode Bulan January 2024 s/d December 2024</h3>
    </div>
    <div class="d-grid gap-3 d-md-flex justify-content-md-end">
        <a target="_blank" class="btn btn-primary  mb-3" type="button" href="{{ route('outstandingcust.export-pdf') }}"><span class="btn-label">
                    <i class="fa fa-print"></i>
                </span> Export PDF</a>
    </div>

    @foreach($transactions as $companyName => $companyTransactions)
    @php
        $companyTotal = 0; // Variabel untuk menghitung total grand_total setiap perusahaan
    @endphp
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">OUTSTANDING {{ $companyName }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2">Date</th>
                                    <th rowspan="2">Invoice ID</th>
                                    <th rowspan="2">Shipper</th>
                                    <th rowspan="2">MAWB</th>
                                    <th colspan="2" class="text-center" style="width: 20%">Amount</th>
                                    <th rowspan="2">Due Date</th>
                                    <th rowspan="2" style="width: 10%">Action</th>
                                </tr>
                                <tr>
                                    <th>USD</th>
                                    <th>IDR</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($companyTransactions as $transaction)
                                @foreach($transaction->orders as $detail)
                                <tr>
                                    <td>{{ $transaction->created_at->format('d-m-y') }}</td>
                                    <td>{{ $transaction->transaction_id }}</td>
                                    <td>{{ $transaction->company_name }}</td>
                                    <td>{{ $detail->mawb }}</td>
                                    <td></td>
                                    <td>{{ 'Rp ' . number_format($transaction->grand_total, 0, ',', '.') }}</td>
                                    <td>{{ $transaction->date_payment }}</td>
                                    <td>
                                        @php
                                        $encryptedId = Crypt::encryptString($transaction->transaction_id);
                                        @endphp
                                        <a href="{{ route('invoice.cetak', ['id' => $encryptedId]) }}">
                                            <button class="btn btn-primary btn-xs" title="view">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                        </a>
                                        <form action="{{ route('invoice.delete', $transaction->transaction_id) }}" 
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs"
                                                    onclick="return confirm('Are you sure you want to delete this Invoice?');">
                                                <i class="fa fa-times"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @php
                                    $companyTotal += $transaction->grand_total; // Tambahkan nilai grand_total ke total perusahaan
                                @endphp
                                @endforeach
                                @endforeach
                                <!-- Baris Total -->
                                <tr>
                                    <td colspan="5" class="text-right fw-bold">Total Amount:</td>
                                    <td class="fw-bold">{{ 'Rp ' . number_format($companyTotal, 0, ',', '.') }}</td>
                                    <td colspan="2"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endSection
