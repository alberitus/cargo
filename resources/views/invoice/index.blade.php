@extends('layout/template')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">TRANSACTION</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#">
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
                <a href="#">Invoice</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Invoice</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Job No</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($transaction as $invoice)
                                @foreach ($invoice->orders as $detail)
                                <tr>
                                    <td>{{ $invoice->company_name }}</td>
                                    <td>{{ $detail->job_no }}</td>
                                    <td><?= date('d/m/y') ?></td>
                                    <td>
                                        @php
                                        $encryptedId = Crypt::encryptString($invoice->transaction_id);
                                        @endphp
                                        @if($invoice->status != 2)
                                        <a href="#"
                                            onclick="confirmClose('{{ url('/invoice/status', ['id' => $encryptedId]) }}')">
                                            <button class="btn btn-primary btn-xs" title="close">
                                                <i class="fas fa-times"></i> Close Invoice
                                            </button>
                                        </a>
                                        @else
                                        <button class="btn btn-secondary btn-xs" disabled title="invoice closed">
                                            <i class="fas fa-check"></i> Invoice Closed
                                        </button>
                                        @endif
                                        <a href="{{ route('invoice.cetak', ['id' => $encryptedId]) }}">
                                            <button class="btn btn-primary btn-xs" title="view">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                        </a>
                                        <form action="{{ route('invoice.delete', $invoice->transaction_id) }}"
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
