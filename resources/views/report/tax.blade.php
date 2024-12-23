@extends('layout/template')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Tax</h3>
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
                <a href="#">Tax</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tax</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No. SERI FAKTUR</th>
                                    <th>CUSTOMER NAME</th>
                                    <th>Tax</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaction as $odr)
                                @foreach ($odr->transactionDetails as $detail)
                                    <tr>
                                        <td>{{ $odr->transaction_id }}</td>
                                        <td>{{ $odr->company_name }}</td>
                                        <td>{{ 'Rp ' . number_format($detail->tax, 0, ',', '.') }}</td>
                                        <td>
                                            @php
                                        $encryptedId = Crypt::encryptString($odr->transaction_id);
                                        @endphp
                                        <a href="{{ route('invoice.cetak', ['id' => $encryptedId]) }}">
                                            <button class="btn btn-primary btn-xs" title="view">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                        </a>
                                            <form action="{{ route('invoice.delete', $odr->transaction_id) }}"
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
