@extends('layout/template')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Faktur</h3>
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
                <a href="#">Faktur</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Faktur</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Job No</th>
                                    <th>Date</th>
                                    <th>No Faktur</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($faktur as $invoice)
                                @foreach ($invoice->orders as $detail)
                                <tr>
                                    <td>{{ $invoice->transaction_id }}</td>
                                    <td>{{ $detail->job_no }}</td>
                                    <td>{{ $invoice->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        @if ($invoice->faktur == 0)
                                            <button type="button" class="btn btn-primary btn-round ms-auto"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalFaktur{{ $invoice->transaction_id }}">
                                                Input Faktur
                                            </button>
                                        @else
                                            <span>{{ $invoice->faktur }}</span>
                                        @endif
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
@include('faktur/modal-faktur')
@endSection
