@extends('layout/template')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Company</h3>
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
                <a href="#">Company</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Company</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Customer</th>
                                    <th>Tax</th>
                                    <th>Grand Total</th>
                                    <th>User</th>
                                    <th style="width: 10%">Action</th>
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
                                    <td>{{ $report->company_name }}</td>
                                    <td>{{ 'Rp ' . number_format($report->total_tax, 0, ',', '.') }}</td>
                                    <td>{{ 'Rp ' . number_format($report->grand_total, 0, ',', '.') }}</td>
                                    <td>{{ $report->name }}</td>
                                    <td>
                                        @php
                                        $encryptedId = Crypt::encryptString($report->transaction_id);
                                        @endphp
                                        <a href="{{ route('invoice.cetak', ['id' => $encryptedId]) }}">
                                            <button class="btn btn-primary btn-xs" title="view">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                        </a>
                                            <form action="{{ route('invoice.delete', $report->transaction_id) }}"
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
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endSection
