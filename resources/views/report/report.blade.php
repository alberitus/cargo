@extends('layout/template')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Company Reports</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="/"><i class="icon-home"></i></a>
            </li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="#">Tables</a></li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="#">Company</a></li>
        </ul>
    </div>
    <div class="d-grid gap-3 d-md-flex justify-content-md-end">
        <a target="_blank" class="btn btn-primary  mb-3" type="button" href="{{ route('company.export-pdf') }}"><span class="btn-label">
                    <i class="fa fa-print"></i>
                </span> Export PDF</a>
    </div>

    @foreach($transactions as $companyName => $companyTransactions)
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $companyName }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice ID</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Status Faktur</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($companyTransactions as $index => $transaction)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $transaction->transaction_id }}</td>
                                    <td>{{ $transaction->name }}</td>
                                    <td>{{ $transaction->status }}</td>
                                    <td>{{ $transaction->stsfaktur }}</td>
                                    <td>
                                        @php
                                        $encryptedId = Crypt::encryptS  tring($transaction->transaction_id);
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
                                @endforeach
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