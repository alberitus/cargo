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
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Price</th>
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
                                @foreach ($transactions as $inv)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $inv->transaction_id }}</td>
                                    <td>{{ $inv->item->nama_item }}</td>
                                    <td>{{ $inv->qty }}</td>
                                    <td>{{ 'Rp '. number_format($inv->price, 0, ',', '.') }}</td>
                                    <td>{{ 'Rp '. number_format($inv->tax, 0, ',', '.') }}</td>
                                    <td>{{ 'Rp '. number_format($inv->grand_total, 0, ',', '.') }}</td>
                                    {{-- <td>{{ 'Rp ' . number_format($report->total_tax, 0, ',', '.') }}</td>
                                    <td>{{ 'Rp ' . number_format($report->grand_total, 0, ',', '.') }}</td> --}}
                                    <td>{{ $inv->user->name }}</td>
                                    <td>
                                        <div class="form-button-action">
                                            <form action="{{ route('job.delete', $inv->transaction_id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this job?');">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        </div>
                                </td>
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
