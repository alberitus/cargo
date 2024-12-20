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
                    <form method="POST" action="invoice/submit-transaction">
                        @csrf
                        <div class="row">
                            <div class="card-title">Order</div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="defaultSelect">CUTOMER</label>
                                    <select name="company_id" class="form-select">
                                        @foreach ($company as $customer)
                                        <option id="addName" value="{{ $customer->company_id }}"
                                            {{ old('company_id') == $customer->company_id ? 'selected' : '' }}>
                                            {{ $customer->name }}
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
                                    <label for="largeInput">CONSIGNE</label>
                                    <input type="text" class="form-control form-control" name="consigne"
                                        id="defaultInput" placeholder="CONSIGNE">
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
                                        <h5 style="width: 80%; text-align: left;" id="total-price">RP 0</h5>
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
                            <button class="btn btn-success me-md-2" id="save-transaction" type="submit"> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('load', loadCart);

    let totalPrice = 0;

    function formatRupiah(angka) {
        return angka.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });
    }

    function loadCart() {
        $.ajax({
            url: "{{ route('transaction.loadCart') }}",
            method: "GET",
            success: function (data) {
                var cartHTML = '';
                var counter = 1;
                totalPrice = 0;

                data.forEach(function (item) {
                    var itemTotalPrice = item.price * item.qty;
                    totalPrice += itemTotalPrice;
                    var formattedPrice = formatRupiah(item.price);
                    var formattedTotalPrice = formatRupiah(itemTotalPrice);
                    cartHTML += `<tr id="item-${item.item_id}">
                        <td>${counter}</td>
                        <td>${item.nama_item}</td>
                        <td>${item.qty}</td>
                        <td>${item.satuan}</td>
                        <td>${formattedPrice}</td>
                        <td>${formattedTotalPrice}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="openModal(${item.item_id}, ${item.qty})"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="deleteItem(${item.item_id})"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>`;
                    counter++;
                });
                $('#cartTable tbody').html(cartHTML);
                updateTotalPrice();
            },
            error: function (xhr, status, error) {
                console.log("Terjadi kesalahan: " + error);
            }
        });
    }

    function updateTaxValue() {
        const selectedTax = parseFloat(document.querySelector('input[name="tax"]:checked').value) || 0;
        const formattedTax = formatRupiah(selectedTax);
        document.getElementById('tax-value').textContent = formattedTax;
        updateTotalPrice();
    }

    function updateTotalPrice() {
        const selectedTax = parseFloat(document.querySelector('input[name="tax"]:checked').value) || 0;
        const grandTotal = totalPrice + selectedTax;
        const formattedGrandTotal = formatRupiah(grandTotal);
        document.getElementById('grand-total').textContent = formattedGrandTotal;

        const formattedTotalPrice = formatRupiah(totalPrice);
        document.getElementById('total-price').textContent = formattedTotalPrice;
    }

    const taxRadios = document.querySelectorAll('.tax-radio');
    taxRadios.forEach(radio => {
        radio.addEventListener('change', updateTaxValue);
    });

    document.addEventListener('DOMContentLoaded', () => {
        loadCart();
        updateTaxValue();
    });

    function openModal(itemId, qty) {
        $('#item_id').val(itemId);
        $('#qty').val(qty);
        $('#modalUbah').modal('show');
    }

    function add_cart(item_id, name, satuan) {
        var price = document.getElementById('price-' + item_id).value;
        if (price === "" || price <= 0) {
            alert("Silahkan Masukkan Harga!");
            return;
        }
        price = parseInt(price.replace(/[^0-9]/g, ''), 10);
        var totalPrice = price * qty;
        $.ajax({
            url: "{{ route('addItem') }}",
            method: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                item_id: item_id,
                nama_item: name,
                qty: 1,
                satuan: satuan,
                price,
                total_price: totalPrice
            },
            success: function (data) {
                $('#modalCart').modal('hide');
                updateTotalPrice();
                loadCart();
                $('#total-price').text('RP ' + response.totalPrice('id-ID'));
            },
            error: function (xhr, status, error) {
                console.log("Terjadi kesalahan: " + error);
            }
        });
    }

    function update_cart() {
        var itemId = $('#item_id').val();
        var qty = $('#qty').val();

        $.ajax({
            url: "{{ route('updateCart') }}",
            method: "POST",
            data: {
                item_id: itemId,
                qty: qty,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                console.log('Jumlah item berhasil diperbarui');
                $('#modalUbah').modal('hide');
                loadCart();
            },
            error: function (xhr, status, error) {
                console.log("Terjadi kesalahan: " + error);
            }
        });
    }

    function deleteItem(itemId) {
        $.ajax({
            url: "{{ route('deleteItem') }}",
            method: "POST",
            data: {
                item_id: itemId,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                alert(response.message);
                $('#item-' + itemId).remove();
                loadCart();
            },
            error: function (xhr, status, error) {
                console.error(error);
                alert('Terjadi kesalahan saat menghapus item');
            }
        });
    }

    function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);

        ribuan = ribuan.join('.').split('').reverse().join('');
        return 'Rp ' + ribuan;
    }
    
    var loadCartUrl = "{{ route('transaction.loadCart') }}";  // Pastikan rute diproses oleh Blade
    console.log(loadCartUrl);  // Cek apakah URL rute sudah benar

    // Contoh pemakaian
    fetch(loadCartUrl)
        .then(response => response.json())
        .then(data => {
            // Proses data yang diterima
        })
        .catch(error => console.error("Terjadi kesalahan: " + error));

</script>
@include('invoice/modal-cart')
@include('invoice/modal-ubah')
@endSection
