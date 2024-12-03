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
                    <tr>
                        <td width="19%" class ="left">CUSTOMER</td>
                        <td width="25%" class ="left">: PT. EXAMPLE</td>
                    </tr>
                    <tr>
                        <td width="19%" class ="left">JOB NO</td>
                        <td width="25%" class ="left">: 545/GEO-OB/<?= date("ym") ?></td>
                    </tr>
                    <tr>
                        <td width="19%" class ="left">FLIGHT / DATE</td>
                        <td width="25%" class ="left">: KL<?= date("my") ?></td>
                    </tr>
                    <tr>
                        <td width="19%" class ="left">MAWB NO</td>
                        <td width="25%" class ="left">: 074-02345232</td>
                    </tr>
                    <tr>
                        <td width="19%" class ="left">DESTINATION</td>
                        <td width="25%" class ="left">: FRA-CGK</td>
                    </tr>
                    <tr>
                        <td width="19%" class ="left">MAWB NO</td>
                        <td width="25%" class ="left">: -</td>
                    </tr>
                    <tr>
                        <td width="19%" class ="left">JOB NO</td>
                        <td width="25%" class ="left">: SFRAA194859</td>
                    </tr>
                    <tr>
                        <td width="19%" class ="left">DETAIL</td>
                        <td width="25%" class ="left">: 1 KOLI 35,5 KGS</td>
                    </tr>
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
                    <tr>
                        <td width="5%">1</td>
                        <td width="25%">HANDLING</td>
                        <td width="20%">Rp 140.000</td>
                        <td width="20%">1</td>
                        <td width="25%">Rp 140.000</td>
                    </tr>
                    <tr>
                        <td width="5%">2</td>
                        <td width="25%">PICK UP DOKUMEN</td>
                        <td width="20%">Rp 10.000</td>
                        <td width="20%">1</td>
                        <td width="25%">Rp 10.000</td>
                    </tr>
                </tbody>
            </table>
            <div calss="total">
            <table class="clean-table">
                    <tr>
                        <td width="70%" class ="right">Total Harga</td>
                        <td width="25%">Rp 150.000</td>
                    </tr>
                    <tr>
                        <td width="70%" class ="right">PPN 11%</td>
                        <td width="25%">Rp 16.500</td>
                    </tr>
                    <tr>
                        <td width="70%" class ="right">Grand Total</td>
                        <td width="25%">Rp 166.500</td>
                    </tr>
            </table>
            </div>
        </div>
    </main>
</body>

</html>