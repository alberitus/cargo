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
        }

        .header {
            background-color: #5ce65c;
        }

        .border-table th {
            border: 1px solid #000;
            background-color: #e1e3e9;
            font-weight: bold;
        }

        .border-table td {
            border: 1px solid #000;
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
    </style>
</head>

<body>
    <main>
        <div class="header"></div>
        <div class="title">
            <h1>PT. AYUTRANS</h1>
            <h5>Jl. nama jalan</h5>
            <h6>example@email.com</h6>
        </div>

        @foreach($transactions as $companyName => $companyTransactions)
        <div class="company-section">
            <div class="company-title">{{ $companyName }}</div>
            <table class="border-table">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Invoice ID</th>
                        <th width="25%">Name</th>
                        <th width="15%">Status</th>
                        <th width="15%">Status Faktur</th>
                        <th width="20%">Faktur</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companyTransactions as $index => $transaction)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $transaction->transaction_id }}</td>
                        <td>{{ $transaction->name }}</td>
                        <td>{{ $transaction->status }}</td>
                        <td>{{ $transaction->stsfaktur }}</td>
                        <td>{{ $transaction->faktur }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    </main>
</body>
</html>