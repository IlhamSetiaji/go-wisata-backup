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

        <title>Invoice</title>

        <link rel='stylesheet' type='text/css' href='{{ asset('vendor/edit/css/style.css') }}' />


    </head>


    <body>

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
                    An. {{ substr(App\Models\User::where('id', $tiket->user_id)->pluck('name')->first(),0,50) }}
                    <br>
                    Email : {{ $tiket->email }}
                    <br>
                    Telp : {{ substr(App\Models\User::where('id', $tiket->user_id)->pluck('telp')->first(),0,20) }}
                    <br>
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
                    {!! QrCode::encoding('UTF-8')->size(150)->generate($tiket->kode) !!}

                </div>

                <table id="items">
                    <tr>
                        <th colspan="2">Item</th>
                        <th>Quantity</th>
                        <th>Harga</th>
                        <th>Total</th>
                    </tr>
                    <tr class="item-row">

                        <td class="description" colspan="2">{{ $dt->name }}</td>
                        <td align="center">{{ $dt->jumlah }} orang</td>
                        <td align="center"><span class="price"> Rp.
                                {{ number_format($dt->harga / $dt->jumlah) }}</span></td>
                        <td><span class="price"> Rp. {{ number_format($dt->harga) }}</span></td>

                    </tr>
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
                        <td colspan="2" class="total-line">
                            @if ($tiket->type_bayar == 'Epay')
                                (Via Epay)
                            @endif
                        </td>
                        <td class="total-value">
                            <textarea id="paid">Rp. {{ number_format($tiket->harga) }} 
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="blank"> </td>
                        <td colspan="2" class="total-line">
                            @if ($tiket->type_bayar == 'Epay')
                                (Via Epay)
                            @endif
                        </td>

                        <td class="total-value">
                            <textarea id="paid">Terbayar 
                            </textarea>
                        </td>
                    </tr>
                    <tr id="hiderow">
                        <td align="center" colspan="5"><b> Detail Peserta</b></td>
                    </tr>
                    <tr>
                        <th colspan="5">Kode Peserta</th>
                        {{-- <th>Nama</th>
                        <th>Email</th>
                        <th>Telp</th> --}}
                    </tr>
                    @foreach (App\Models\PesertaEvent::where('kode_booking', $dt->booking_id)->get() as $p)
                        <tr class="item-row">
                            <td class="description" colspan="5">{{ $p->kode_peserta }} </br>
                                {{-- {!! QrCode::encoding('UTF-8')->size(150)->generate($p->kode_peserta) !!} --}}
                            </td>
                            {{-- <td align="center">{{ $p->nama_peserta }}</td>
                            <td align="center">{{ $p->email }}</td>
                            <td align="center">{{ $p->telp }}</td> --}}
                        </tr>
                    @endforeach
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
