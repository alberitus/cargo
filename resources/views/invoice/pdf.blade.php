<!DOCTYPE html>
<html>
<head>
    <!--- Berisi CSS --->
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

        .header{
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

        .clean-table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            text-align: center;
            font-size: 12px;
        }

        .clean-table th {
            font-weight: bold;
        }

        .clean-table td {
            font-weight: bold;
        }

        .form-table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            text-align: center;
            font-size: 12px;
        }

        .total {
            display: flex;
            /* Menggunakan flexbox untuk mengatur posisi */
            justify-content: space-between;
            /* Mengatur item di antara dua sisi */
            margin-top: 10px;
            /* Jarak atas */
            font-size: 14px;
            /* Ukuran font untuk total */
            font-weight: bold;
            /* Menebalkan teks total */
            width: calc(100% - 20px);
            /* Menjaga lebar penuh dengan margin */
        }

        .total-label {
            text-align: right;
            margin-right: 50px;
        }
    </style>
</head>

<body>
    <main>
        <div class="header"></div>
        <div class="title">
            <h1>PT. ANDIMA TRANSPORTINDO</h1>
            <h5>Jl. nama jalan</h5>
            <h6>example@email.com</h6>
        </div>
        <div>
            <table class="form-table">
                @foreach($transaction->orders as $order)
                    <tr>
                        <td width="19%" class="left">CUSTOMER</td>
                        <td width="25%" class="left">: {{ $transaction->company_name }}</td>
                    </tr>
                    <tr>
                        <td width="19%" class="left">JOB NO</td>
                        <td width="25%" class="left">: {{ $order->job_no }}</td>
                    </tr>
                    <tr>
                        <td width="19%" class="left">FLIGHT / DATE</td>
                        <td width="25%" class="left">: {{ $order->flight_date }}</td>
                    </tr>
                    <tr>
                        <td width="19%" class="left">MAWB NO</td>
                        <td width="25%" class="left">: {{ $order->mawb }}</td>
                    </tr>
                    <tr>
                        <td width="19%" class="left">DESTINATION</td>
                        <td width="25%" class="left">: {{ $order->destination }}</td>
                    </tr>
                    <tr>
                        <td width="19%" class="left">HAWB NO</td>
                        <td width="25%" class="left">: {{ $order->hawb }}</td>
                    </tr>
                    <tr>
                        <td width="19%" class="left">JOB REF</td>
                        <td width="25%" class="left">: {{ $order->job_ref }}</td>
                    </tr>
                    <tr>
                        <td width="19%" class="left">DETAIL</td>
                        <td width="25%" class="left">: {{ $order->detail }}</td>
                    </tr>
                @endforeach
            </table>
            <div><br></div>
            <table class="border-table">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Item</th>
                        <th width="20%">Harga</th>
                        <th width="20%">QTY</th>
                        <th width="25%">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                    $no = 1;
                    $total = 0;
                    @endphp
                    @foreach($transaction->transactionDetails as $detail)
                    @php
                    $subtotal = $detail->price * $detail->amount;
                    $ppn = $detail->tax;
                    $total += $subtotal;
                    @endphp
                    <tr>
                        <td width="5%">{{ $no++ }}</td>
                        <td width="25%">{{ $detail->nama_item }}</td>
                        <td width="20%">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                        <td width="20%">{{ $detail->amount }}</td>
                        <td width="25%">Rp {{ number_format($detail->price * $detail->amount, 0, ',', '.') }}</td>
                    </tr>
                    
                </tbody>
            </table>
            <div calss="total">
                <table class="clean-table">
                    @php
                    $grandTotal = $total + $ppn;
                    @endphp
                    <tr>
                        <td width="70%" class="right">Total Harga</td>
                        <td width="25%">Rp {{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td width="70%" class="right">PPN 11%</td>
                        <td width="25%">Rp {{ number_format($detail->tax, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td width="70%" class="right">Grand Total</td>
                        <td width="25%">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
            </table>
            </div>
        </div>
    </main>
</body>

</html>