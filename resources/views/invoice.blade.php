<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<textarea id="printing-css" style="display:none;">.no-print{display:none}</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script type="text/javascript">
    function printDiv(elementId) {
        var a = document.getElementById('printing-css').value;
        var b = document.getElementById(elementId).innerHTML;
        window.frames["print_frame"].document.title = document.title;
        window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
        window.frames["print_frame"].window.focus();
        window.frames["print_frame"].window.print();
    }
</script>

<div id="print-area-2" class="print-area">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Invoice</title>


    </head>


    <body>
        <style>
            /*
 CSS-Tricks Example
 by Chris Coyier
 http://css-tricks.com
*/

            * {
                margin: 0;
                padding: 0;
            }

            body {
                font: 14px/1.4 Georgia, serif;
            }

            #page-wrap {
                width: 650px;
                margin: 0 auto;
            }

            textarea {
                border: 0;
                font: 14px Georgia, Serif;
                overflow: hidden;
                resize: none;
            }

            table {
                border-collapse: collapse;
            }

            table td,
            table th {
                border: 1px solid black;
                padding: 5px;
            }

            #header {
                height: 15px;
                width: 100%;
                margin: 20px 0;
                background: #222;
                text-align: center;
                color: white;
                font: bold 15px Helvetica, Sans-Serif;
                text-decoration: uppercase;
                letter-spacing: 20px;
                padding: 8px 0px;
            }

            #address {
                width: 250px;
                height: 150px;
                float: left;
            }

            #customer {
                overflow: hidden;
            }

            #logo {
                text-align: right;
                float: right;
                position: relative;
                margin-top: 25px;
                border: 1px solid #fff;
                max-width: 540px;
                max-height: 100px;
                overflow: hidden;
            }

            #logo:hover,
            #logo.edit {
                border: 1px solid #000;
                margin-top: 0px;
                max-height: 125px;
            }

            #logoctr {
                display: none;
            }

            #logo:hover #logoctr,
            #logo.edit #logoctr {
                display: block;
                text-align: right;
                line-height: 25px;
                background: #eee;
                padding: 0 5px;
            }

            #logohelp {
                text-align: left;
                display: none;
                font-style: italic;
                padding: 10px 5px;
            }

            #logohelp input {
                margin-bottom: 5px;
            }

            .edit #logohelp {
                display: block;
            }

            .edit #save-logo,
            .edit #cancel-logo {
                display: inline;
            }

            .edit #image,
            #save-logo,
            #cancel-logo,
            .edit #change-logo,
            .edit #delete-logo {
                display: none;
            }

            #customer-title {
                font-size: 20px;
                font-weight: bold;
                float: left;
            }

            #meta {
                margin-top: 1px;
                width: 300px;
                float: right;
            }

            #meta td {
                text-align: right;
            }

            #meta td.meta-head {
                text-align: left;
                background: #eee;
                padding: 5px;
            }

            #meta td textarea {
                width: 100%;
                height: 20px;
                text-align: right;
            }

            #items {
                clear: both;
                width: 100%;
                margin: 30px 0 0 0;
                border: 1px solid black;
            }

            #items th {
                background: #eee;
            }

            #items textarea {
                width: 80px;
                height: 50px;
            }

            #items tr.item-row td {
                border: 0;
                vertical-align: top;
            }

            #items td.description {
                width: 300px;
            }

            #items td.item-name {
                width: 175px;
            }

            #items td.description textarea,
            #items td.item-name textarea {
                width: 100%;
            }

            #items td.total-line {
                border-right: 0;
                text-align: right;
            }

            #items td.total-value {
                border-left: 0;
                padding: 10px;
            }

            #items td.total-value textarea {
                height: 20px;
                background: none;
            }

            #items td.balance {
                background: #eee;
            }

            #items td.blank {
                border: 0;
            }

            #terms {
                text-align: center;
                margin: 20px 0 0 0;
            }

            #terms h5 {
                text-transform: uppercase;
                font: 13px Helvetica, Sans-Serif;
                letter-spacing: 10px;
                border-bottom: 1px solid black;
                padding: 0 0 8px 0;
                margin: 0 0 8px 0;
            }

            #terms textarea {
                width: 100%;
                text-align: center;
            }

            textarea:hover,
            textarea:focus,
            #items td.total-value textarea:hover,
            #items td.total-value textarea:focus,
            .delete:hover {
                background-color: #EEFF88;
            }

            .delete-wpr {
                position: relative;
            }

            .delete {
                display: block;
                color: #000;
                text-decoration: none;
                position: absolute;
                background: #EEEEEE;
                font-weight: bold;
                padding: 0px 3px;
                border: 1px solid;
                top: -6px;
                left: -22px;
                font-family: Verdana;
                font-size: 12px;
            }
        </style>
        <div id="page-wrap">

            <div id="header">INVOICE</div>
            <div id="identity">



                <div style="clear:both"></div>

                <div id="customer">

                    <div id="customer-title">GoWisata.
                        {{-- <p align="right>{!! QrCode::generate($tiket->kode); !!} </p> --}}
                    </div>
                    <br>
                    <br>
                    Atas nama : {{ $datas->name }}
                    <br>
                    Email : {{ $datas->email }}
                    <br>
                    Telp : {{ $datas->telp }}
                    <br>
                    <br>
                    <br>
                    Kode Booking : {{ $datas->kode_booking }}
                    <br>
                    Tanggal Perjalanan : {{ $datas->tanggal_perjalanan }}
                    <br>
                    {!! QrCode::encoding('UTF-8')->size(150)->generate($datas->kode_booking) !!}
                    <table id="meta">
                        <tr>
                            <td class="meta-head">Kode Booking</td>
                            <td>{{ $datas->kode_booking }}</td>
                        </tr>
                        <tr>
                            <td class="meta-head">Tanggal Perjalanan</td>
                            <td>{{ $datas->tanggal_perjalanan }}</td>
                        </tr>
                    </table>
                </div>

                <table id="items">

                    <tr>
                        <th colspan="2">Nama Paket</th>
                        <th>Jumlah Hari</th>
                        <th>Jumlah Orang</th>
                        <th>Total</th>
                    </tr>

                    {{--  @foreach ($desc as $key => $desc)
                        <?php $unit = $desc->harga / $desc->jumlah; ?>  --}}

                    <tr class="item-row">

                        <td class="description" colspan="2">{{ $datas->paket->nama_paket }}</td>
                        <td align="center">{{ $datas->jml_hari }} hari</td>
                        <td align="center">{{ $datas->jml_orang }} orang</td>
                        <td><span class="price"> Rp. {{ number_format($datas->total_biaya) }}</span></td>

                    </tr>
                    {{--  @endforeach  --}}
                    <tr id="hiderow">
                        <td colspan="5"></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="blank"> </td>
                        <td colspan="2" class="total-line">Subtotal</td>
                        <td class="total-value">
                            <div id="subtotal">Rp. {{ number_format($datas->total_biaya) }}</div>
                        </td>
                    </tr>

                </table>

                <div id="terms">
                    <h5>Item yang sudah dibeli uang tidak dapat dikembalikan.</h5>
                    {{-- <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea> --}}
                </div>

                {{-- {!! QrCode::encoding('UTF-8')->size(100)->generate($tiket->kode); !!} --}}
                {{-- <h5>Selamat GoWisata. :)</h5> --}}
            </div>

    </body>
</div>
<script>
    window.print();
</script>
{{-- <div style="text-align:center;"><a class="no-print" href="javascript:printDiv('print-area-2');"><h3>PRINT</h3></a></div> --}}

</html>
