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
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

        <title>Bukti Pemesanan Tiket</title>

        <link rel='stylesheet' type='text/css' href='{{ asset('./vendor/edit/css/style.css') }}' />


    </head>


    <body>

        <div id="page-wrap">

            <div id="header">BUKTI PEMESANAN TIKET</div>
            <div id="identity">



                <div style="clear:both"></div>

                <div id="customer">

                    <div id="customer-title">GoWisata.
                        {{-- <p align="right>{!! QrCode::generate($tiket->kode); !!} </p> --}}
                    </div>
                    <br>
                    <br>
                    An. {{ substr(App\Models\User::where('id', $tiket->user_id)->pluck('name')->first(),0,10) }}
                    <br>
                    Email : {{ $tiket->email }}
                    <br>
                    Telp : {{ substr(App\Models\User::where('id', $tiket->user_id)->pluck('telp')->first(),0,15) }}
                    <br>


                    <table id="meta">

                        <tr>
                            <td class="meta-head">Invoice #</td>
                            <td>{{ $tiket->kode }}</td>
                        </tr>
                        <tr>

                            <td class="meta-head">Date</td>
                            <td>{{ substr(App\Models\detail_transaksi::where('kode_tiket', $tiket->kode)->pluck('tanggal_a')->first(),0,10) }}
                            </td>
                        </tr>

                        <tr>
                            <td class="meta-head">Amount Due</td>
                            <td>
                                <div class="due">Rp. {{ number_format($tiket->harga) }}</div>
                            </td>
                        </tr>

                    </table>

                </div>

                <table id="items">

                    <tr>
                        <th>Item</th>
                        <th></th>
                        <th>Unit Cost</th>
                        <th>Quantity</th>
                        <th>Sub Total</th>
                    </tr>

                    @foreach ($desc as $key => $desc)
                        <?php $unit = $desc->harga / $desc->jumlah; ?>

                        <tr class="item-row">

                            <td class="description">{{ $desc->name }}</td>
                            <td></td>
                            <td><span class="price">Rp. {{ number_format($unit) }}</span></td>
                            <td>{{ $desc->jumlah }}</td>
                            <td><span class="price"> Rp. {{ number_format($desc->harga) }}</span></td>

                        </tr>
                    @endforeach
                    <tr id="hiderow">
                        <td colspan="5"></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="blank"> </td>
                        <td colspan="2" class="total-line">Subtotal</td>
                        <td class="total-value">
                            <div id="subtotal">Rp. {{ number_format($tiket->harga) }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="blank"> </td>
                        <td colspan="2" class="total-line">Type</td>

                        <td class="total-value">
                            <textarea id="paid">Tunai</textarea>
                        </td>
                    </tr>

                    {{-- <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Balance Due</td>
		      <td class="total-value balance"><div class="due">Rp. {{ number_format($tiket->harga) }}
            </div>
            </td>
            </tr> --}}

                </table>

                <div id="terms">
                    <h5>Item yang sudah dibeli uang tidak dapat dikembalikan.</h5>
                    {{-- <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea> --}}
                </div>
                <h6><i>*nb : harap menyerahkan bukti ini ke petugas tiket agar dicek pemesanan tiketnya</i></h6>
                {{-- {!! QrCode::encoding('UTF-8')->size(200)->generate($tiket->kode); !!} --}}

            </div>

    </body>
</div>
<script>
    window.print();
</script>
{{-- <div style="text-align:center;"><a class="no-print" href="javascript:printDiv('print-area-2');"><h3>PRINT</h3></a></div> --}}

</html>
