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
                <a href="/report">Order Form</a>
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
                <div class="card-body">
                    <div class="d-grid gap-3 d-md-flex justify-content-md-end">
                        <a target="_blank" class="btn btn-primary  mb-3" type="button" href="/invoice/pdf"><span
                                class="btn-label">
                                <i class="fa fa-print"></i>
                            </span> Export PDF</a>
                        <a target="_blank" class="btn btn-primary  mb-3" type="button" href="/invoice/exportexcel">
                            <span class="btn-label">
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
                                <h9><span id="spanTotal">DESTINATION</span></h9>
                            </div>
                            <div class="col-8">
                                <h9><span id="spanTotal">HAWB NO</span></h9>
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
                                <h9><span id="spanTotal">: PT. EXAMPLE</span></h9>
                            </div>
                            <div class="col-8">
                                <h9><span id="spanTotal">: 545/GEO-OB/<?= date ("ym") ?></span></h9>
                            </div>
                            <div class="col-8">
                                <h9><span id="spanTotal">: KL<?= date ("my") ?></span></h9>
                            </div>
                            <div class="col-8">
                                <h9><span id="spanTotal">: 074-02345232</span></h9>
                            </div>
                            <div class="col-8">
                                <h9><span id="spanTotal">: FRA-CGK
                                    </span></h9>
                            </div>
                            <div class="col-8">
                                <h9><span id="spanTotal">: -</span></h9>
                            </div>
                            <div class="col-8">
                                <h9><span id="spanTotal">: SFRAA194859</span></h9>
                            </div>
                            <div class="col-8">
                                <h9><span id="spanTotal">: 1 KOLI 35,5 KGS</span></h9>
                            </div>
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
                                <tr>
                                    <td>HANDLING</td>
                                    <td>Rp 140.000</td>
                                    <td>1</td>
                                    <td>Rp 140.000</td>
                                </tr>
                                <tr>
                                    <td>PICK UP DOKUMEN</td>
                                    <td>Rp 10.000</td>
                                    <td>1</td>
                                    <td>Rp 10.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
