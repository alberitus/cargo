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
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">
                            @if(request('filter') == 'no')
                                Invoice Without Tax
                            @else
                                Invoice Tax
                            @endif
                        </h4>
                        <div class="btn-group" role="group">
                            <a href="{{ route('report.tax', ['filter' => '1.1']) }}" class="btn btn-primary {{ request('filter') == '1.1' ? 'active' : '' }}">
                                Tax 11%
                            </a>                           
                            <a href="{{ route('report.tax', ['filter' => '11']) }}" class="btn btn-primary {{ request('filter') == '11' ? 'active' : '' }}">
                                Tax 11%
                            </a>
                            <a href="{{ route('report.tax', ['filter' => 'no']) }}" class="btn btn-primary {{ request('filter') == 'no' ? 'active' : '' }}">
                                No Tax
                            </a>
                            <a href="{{ route('report.tax') }}" class="btn btn-secondary">
                                All
                            </a>
                        </div>
                        <a target="_blank" href="{{ route('tax.export-pdf', ['filter' => request('filter')]) }}" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No. SERI FAKTUR</th>
                                    <th>CUSTOMER NAME</th>
                                    <th>Tax</th>
                                    <th>Price</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaction as $odr)
                                @foreach ($odr->transactionDetails as $detail)
                                    <tr>
                                        <td>{{ $odr->transaction_id }}</td>
                                        <td>{{ $odr->company_name }}</td>
                                        <td>
                                            @if($detail->tax > 0)
                                                {{ $detail->tax }} %
                                            @else
                                                No Tax
                                            @endif
                                        </td>
                                        <td style="text-align: right">
                                            {{ 'Rp ' . number_format($detail->tax_price, 0, ',', '.') }}
                                        </td>
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