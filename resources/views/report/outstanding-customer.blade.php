@extends('layout/template')
@section('content')
<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">OUTSTANDING INVOICE</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="/"><i class="icon-home"></i></a>
            </li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="#">Tables</a></li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="#">OUTSTANDING INVOICE</a></li>
        </ul>
    </div>
    
    <div class="d-grid gap-3 d-md-flex justify-content">
        <h3>Periode Bulan January 2024 s/d December 2024</h3>
    </div>

    <div class="d-grid gap-3 d-md-flex justify-content-md-end">
        <a target="_blank" class="btn btn-primary mb-3" type="button" href="{{ route('outstandingcust.export-pdf') }}">
            <span class="btn-label">
                <i class="fa fa-print"></i>
            </span> Export PDF
        </a>
    </div>


 <!-- Form Filter -->
 <div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('report.outscust') }}" method="GET" class="mb-3">
            <div class="row align-items-end">
                <div class="col-md-4">
                    <label for="companyFilter" class="form-label">Pilih Perusahaan:</label>
                    <select name="company_name" id="companyFilter" class="form-control">
                        <option value="">Semua Perusahaan</option>
                        @foreach($allCompanies as $company)
                            <option value="{{ $company }}" {{ request('company_name') == $company ? 'selected' : '' }}>
                                {{ $company }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ route('report.outscust') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

@foreach($transactions as $companyName => $companyTransactions)
@php
    $companyTotal = 0;
@endphp
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">OUTSTANDING {{ $companyName }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row-{{ Str::slug($companyName) }}" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2">Date</th>
                                <th rowspan="2">Invoice ID</th>
                                <th rowspan="2">Shipper</th>
                                <th rowspan="2">MAWB</th>
                                <th colspan="2" class="text-center" style="width: 20%">Amount</th>
                                <th rowspan="2">Due Date</th>
                                <th rowspan="2" style="width: 10%">Action</th>
                            </tr>
                            <tr>
                                <th>USD</th>
                                <th>IDR</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companyTransactions as $transaction)
                                @foreach($transaction->orders as $detail)
                                <tr>
                                    <td>{{ $transaction->created_at->format('d-m-y') }}</td>
                                    <td>{{ $transaction->transaction_id }}</td>
                                    <td>{{ $transaction->company_name }}</td>
                                    <td>{{ $detail->mawb }}</td>
                                    <td></td>
                                    <td>{{ 'Rp ' . number_format($transaction->grand_total, 0, ',', '.') }}</td>
                                    <td>{{ $transaction->date_payment }}</td>
                                    <td>
                                        @php
                                        $encryptedId = Crypt::encryptString($transaction->transaction_id);
                                        @endphp
                                        <a href="{{ route('invoice.cetak', ['id' => $encryptedId]) }}" class="btn btn-primary btn-xs" title="view">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <form action="{{ route('invoice.delete', $transaction->transaction_id) }}" 
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
                                @php
                                    $companyTotal += $transaction->grand_total;
                                @endphp
                                @endforeach
                            @endforeach
                            <tr class="table-info">
                                <td colspan="5" class="text-end fw-bold">Total Amount:</td>
                                <td class="fw-bold">{{ 'Rp ' . number_format($companyTotal, 0, ',', '.') }}</td>
                                <td colspan="2"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
// Auto-submit form when dropdown changes
document.getElementById('companyFilter').addEventListener('change', function() {
    this.form.submit();
});

// Initialize DataTables for each company table
@foreach($transactions as $companyName => $companyTransactions)
    $('#add-row-{{ Str::slug($companyName) }}').DataTable({
        pageLength: 10,
        ordering: true,
        info: true,
        searching: true,
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            zeroRecords: "Data tidak ditemukan",
            info: "Menampilkan halaman _PAGE_ dari _PAGES_",
            infoEmpty: "Tidak ada data yang tersedia",
            infoFiltered: "(difilter dari _MAX_ total data)",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        }
    });
@endforeach
});
</script>
@endpush
@endSection
