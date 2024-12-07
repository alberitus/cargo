@extends('layout.template')
@section('content')
<div class="page-inner">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="page-header">
        <h3 class="fw-bold mb-3">Kapal</h3>
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
                <a href="#">Kapal </a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Kapal</h4>
                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                            data-bs-target="#modalTambah">
                            <i class="fa fa-plus"></i>
                            Add Kapal
                        </button>

                    </div>
                </div>
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kapal</th>
                                {{-- <th>Position</th>
                                    <th>Office</th> --}}
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Kapal</th>
                                {{-- <th>Position</th>
                                    <th>Office</th> --}}
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach ($kapal as $K)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td> {{ $K->nama_kapal }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <button type="button" class="btn btn-link btn-primary btn-lg"
                                            data-bs-toggle="modal" data-bs-target="#modalUbah{{ $K->kapal_id }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <form action="{{ route('kapal.delete', $K->kapal_id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this kapal?');">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </form>

                                    </div>
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
</div>
@include('kapal.modal-create')
@include('kapal.modal-edit')
@endsection
