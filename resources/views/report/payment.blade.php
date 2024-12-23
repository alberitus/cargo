@extends('layout/template')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Payment</h3>
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
                <a href="#">Payment</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Payment</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Invoice</th>
                                    <th rowspan="2">No Job</th>
                                    <th rowspan="2">Customer Name</th>
                                    <th colspan="2" class="text-center" style="width: 20%">Amount</th>
                                    <th colspan="2" class="text-center" style="width: 20%">Payment</th>
                                    <th rowspan="2" style="width: 10%">Action</th>
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
                                @foreach ($transaction as $pay)
                                @foreach ($pay->orders as $detail)
                                    <tr>
                                        <td>{{ $no++ }}</td>    
                                        <td>{{ $pay->transaction_id }}</td>
                                        <td>{{ $detail->job_no }}</td>
                                        <td>{{ $pay->company_name }}</td>
                                        <td>$.0</td>
                                        <td>{{ 'Rp ' . number_format($pay->grand_total, 0, ',', '.') }}</td>
                                        <td></td>
                                        <td>Mandiri</td>
                                        <td>
                                            <div class="form-button-action">
                                                <form action="{{ route('job.delete', $pay->transaction_id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this job?');">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
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
