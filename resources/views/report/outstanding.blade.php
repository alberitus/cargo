@extends('layout/template')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Outstanding</h3>
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
                <a href="#">Outstanding</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Outstanding</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>No Job</th>
                                    <th>Customer Name</th>
                                    <th>MAWB</th>
                                    <th>Amount(Rp)</th>
                                    <th>Due Date</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($transaction as $outs)
                                @foreach ($outs->orders as $detail)
                                    <tr>
                                        <td>{{ $no++ }}</td>    
                                        <td>{{ $outs->transaction_id }}</td>
                                        <td>{{ $detail->job_no }}</td>
                                        <td>{{ $outs->company_name }}</td>
                                        <td>{{ $detail->mawb }}</td>
                                        <td>{{ 'Rp ' . number_format($outs->grand_total, 0, ',', '.') }}</td>
                                        <td><?= date('d/m/y') ?></td>
                                        <td>
                                            <div class="form-button-action">
                                                <form action="{{ route('job.delete', $outs->transaction_id) }}" method="POST" style="display:inline;">
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
