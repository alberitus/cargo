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
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="defaultSelect">CUTOMER</label>
                                <select name="company_id" id="company_id" class="form-select">
                                    <option value="" disabled selected>-- Pilih Perusahaan --</option>
                                    @foreach ($company as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="defaultSelect">JOB</label>
                                <select class="form-select form-control" id="defaultSelect">
                                    <option>OB</option>
                                    <option>OB</option>
                                    <option>OB</option>
                                    <option>OB</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">FLIGHT / DATE</label>
                                <input type="text" class="form-control form-control" id="defaultInput"
                                    placeholder="FLIGHT / DATE">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">MAWB NUMBER</label>
                                <input type="text" class="form-control form-control" id="defaultInput"
                                    placeholder="MAWB NUMBER">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="largeInput">DESTINATION</label>
                                <input type="text" class="form-control form-control" id="defaultInput"
                                    placeholder="DESTINATION">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">HAWB NUMBER</label>
                                <input type="text" class="form-control form-control" id="defaultInput"
                                    placeholder="HAWB NUMBER">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">JOB REF</label>
                                <input type="text" class="form-control form-control" id="defaultInput"
                                    placeholder="JOB REF">
                            </div>
                            <div class="form-group">
                                <label for="comment">Details</label>
                                <textarea class="form-control" id="comment" rows="2"></textarea>
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
                                <button class="btn btn-primary" data-bs-target="#modalItem" data-bs-toggle="modal">Pilih
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
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="tax1" value="6.600" />
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                1.1%
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="tax2" value="16.500" checked />
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                11%
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
                                    <h5 style="width: 80%; text-align: left;">RP
                                        150.000</h5>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <h5 style="width: 80%; text-align: left;">RP
                                        16.500</h5>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <h5 style="width: 80%; text-align: left;">RP
                                        166.500</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card-title">COST</div>
                    <br>
                    <table class="table table-striped table-hover mt-4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th width="17%">Produk</th>
                                <th width="16%">Jumlah</th>
                                <th width="19%">Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                    <h6 style="width: 80%; text-align: left;">RP
                                        63.000</h6>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <h6 style="width: 80%; text-align: left;">RP
                                        103.000</h6>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <h6 style="width: 80%; text-align: left;">RP
                                        3.000</h6>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <h5 style="width: 80%; text-align: left;">RP
                                        100.000</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-3 d-md-flex justify-content-md-end">
                        <button class="btn btn-success me-md-2" type="button"> Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('invoice/modal-item')
@include('invoice/modal-ubah')
@endSection
<script>
    function loadCart() {
        $.ajax({
            url: "{{ route('loadCart') }}",  // Pastikan route loadCart sudah didefinisikan
            method: "GET",
            success: function(data) {
                // Menampilkan data keranjang di halaman
                var cartHTML = '';
                data.forEach(function(item) {
                    cartHTML += `<tr>
                        <td>${item.nama_item}</td>
                        <td>${item.quantity}</td>
                        <td>${item.satuan}</td>
                    </tr>`;
                });
                $('#cartTable tbody').html(cartHTML);  // Pastikan ada tabel dengan ID #cartTable
            },
            error: function(xhr, status, error) {
                console.log("Terjadi kesalahan: " + error);
            }
        });
    }

    function add_cart(id, name, qty, satuan) {
        $.ajax({
            url: "{{ route('addItem') }}", 
            method: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                nama_item: name,
                quantity: qty,
            },
            success: function(data) {
                // Menutup modal setelah menambahkan item
                $('#modalItem').modal('hide');
                // Memuat ulang data keranjang
                loadCart();  // Fungsi untuk menampilkan data keranjang terbaru
            },
            error: function(xhr, status, error) {
                console.log("Terjadi kesalahan: " + error);
            }
        });
    }
</script>


