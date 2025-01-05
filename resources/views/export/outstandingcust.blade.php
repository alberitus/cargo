<!DOCTYPE html>
<html>
<head>
    <style>
        .title {
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
        }

        .left {
            text-align: left;
        }

        .right {
            text-align: right;
        }

        .border-table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            text-align: center;
            font-size: 12px;
            margin-bottom: 20px;
        }

        .header {
            background-color: #5ce65c;
        }

        .border-table th {
            border: 1px solid #000;
            background-color: #e1e3e9;
            font-weight: bold;
            padding: 5px;
        }

        .border-table td {
            border: 1px solid #000;
            padding: 5px;
        }

        .company-section {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }

        .company-title {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .periode {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            margin: 20px 0;
        }

        .total-row td {
            font-weight: bold;
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <main>
        <div class="header"></div>
        <div class="title">
            <h1>PT. AYUTRANS</h1>
            <h2>OUTSTANDING INVOICE</h2>
            <div class="periode">Periode Bulan January 2024 s/d December 2024</div>
        </div>

        @foreach($transactions as $companyName => $companyTransactions)
        @php
            $companyTotal = 0;
        @endphp
        <div class="company-section">
            <div class="company-title">OUTSTANDING {{ $companyName }}</div>
            <table class="border-table">
                <thead>
                    <tr>
                        <th rowspan="2">Date</th>
                        <th rowspan="2">Invoice ID</th>
                        <th rowspan="2">Shipper</th>
                        <th rowspan="2">MAWB</th>
                        <th colspan="2" style="text-align: center">Amount</th>
                        <th rowspan="2">Due Date</th>
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
                        <td style="text-align: right">{{ 'Rp ' . number_format($transaction->grand_total, 0, ',', '.') }}</td>
                        <td>{{ $transaction->date_payment }}</td>
                    </tr>
                    @php
                        $companyTotal += $transaction->grand_total;
                    @endphp
                    @endforeach
                    @endforeach
                    <tr class="total-row">
                        <td colspan="5" style="text-align: right">Total Amount:</td>
                        <td style="text-align: right">{{ 'Rp ' . number_format($companyTotal, 0, ',', '.') }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endforeach
    </main>
</body>
</html>