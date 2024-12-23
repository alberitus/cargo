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
                <div class="card-body">
                    <form method="POST" action="transaction/submit-transaction">
                        @csrf
                        <div class="row">
                            <div class="card-title">Order</div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="defaultSelect">Customer</label>
                                    <select name="company" class="form-select">
                                        @foreach ($company as $cust)
                                        <option id="addConsigne" value="{{ $cust->name }}"
                                            {{ old('company_id') == $cust->name ? 'selected' : '' }}>
                                            {{ $cust->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="defaultSelect">JOB No</label>
                                    <select name="job_no" class="form-select">
                                        @foreach ($jobsWithDate as $job)
                                        <option id="addPosition" value="{{ $job->job_name }}"
                                            {{ old('job_id') == $job->job_name ? 'selected' : '' }}>
                                            {{ $job->job_name }} / {{ $job->display_date }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group @error('job_ref') has-error has-feedback @enderror">
                                    <label for="largeInput">JOB REF</label>
                                    <input type="text" class="form-control form-control" name="job_ref"
                                        id="defaultInput" placeholder="JOB REF" value="{{ old('job_ref') }}">
                                    @error('job_ref')
                                    <small class="form-text text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group @error('flight_date') has-error has-feedback @enderror">
                                    <label for="largeInput">FLIGHT / DATE</label>
                                    <input type="text" class="form-control form-control" name="flight_date"
                                        id="defaultInput" placeholder="FLIGHT / DATE">
                                    @error('flight_date')
                                    <small class="form-text text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group @error('destination') has-error has-feedback @enderror">
                                    <label for="largeInput">DESTINATION</label>
                                    <input type="text" class="form-control form-control" name="destination"
                                        id="defaultInput" placeholder="DESTINATION">
                                    @error('destination')
                                    <small class="form-text text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group @error('mawb') has-error has-feedback @enderror">
                                    <label for="largeInput">MAWB NUMBER</label>
                                    <input type="text" class="form-control form-control" name="mawb" id="defaultInput"
                                        placeholder="MAWB NUMBER">
                                    @error('mawb')
                                    <small class="form-text text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">HAWB NUMBER</label>
                                    <input type="text" class="form-control form-control" name="hawb" id="defaultInput"
                                        placeholder="HAWB NUMBER">
                                </div>
                                <div class="form-group">
                                    <label for="defaultSelect">Consgine</label>
                                    <select name="consigne" class="form-select">
                                        @foreach ($consigne as $Cons)
                                        <option id="addConsigne" value="{{ $Cons->nama_consigne }}"
                                            {{ old('consigne_id') == $Cons->nama_consigne ? 'selected' : '' }}>
                                            {{ $Cons->nama_consigne }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group @error('shipper') has-error has-feedback @enderror">
                                    <label for="largeInput">SHIPPER</label>
                                    <input type="text" class="form-control form-control" name="shipper"
                                        id="defaultInput" placeholder="SHIPPER">
                                    @error('shipper')
                                    <small class="form-text text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="comment">Details</label>
                                    <textarea class="form-control" id="comment" name="detail" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="card-title">SELLING</div>
                        <br>
                        <div class="container">
                            <div class="col">
                                <label class="col-form-label">Tanggal: </label>
                                <input type="text" value="<?= date('d/m/y') ?>" disabled>
                            </div>
                            <div class="row">
                                <div class="d-grid gap-3 d-md-flex justify-content-md-end">
                                    <button class="btn btn-primary" type="button" data-bs-target="#modalCart"
                                        data-bs-toggle="modal">Pilih
                                        Item</button>
                                </div>
                            </div>
                        </div>
                        <table id="cartTable" class="table table-striped table-hover mt-4">
                            <thead>
                                <tr>
                                      <th>No</th>
                                    <th>Item</th>
                                    <th>QTY</th>
                                    <th>Satuan</th>
                                    <th>Harga Satuan</th>
                                    <th>Harga Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="detail_cart">
                            </tbody>
                        </table>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label>TAX</label><br />
                                        <div class="d-flex">
                                            <div class="form-check">
                                                <input class="form-check-input tax-radio" type="radio" name="tax"
                                                    id="tax1" value="6600" />
                                                <label class="form-check-label" for="tax1">
                                                    1.1%
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input tax-radio" type="radio" name="tax"
                                                    id="tax2" value="16500" checked />
                                                <label class="form-check-label" for="tax2">
                                                    11%
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input tax-radio" type="radio" name="tax"
                                                    id="tax3" value="0" checked />
                                                <label class="form-check-label" for="tax3">
                                                    No PPN
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="d-grip gap-3 d-md-flex justify-content-md-end">
                                        <h5>TOTAL HARGA</h5>
                                    </div>
                                    <div class="d-grip gap-3 d-md-flex justify-content-md-end">
                                        <h5>TAX 11%</h5>
                                    </div>
                                    <div class="d-grip gap-3 d-md-flex justify-content-md-end">
                                        <h5>GRAND TOTAL</h5>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="d-flex justify-content-center">
                                        <h5 style="width: 80%; text-align: left;" id="total-harga">RP 0</h5>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <h5 id="tax-value" style="width: 80%; text-align: left;">RP 0</h5>
                                    </div>
                                    
                                    <div class="d-flex justify-content-center">
                                        <h5 style="width: 80%; text-align: left;" name="total" id="grand-total">RP 0
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="card-title">COST</div>
                        <br>
                        <div class="container">
                            <div class="row">
                                <div class="d-grid gap-3 d-md-flex justify-content-md-end">
                                    <button class="btn btn-primary" type="button" data-bs-target="#modalCost"
                                        data-bs-toggle="modal">Pilih
                                        Item</button>
                                </div>
                            </div>
                        </div>
                        <table id="costTable" class="table table-striped table-hover mt-4">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Item</th>
                                    <th>QTY</th>
                                    <th>Satuan</th>
                                    <th>Harga Satuan</th>
                                    <th>Harga Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="detail_cost">
                            </tbody>
                        </table>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-lg-8">
                                    <div class="d-grip gap-3 d-md-flex justify-content-md-end">
                                        <h6>TOTAL COST</h6>
                                    </div>
                                    <div class="d-grip gap-3 d-md-flex justify-content-md-end">
                                        <h6>GROSS PROFIT</h6>
                                    </div>
                                    <div class="d-grip gap-3 d-md-flex justify-content-md-end">
                                        <h6>PPH 23</h6>
                                    </div>
                                    <div class="d-grip gap-3 d-md-flex justify-content-md-end">
                                        <h5>PROFIT</h5>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="d-flex justify-content-center">
                                        <h5 style="width: 80%; text-align: left;" id="total-cost">RP 0</h5>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <h6 style="width: 80%; text-align: left;" id="gross-profit">RP
                                            0</h6>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <h6 style="width: 80%; text-align: left;" id="pph23">RP
                                            0</h6>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <h5 style="width: 80%; text-align: left;" id="profit">RP
                                            0</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-3 d-md-flex justify-content-md-end">
                            <button class="btn btn-success me-md-2" id="save-transaction" type="submit"> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('transaction/modal-cart')
@include('transaction/modal-cost')
@include('transaction/modal-ubah')
@include('transaction/modal-ubah-cost')
@include('transaction/cart')
@include('transaction/cost')
@endSection
