@extends('layout/template')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Outstanding</h3>
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
                <a href="#">Outstanding</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Payment and Outstanding</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>No Job</th>
                                    <th>Customer Name</th>
                                    <th>MAWB</th>
                                    <th>Amount(Rp)</th>
                                    <th>Payment</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                                <tr>
                                    <th>USD</th>
                                    <th>IDR</th>
                                    <th>CASH</th>
                                    <th>TRANSFER</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($transaction as $outs)
                                @foreach ($outs->orders as $detail)
                                    <tr>
                                        <td>{{ $no++ }}</td>    
                                        <td>{{ $outs->transaction_id }}</td>
                                        <td>{{ $detail->job_no }}</td>
                                        <td>{{ $outs->company_name }}</td>
                                        <td>{{ $detail->mawb }}</td>
                                        <td>{{ 'Rp ' . number_format($outs->grand_total, 0, ',', '.') }}</td>
                                        <td>{{ $outs->created_at->format('d-m-y') }}</td>
                                        <td>
                                            @php
                                        $encryptedId = Crypt::encryptString($outs->transaction_id);
                                        @endphp
                                        <a href="{{ route('invoice.cetak', ['id' => $encryptedId]) }}">
                                            <button class="btn btn-primary btn-xs" title="view">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                        </a>
                                            <form action="{{ route('invoice.delete', $outs->transaction_id) }}"
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
                                @endforeach
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
