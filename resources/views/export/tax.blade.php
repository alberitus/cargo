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

        .periode {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            margin: 20px 0;
        }

        .total-row td {
            font-weight: bold;
            background-color: #f0f0f0;
        }

        .filter-info {
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <main>
        <div class="header"></div>
        <div class="title">
            <h1>PT. AYUTRANS</h1>
            <h2>
                @if(request('filter') == 'no')
                    INVOICE WITHOUT TAX REPORT
                @else
                    TAX REPORT
                @endif
            </h2>
            <div class="periode">Periode: {{ date('F Y') }}</div>
        </div>

        <table class="border-table">
            <thead>
                <tr>
                    <th>No. SERI FAKTUR</th>
                    <th>CUSTOMER NAME</th>
                    <th>TAX</th>
                    <th>TRANSACTION DATE</th>
                    <th>AMOUNT</th>
                </tr>
            </thead>
            <tbody>
                @php $totalAmount = 0; @endphp
                @foreach ($transaction as $odr)
                    @foreach ($odr->transactionDetails as $detail)
                    @php $totalAmount += $detail->tax_Price; @endphp
                        <tr>
                            <td>{{ $odr->transaction_id }}</td>
                            <td>{{ $odr->company_name }}</td>
                            <td>
                                @if($detail->tax > 0)
                                    {{ $detail->tax }}%
                                @else
                                    No Tax
                                @endif
                            </td>
                            <td>{{ $odr->created_at->format('d-m-y') }}</td>
                            <td style="text-align: right">
                                {{ 'Rp ' . number_format($detail->tax_price, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                @endforeach
                <tr class="total-row">
                    <td colspan="4" style="text-align: right">Total Amount:</td>
                    <td style="text-align: right">
                        {{ 'Rp ' . number_format($totalAmount, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
</body>
</html>