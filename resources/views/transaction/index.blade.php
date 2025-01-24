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
                    <div class="card-title text-center">PT. AYUTRANS</div>
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
                                    <label for="defaultSelect">Company</label>
                                    <select name="company" class="form-select" id="companySelect">
                                        @foreach ($company as $cust)
                                        <option value="{{ $cust->company_name }}" data-code="{{ $cust->code_name }}"
                                            {{ old('company_id') == $cust->company_name ? 'selected' : '' }}>
                                            {{ $cust->company_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="defaultSelect">Job Type</label>
                                    <select name="job_type" class="form-select" id="jobSelect">
                                        @foreach ($job as $jobs)
                                        <option value="{{ $jobs->job_code }}" data-prefix="{{ $jobs->next_prefix }}">
                                            {{ $jobs->job_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jobFormat">Job Number Format</label>
                                    {{-- <input type="text" class="form-control" id="jobFormat" name="job_format" readonly> --}}
                                    <input type="text" class="form-control" id="jobFormat" data-next-job-number="{{ $nextJobNumber }}" readonly>
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
                                    <label for="defaultSelect">Consginee</label>
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
                        <div id="content-selling-card">
                            <button id="append-selling-card" class="btn btn-primary" type="button">Add Selling Card</button>
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <label class="col-form-label">Tanggal:</label>
                                        <input type="text" value="<?= date('d/m/y') ?>" class="form-control" disabled
                                            style="height: 38px;">
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-group">
                                            <label class="form-label">Faktur</label>
                                            <div class="selectgroup w-100" style="height: 38px;">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="stsfaktur" value="0" class="selectgroup-input"
                                                        checked="" />
                                                    <span class="selectgroup-button">No</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="stsfaktur" value="1"
                                                        class="selectgroup-input" />
                                                    <span class="selectgroup-button">Yes</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto  ms-auto">
                                        <button class="btn btn-primary" type="button" data-bs-target="#modalCart"
                                            data-bs-toggle="modal" style="height: 38px;">Pilih Item</button>
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
                                                        id="tax1" value="1.1" />
                                                    <label class="form-check-label" for="tax1">
                                                        1.1%
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input tax-radio" type="radio" name="tax"
                                                        id="tax2" value="11" checked />
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
                                            <h5 id="tax-label">TAX</h5>
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
                                            <input type="hidden" id="tax-price-input" name="tax_price" value="0">
                                        </div>
    
                                        <div class="d-flex justify-content-center">
                                            <h5 style="width: 80%; text-align: left;" name="total" id="grand-total">RP 0
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="card-title">COST</div>
                        <br>
                        <div id="content-cost-card">
                            <button id="append-cost-card" class="btn btn-primary" type="button">Add Cost Card</button>
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
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const companySelect = document.getElementById('companySelect');
        const jobSelect = document.getElementById('jobSelect');
        const jobFormatInput = document.getElementById('jobFormat');

        function updateJobFormat() {
            // Ambil data dari dropdown
            const companyOption = companySelect.options[companySelect.selectedIndex];
            const jobOption = jobSelect.options[jobSelect.selectedIndex];
            const customerCode = companyOption.getAttribute('data-code');
            const jobCode = jobOption.value;
            const nextPrefix = jobOption.getAttribute('data-prefix');
            const date = new Date();
            const yearMonth =
                `${date.getFullYear().toString().slice(-2)}${String(date.getMonth() + 1).padStart(2, '0')}`;
            const transactionCode = `${nextPrefix}/${customerCode}-${jobCode}/${yearMonth}`;
            jobFormatInput.value = transactionCode;
        }

        jobSelect.addEventListener('change', updateJobFormat);
        updateJobFormat();
    });
</script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const companySelect = document.getElementById('companySelect');
        const jobSelect = document.getElementById('jobSelect');
        const jobFormatInput = document.getElementById('jobFormat');

        // Ambil nilai nextJobNumber dari elemen data
        const nextJobNumber = document.getElementById('jobFormat').dataset.nextJobNumber;

        function updateJobFormat() {
            const date = new Date();
            const yearMonth = `${date.getFullYear().toString().slice(-2)}${String(date.getMonth() + 1).padStart(2, '0')}`;

            // Gunakan next prefix yang diberikan dari server
            const jobNumber = nextJobNumber || `AT/${yearMonth}/0001`;
            jobFormatInput.value = jobNumber;
        }

        // Update format ketika job type berubah
        jobSelect.addEventListener('change', updateJobFormat);

        // Format awal saat halaman dimuat
        updateJobFormat();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const button = document.getElementById('append-selling-card');
        const contentArea = document.getElementById('content-selling-card');

        button.addEventListener('click', async () => {
            try {
                const response = await fetch('/subview-selling-card');
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                const html = await response.text();
                contentArea.insertAdjacentHTML('beforeend', html);
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to load content.');
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const button = document.getElementById('append-cost-card');
        const contentArea = document.getElementById('content-cost-card');

        button.addEventListener('click', async () => {
            try {
                const response = await fetch('/subview-cost-card');
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                const html = await response.text();
                contentArea.insertAdjacentHTML('beforeend', html);
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to load content.');
            }
        });
    });
</script>

@include('transaction/modal-cart')
@include('transaction/modal-cost')
@include('transaction/modal-ubah')
@include('transaction/modal-ubah-cost')
@include('transaction/cart')
@include('transaction/cost')
@endSection