@extends('layout/template')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Order</h3>
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
                <a href="#">Order</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="/invoice">Order Form</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title text-center">PT. ANDIMA TRANSPORTINDO</div>
                    <div class="text-center">
                        <h5>Jl. nama jalan</h5>
                    </div>
                    <div class="text-center">
                        <h6>example@email.com</h6>
                    </div>
                </div>
                @php
                                        $encryptedId = Crypt::encryptString($transaction->transaction_id);
                                        @endphp
                <div class="card-body">
                    <div class="d-grid gap-3 d-md-flex justify-content-md-end">
                        <a target="_blank" class="btn btn-primary  mb-3" type="button" href="{{ route('invoice.pdf', ['id' => $encryptedId]) }}"><span class="btn-label">
                                    <i class="fa fa-print"></i>
                                </span> Export PDF</a>
                        <a target="_blank" class="btn btn-primary  mb-3" type="button" href="/invoice/exportexcel"> <span class="btn-label">
                                    <i class="fa fa-print"></i>
                                </span> Export Excel</a>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-2">
                            <div class="col-8">
                                <h9><span id="spanTotal">CUSTOMER</span></h9>
                            </div>
                            <div class="col-8">
                                <h9><span id="spanTotal">JOB NO</span></h9>
                            </div>
                            <div class="col-8">
                                <h9><span id="spanTotal">FLIGHT / DATE</span></h9>
                            </div>
                            <div class="col-8">
                                <h9><span id="spanTotal">MAWB NO</span></h9>
                            </div>
                            <div class="col-8">
                                <h9><span id="spanTotal">HAWB NO</span></h9>
                            </div>
                            <div class="col-8">
                                <h9><span id="spanTotal">DESTINATION</span></h9>
                            </div>
                            <div class="col-8">
                                <h9><span id="spanTotal">JOB REF</span></h9>
                            </div>
                            <div class="col-8">
                                <h9><span id="spanTotal">DETAIL</span></h9>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-10">
                            <div class="col-8">
                                <h9><span id="spanTotal">: {{ $transaction->company_name }}</span></h9>
                            </div>
                            @foreach($transaction->orders as $order)
                            <div class="col-8">
                                <h9><span id="spanTotal">: {{ $order->job_no }}</span></h9>
                            </div>
                            <div class="col-8">
                                <h9><span id="spanTotal">: {{ $order->flight_date }}</span></h9>
                            </div>
                            <div class="col-8">
                                <h9><span id="spanTotal">: {{ $order->mawb }}</span></h9>
                            </div>
                            <div class="col-8">
                                <h9><span id="spanTotal">: {{ $order->hawb }}</span></h9>
                            </div>
                            <div class="col-8">
                                <h9><span id="spanTotal">: {{ $order->destination }}</span></h9>
                            </div>
                            <div class="col-8">
                                <h9><span id="spanTotal">: {{ $order->job_ref }}</span></h9>
                            </div>
                            <div class="col-8">
                                <h9><span id="spanTotal">: {{ $order->detail }}</span></h9>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <br>
                    <div class="card-title">SELLING</div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ITEM</th>
                                    <th>HARGA</th>
                                    <th>QTY</th>
                                    <th>SUB TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaction->transactionDetails as $detail)
                                <tr>
                                    <td>{{ $detail->nama_item }}</td>
                                    <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                    <td>{{ $detail->amount }}</td>
                                    <td>Rp {{ number_format($detail->price * $detail->amount, 0, ',', '.') }}</td>
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