@extends('layout/template')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Detail Invoice</h3>
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
                <a href="#">Detail Invoice</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail Invoice</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="11">No</th>
                                    <th rowspan="11">Date</th>
                                    <th rowspan="11">Invoice</th>
                                    <th rowspan="11">Customer Name</th>
                                    <th colspan="11" class="text-center" style="width: 30%">Amount</th>
                                    <th rowspan="11" class="text-center" style="width: 10%">Amount Without PPN</th>
                                    <th rowspan="11" style="width: 10%">Total</th>
                                    <th rowspan="11" style="width: 10%">Action</th>
                                </tr>
                                <tr>
                                    <th>RP</th>
                                    <th>USD</th>
                                    <th>KURS</th>
                                    <th>Reimburs</th>
                                    <th>LAND TRANS</th>
                                    <th>OTHERS</th>
                                    <th>DPP PPN 0%</th>
                                    <th>DPP PPN 1,1%</th>
                                    <th>DPP PPN 11%</th>
                                    <th>PPN</th>
                                    <th>%</th>
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
                                        <td>{{ $pay->created_at }}</td>    
                                        <td>{{ $pay->transaction_id }}</td>
                                        <td>{{ $pay->company_name }}</td>
                                        <td>{{ 'Rp ' . number_format($pay->grand_total, 0, ',', '.') }}</td>
                                        <td>$.0</td>
                                        <td>0.00</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>7</td>
                                        <td>{{ 'Rp ' . number_format($detail->tax, 0, ',','.' )}}</td>
                                        <td>1,1 %</td>
                                        <td>{{ 'Rp ' . number_format($pay->total_tax, 0, ',', '.') }}</td>
                                        <td>{{ 'Rp ' . number_format($pay->total_price, 0, ',', '.') }}</td>
                                        <td>{{ 'Rp ' . number_format($pay->grand_total, 0, ',', '.') }}</td>
                                        <td>
                                            @php
                                        $encryptedId = Crypt::encryptString($pay->transaction_id);
                                        @endphp
                                        <a href="{{ route('invoice.cetak', ['id' => $encryptedId]) }}">
                                            <button class="btn btn-primary btn-xs" title="view">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                        </a>
                                            <form action="{{ route('invoice.delete', $pay->transaction_id) }}"
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
