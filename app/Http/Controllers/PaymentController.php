<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Http\Controllers\Midtrans\Config;
use App\Http\Controllers\Midtrans\CoreApi;
use App\Models\Tiket;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
// use App\Http\Middleware\Event;
use App\Models\Pay;
use App\Veritrans\Veritrans;
use App\Models\Detail_transaksi;
use App\Models\EventBooking;
use App\Models\EventCamping;
use App\Models\Detail_booking;
use App\Models\Detail_camp;
use App\Models\Event;
use App\Models\ReviewEvent;
use App\Models\ReviewVilla;
use App\Models\Kegiatan;
use App\Models\ReviewTempatSewa;
use App\Models\TempatSewa;
use App\Models\Villa;
use App\Models\BookingPaket;

class PaymentController extends Controller
{
    public $snapToken;
    public $tiket;
    public $va_number, $gross_amount, $bank, $transaction_status, $deadline;
    public function __construct()
    {
        Veritrans::$serverKey = 'SB-Mid-server-OLGi2F3Pcf_ivfQla_Qf59kG';
        Veritrans::$isProduction = false;
    }
    public function index()
    {

        return view('payments');
    }


    public function bankTransferCharge(Request $req)
    {
        try {
        } catch (\Exception $e) {
        }
    }

    // public function createGopay()
    // {

    //     \Midtrans\Config::$serverKey = 'SB-Mid-server-9BhJU4me3y9Nvef7ZESlQJSU';
    //     \Midtrans\Config::$isProduction = false;
    //     $external_id = 'gopay' . time();
    //     $params = array(
    //         'transaction_details' => array(
    //             'order_id' => $external_id,
    //             'gross_amount' => 500000,
    //         ),
    //         'payment_type' => 'gopay',
    //         'gopay' => array(
    //             'enable_callback' => false,
    //             'callback_url' => ''
    //         )
    //     );
    //     $res = \Midtrans\CoreApi::charge($params);
    //     return response()->json([
    //         'data' => $Res
    //     ]);
    // }

    // public function TopUp()
    // {
    //     return view('topup.topup');
    // }

    public function bayar(Request $request, $id)
    {

        // dd($request);
        if (!Auth::user()) {
            return redirect('login');
        }

        // dd($snapToken);
        $snapToken = 0;
        $tiket = Tiket::find($id);
        // dd($tiket);

        // dd($request);
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-OLGi2F3Pcf_ivfQla_Qf59kG';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        if (!Tiket::find($id) == null) {
            $tiket = Tiket::find($id);

            $bayar = $tiket->harga;
            $kode = $tiket->kode;
        } else {
            $result = $request->input('result_data');
            $result = json_decode($result);
            // dd($request);
            // dd($result);
            if ($result->status_code = "409") {
                return redirect()->back();
            }
            $tiket = Tiket::where('kode', $result->order_id)->first();
            $tiket->status = 1;
            $tiket->save();
            if ($result->payment_type == "bank_transfer") {
                Pay::create([
                    'id' => $result->order_id,
                    'status_message' => $result->status_message,
                    'order_id' => $result->order_id,
                    'payment_type' => $result->payment_type,
                    'transaction_time' => $result->transaction_time,
                    'transaction_status' => $result->transaction_status,
                    'va_bank' => $result->va_numbers[0]->bank,
                    'va_number' => $result->va_numbers[0]->va_number,
                    'kodeku' => $result->order_id
                ]);
                $tiket = Tiket::where('kode', $result->order_id)->first();
                $tiket->check = $result->status_message;
                $tiket->save();
            }
            if ($result->payment_type == "qris") {
                Pay::create([
                    'id' => $result->order_id,
                    'status_message' => $result->status_message,
                    'order_id' => $result->order_id,
                    'payment_type' => $result->payment_type,
                    'transaction_time' => $result->transaction_time,
                    'transaction_status' => $result->transaction_status,
                    'va_bank' => null,
                    'va_number' => null,
                    'kodeku' => $result->order_id
                ]);
                $tiket = Tiket::where('kode', $result->order_id)->first();
                $tiket->check = $result->status_message;
                $tiket->save();
            }
            // dd($tiket);

            // MERAPIKAN KODINGAN INI !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! DIBAWAH INI

            try {

                //return redirect($vtweb_url);

            } catch (Exception $e) {

                return $e->getMessage;
            }
            $result = $request->input('result_data');
            $result = json_decode($result);
            if ($result == null) {
                // dd($request);
                $data = $request->all();
                Pay::create($data);
                dd($data);
                return redirect()->back();
            } else {
                if ($result->status_code = "404") {
                    return redirect()->route('pesananku');
                }

                // if ($result->status_code = "406") {
                //     return redirect()->route('pesananku');
                // }
                $kode = $result->order_id;
                $vt = new Veritrans;
                $trans = $vt->status($kode);
                $tiket = Tiket::where('kode', $kode)->first();
                $tiket->status = $result->transaction_status;
                $tiket->save;




                // dd($trans);
                if ($trans->transaction_status == "pending") {
                    $setelmen_timee = "0";
                } else {
                    if ($trans->settlement_time == null) {
                        $setelmen_timee = "0";
                    } else
                        $setelmen_timee = $trans->settlement_time;
                }


                $statuse = $trans->transaction_status;
                if ($result->payment_type == "qris") {
                    $transaction_status = $result->status_message;
                    $transaction_id = $result->transaction_id;
                    $gross_amount = $result->gross_amount;
                    $transaction_status = $result->status_message;
                    $transaction_time = $result->transaction_time;
                    $nomor = "0";
                    $va_bank = "0";
                    $va_number = "0";
                    $bank = $trans->acquirer;
                    $deadline = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($transaction_time)));
                    return view('bayar_proses', compact('kode', 'result', 'transaction_id', 'setelmen_timee', 'va_number', 'statuse', 'nomor', 'bank', 'tiket', 'gross_amount', 'transaction_status', 'transaction_time', 'deadline'));
                }
                if ($result->payment_type == "bank_transfer") {
                    $va_bank = $result->va_numbers[0]->bank;
                    $va_number = $result->va_numbers[0]->va_number;
                    $bank = $result->va_numbers[0]->bank;
                    $gross_amount = $result->gross_amount;
                    $nomor = $result->bca_va_number;
                    $transaction_id = $result->transaction_id;
                    // dd($transaction_id);
                    $transaction_status = $result->status_message;
                    $transaction_time = $result->transaction_time;
                    $deadline = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($transaction_time)));

                    return view('bayar_proses', compact('kode', 'result', 'transaction_id', 'setelmen_timee', 'va_number', 'statuse', 'nomor', 'bank', 'tiket', 'gross_amount', 'transaction_status', 'transaction_time', 'deadline'));
                }
            }
            //============================================ Sampai Ini
        }



        $belanja = Tiket::find($id);
        if (!empty($tiket)) {
            if ($tiket->status == 0) {
                //=====
                $params = array(
                    'transaction_details' => array(
                        // 'order_id' => rand(),
                        'order_id' => $kode,
                        'gross_amount' => $bayar,
                    ),
                    'customer_details' => array(
                        'first_name' => 'An.',
                        'last_name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'phone' => Auth::user()->telp,
                    ),
                );

                try {

                    $snapToken = \Midtrans\Snap::getSnapToken($params);

                    // dd($snapToken);
                } catch (Exception $e) {
                    // dd($params);
                    $kodeee = $params['transaction_details']['order_id'];
                    return redirect()->route('bayar_status', [$kodeee]);
                }
                // dd($params);

            } else if ($tiket->status == 1) {
            }
        }
        // $snapToken = \Midtrans\Snap::getSnapToken($params);

        // dd($params);

        // $kode23 = $tiket->kode;
        // dd($request);
        // return redirect()->route('bayar_status', [$kode23]);
        return view('bayar', compact('snapToken', 'tiket'));
    }

    public function finish(Request $request)
    {

        $result = $request->input('result_data');
        $result = json_decode($result);
        dd($result);
        // $result = json_decode($resul);
        $kode = $result->order_id;

        $tiket = Tiket::where('kode', $kode)->first();
        $tiket->status = $result->transaction_status;
        dd($result);
        $tiket->save;

        $vt = new Veritrans;

        $trans = $vt->status($kode);

        $statuse = $trans->transaction_status;
        if ($result->va_numbers[0]->bank == null) {
            dd($result);
        } else {
            $bank = $result->va_numbers[0]->bank;
            $gross_amount = $result->gross_amount;
            $nomor = $result->bca_va_number;
            $transaction_status = $result->transaction_status;
            $transaction_time = $result->transaction_time;
            $deadline = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($transaction_time)));

            return view('bayar_proses', compact('statuse', 'nomor', 'bank', 'tiket', 'gross_amount', 'transaction_status', 'transaction_time', 'deadline'));
        }
    }
    public function status($kode)
    {
        $order_id = $kode;
        // dd($kode);
        $tiket = Tiket::where('kode', $kode)->first();
        if (!Auth::user()) {
            return redirect('login');
        }
        if (Auth::user()->id == $tiket->user_id) {
            $vt = new Veritrans;
            $trans = $vt->status($order_id);

            $payy = Pay::where('kodeku', $kode)->first();

            // dd($trans);
            if ($trans->transaction_status == "pending") {
                $setelmen_timee = "0";
            } elseif ($trans->transaction_status == "expire") {
                $setelmen_timee = "1";
            } elseif ($trans->transaction_status == "cancel") {
                $setelmen_timee = "1";
            } else {
                // dd($trans);
                $setelmen_timee = $trans->settlement_time;
            }
            // dd($trans);
            if ($trans->payment_type == "bank_transfer") {
                $statuse =  $trans->transaction_status;
                $bank = $trans->va_numbers[0]->bank;
                $gross_amount = $trans->gross_amount;
                // dd($trans);
                $va_number = $trans->va_numbers[0]->va_number;

                $transaction_id = $trans->transaction_id;
                $result = $trans;
                $kode = $trans->order_id;
                $transaction_status = $trans->transaction_status;
                $transaction_time = $trans->transaction_time;
                $deadline = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($transaction_time)));
                return view('bayar_update', compact('setelmen_timee', 'kode', 'result', 'transaction_id', 'va_number', 'trans', 'statuse', 'bank', 'tiket', 'gross_amount', 'transaction_status', 'transaction_time', 'deadline'));
            } else {
                $setelmen_timee = $trans->transaction_time;
                $transaction_time = $trans->transaction_time;
                $kode = $trans->order_id;
                $bank = $trans->payment_type;
                $statuse =  $trans->transaction_status;
                $gross_amount = $trans->gross_amount;
                $transaction_status = $trans->transaction_status;
                $transaction_id =  $trans->order_id;
                $result = $trans;
                $va_number = "0";
                $deadline = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($transaction_time)));
                return view('bayar_update', compact('setelmen_timee', 'kode', 'result', 'transaction_id', 'va_number', 'trans', 'statuse', 'bank', 'tiket', 'gross_amount', 'transaction_status', 'transaction_time', 'deadline'));
            }
        } else {
            return redirect()->back();
        }



        $bank = $result->va_numbers[0]->bank;
        // dd($bank);
        $gross_amount = $result->gross_amount;
        $nomor = $result->bca_va_number;
        $transaction_status = $result->transaction_status;
        $transaction_time = $result->transaction_time;
        $deadline = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($transaction_time)));
        // var_dump($result);
        return view('bayar_proses', compact('statuse', 'nomor', 'bank', 'tiket', 'gross_amount', 'transaction_status', 'transaction_time', 'deadline'));
    }

    public function astatus($kode)
    {
        $order_id = $kode;
        // dd($kode);
        $tiket = Tiket::where('kode', $kode)->first();
        if (!Auth::user()->role_id = '1') {
            return redirect('login');
        }

        $vt = new Veritrans;
        $trans = $vt->status($order_id);

        $payy = Pay::where('kodeku', $kode)->first();

        // dd($trans);
        if ($trans->transaction_status == "pending") {
            $setelmen_timee = "0";
        } elseif ($trans->transaction_status == "expire") {
            $setelmen_timee = "1";
        } elseif ($trans->transaction_status == "cancel") {
            $setelmen_timee = "1";
        } else {
            // dd($trans);
            $setelmen_timee = $trans->settlement_time;
        }
        // dd($trans);
        if ($trans->payment_type == "bank_transfer") {
            $statuse =  $trans->transaction_status;
            $bank = $trans->va_numbers[0]->bank;
            $gross_amount = $trans->gross_amount;
            // dd($trans);
            $va_number = $trans->va_numbers[0]->va_number;

            $transaction_id = $trans->transaction_id;
            $result = $trans;
            $kode = $trans->order_id;
            $transaction_status = $trans->transaction_status;
            $transaction_time = $trans->transaction_time;
            $deadline = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($transaction_time)));

            return view('bayar_update', compact('setelmen_timee', 'kode', 'result', 'transaction_id', 'va_number', 'trans', 'statuse', 'bank', 'tiket', 'gross_amount', 'transaction_status', 'transaction_time', 'deadline'));
        } else {
            $setelmen_timee = $trans->transaction_time;
            $transaction_time = $trans->transaction_time;
            $kode = $trans->order_id;
            $bank = $trans->payment_type;
            $statuse =  $trans->transaction_status;
            $gross_amount = $trans->gross_amount;
            $transaction_status = $trans->transaction_status;
            $transaction_id =  $trans->order_id;
            $result = $trans;
            $va_number = "0";
            $deadline = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($transaction_time)));

            return view('bayar_update', compact('setelmen_timee', 'kode', 'result', 'transaction_id', 'va_number', 'trans', 'statuse', 'bank', 'tiket', 'gross_amount', 'transaction_status', 'transaction_time', 'deadline'));
        }




        $bank = $result->va_numbers[0]->bank;
        dd($bank);
        $gross_amount = $result->gross_amount;
        $nomor = $result->bca_va_number;
        $transaction_status = $result->transaction_status;
        $transaction_time = $result->transaction_time;
        $deadline = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($transaction_time)));
        // var_dump($result);
        return view('bayar_proses', compact('statuse', 'nomor', 'bank', 'tiket', 'gross_amount', 'transaction_status', 'transaction_time', 'deadline'));
    }
    public function store(Request $request)
    {
        dd($request);
        $data = $request->all();
        // dd($data);
        // $pays = Pay::where('kodeku', $request->kodeku)->first();

        $kode = $request->kodeku;
        // dd($kode);
        if (
            Pay::where('kodeku', $kode)
            ->exists()
        ) {

            $pay = Pay::where('kodeku', $kode);

            $data = $request->all();
            $pay->update($data);
            $detail = Detail_transaksi::where('kode_tiket', $kode)->get();
            return redirect()->back();
        } else {
            dd($data);
            $tiket = Tiket::where('kode', $kode)->first();
            $tiket->status = 1;
            $tiket->save();
            // dd($tiket);
            Pay::create($data);
            return redirect()->route('pesananku');
            // dd($request);
        }
    }
    public function update(Request $request, $kode)
    {
        $data = $request->all();
        $pays = Pay::where('kodeku', $request->kodeku)->first();
        // dd($data);
        if ($pays == null) {
            $tiket = Tiket::where('kode', $request->kodeku)->first();
            $tiket->status = 1;
            $tiket->save();
            $data['id'] = $request->kodeku;
            // $data['tran'] = $request->kodeku;
            Pay::create($data);
            return redirect()->route('pesananku');
        } else {
            $kode = $pays->kodeku;
            if (
                Pay::where('kodeku', $kode)
                ->exists()
            ) {

                $pay = Pay::where('kodeku', $kode);
                $data = $request->all();
                $pay->update($data);

                // dd($request);
                $tiket = Tiket::where('kode', $request->order_id)->first();
                $tiket->check = $request->status_message;
                $tiket->save();
                if ($request->status_message == "settlement") {
                    $detail = Detail_transaksi::where('kode_tiket', $request->order_id)->first();
                    $detail->status = 1;
                    $detail->save();
                    if ($detail->kategori == "events") {
                        $eventkeg = Event::where('id', $detail->id_produk)->first();
                        $kode_event = $detail->id_produk;

                        if ($eventkeg->kapasitas_akhir >= $eventkeg->kapasitas_awal) {
                            return redirect()->route('pesananku');
                        }
                        $eventkeg->kapasitas_akhir += (int)$detail->jumlah;
                        $eventkeg->save();

                        $review = new ReviewEvent();
                        $review->kode_tiket = $detail->kode_tiket;
                        $review->save();


                        if ($eventkeg->kapasitas_akhir < $eventkeg->kapasitas_awal) {

                            $belumbayar = Detail_transaksi::where('id_produk', $kode_event)->where('status', '!=', 1)->get();
                            if (!$belumbayar == null) {
                                foreach ($belumbayar as $key => $dt) {
                                    $tic = $dt->kode_tiket;
                                    $tiket = Tiket::where('kode', $tic)->first();
                                    if (!$tiket == null) {
                                        $tiket->delete();
                                    }
                                    $dtdelete = $dt->delete();
                                }
                            }
                        }
                        return redirect()->route('pesananku');
                    }

                    if ($detail->kategori == "villa") {
                        $villa = Villa::where('id', $detail->id_produk)->first();
                        $id_villa = $detail->id_produk;

                        $review = new ReviewVilla();
                        $review->kode_tiket = $detail->kode_tiket;
                        $review->save();

                        $belumbayar = Detail_transaksi::where('id_produk', $id_villa)->where('status', '!=', 1)->get();
                        if (!$belumbayar == null) {
                            foreach ($belumbayar as $key => $dt) {
                                $tic = $dt->kode_tiket;
                                $tiket = Tiket::where('kode', $tic)->first();
                                if (!$tiket == null) {
                                    $tiket->delete();
                                }
                                $dtdelete = $dt->delete();
                            }
                        }
                        return redirect()->route('pesananku');
                    }
                    if ($detail->kategori == "tempat sewa") {
                        $tempatsewa = TempatSewa::where('id', $detail->id_produk)->first();
                        $id_tempatsewa = $detail->id_produk;

                        $review = new ReviewTempatSewa();
                        $review->kode_tiket = $detail->kode_tiket;
                        $review->save();

                        $belumbayar = Detail_transaksi::where('id_produk', $id_tempatsewa)->where('status', '!=', 1)->get();
                        if (!$belumbayar == null) {
                            foreach ($belumbayar as $key => $dt) {
                                $tic = $dt->kode_tiket;
                                $tiket = Tiket::where('kode', $tic)->first();
                                if (!$tiket == null) {
                                    $tiket->delete();
                                }
                                $dtdelete = $dt->delete();
                            }
                        }
                        return redirect()->route('pesananku');
                    }

                    $eventbooking = EventBooking::where('kode_tiket', $request->order_id)->get();
                    // dd($eventbooking);
                    if (!$eventbooking == null) {
                        foreach ($eventbooking as $eb => $evbo) {
                            $evbo->title = "Booked";
                            $evbo->save();

                            $kamar_id = $evbo->kamar_id;
                            $tempat_id = $evbo->tempat_id;
                            $tgl = $evbo->date;
                            $ebl = EventBooking::where('kamar_id', $kamar_id)->where('tempat_id', $tempat_id)->where('date', $tgl)->where('kode_tiket', '!=', $request->order_id)->get();
                            // $eb2 = EventCamping::where('kamar_id', $kamar_id)->where('tempat_id', $tempat_id)->where('date', $tgl)->where('kode_tiket', '!=', $request->order_id)->get();
                            // dd($ebl);
                            if (!$ebl == null) {
                                foreach ($ebl as $ebl => $evbol) {
                                    $evbol->title = "Cancel";
                                    $evbol->save();
                                    $kode_evboll = $evbol->kode_tiket;

                                    $tiket = Tiket::where('kode', $kode_evboll)->first();
                                    // dd($tiket);
                                    if (!$tiket == null) {
                                        $tiket->delete();
                                    }
                                    $dt = Detail_transaksi::where('kode_tiket', $kode_evboll)->get();
                                    // dd($dt);
                                    if (!$dt == null) {
                                        foreach ($dt as $key => $dt) {
                                            // dd($dt);
                                            $dtdelete = $dt->delete();
                                        }
                                    }

                                    $db = Detail_booking::where('kode_tiket', $kode_evboll)->get();
                                    // dd($db);
                                    if (!$db == null) {
                                        foreach ($db as $key => $db) {
                                            $dtdelete = $db->delete();
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $eventcamping = EventCamping::where('kode', $request->order_id)->get();
                    if (!$eventcamping == null) {
                        foreach ($eventcamping as $ec => $evbo) {
                            $evbo->title = "Booked";
                            $evbo->save();
                            $camp_id = $evbo->camp_id;
                            $tempat_id = $evbo->tempat_id;
                            $tgl = $evbo->date;
                            // $ebl = EventBooking::where('kamar_id', $kamar_id)->where('tempat_id', $tempat_id)->where('date', $tgl)->where('kode_tiket', '!=', $request->order_id)->get();
                            $eb2 = EventCamping::where('camp_id', $camp_id)->where('tempat_id', $tempat_id)->where('date', $tgl)->where('kode', '!=', $request->order_id)->get();
                            // dd($ebl);
                            if (!$eb2 == null) {
                                foreach ($eb2 as $eb2 => $evbol) {
                                    $evbol->title = "Cancel";
                                    $evbol->save();
                                    $kode_evboll = $evbol->kode;

                                    $tiket = Tiket::where('kode', $kode_evboll)->first();
                                    // dd($tiket);
                                    if (!$tiket == null) {
                                        $tiket->delete();
                                    }
                                    $dt = Detail_transaksi::where('kode_tiket', $kode_evboll)->get();
                                    // dd($dt);
                                    if (!$dt == null) {
                                        foreach ($dt as $key => $dt) {
                                            // dd($dt);
                                            $dtdelete = $dt->delete();
                                        }
                                    }

                                    $db = Detail_camp::where('kode_tiket', $kode_evboll)->get();
                                    // dd($db);
                                    if (!$db == null) {
                                        foreach ($db as $key => $db) {
                                            $dtdelete = $db->delete();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                // if ($data->transaction_status == "settlement")
                $tiket = Tiket::where('user_id', Auth::user()->id)->orderby('id', 'desc')->get();
                return redirect()->route('pesananku');
            } else {
                Pay::create($data);

                return redirect()->route('pesananku');
                // dd($request);
            }
        }
    }
    public function cancel($kode)
    {
        // dd($kode);

        $vt = new Veritrans;
        $tiket = Tiket::where('user_id', Auth::user()->id)->orderby('id', 'desc')->get();
        $dt = Detail_transaksi::where('kode_tiket', $kode)->get();
        // dd($dt);
        foreach ($dt as $key => $detail) {

            $detail->status = 0;
            $detail->save();
        }
        $pay = Pay::where('order_id', $kode)->first();
        $pay->transaction_status = "cancel";
        $pay->save();

        $cancel = $vt->cancel($kode);

        return redirect()->back();
    }
    public function pesananku()
    {
        if (Auth::user()->status == '1') {
            $tiket = Tiket::where('user_id', Auth::user()->id)->orderby('status', 'desc')->get();
            $pakets = BookingPaket::where('email', Auth::user()->email)->orderby('id', 'desc')->get();
            return view('pesanan.semuapesanan', compact('tiket', 'pakets'));
        }
        return view('error');
    }
    public function pesananku_detail($kode)
    {
        if (Auth::user()->status == '1') {


            $desc = Detail_transaksi::where('kode_tiket', $kode)->get();
            $des = Detail_transaksi::where('kode_tiket', $kode)->first();
            $tiket = Tiket::where('kode', $kode)->first();
            return view('pesanan.detailpesanan', compact('desc', 'tiket', 'des'));
        }


        return view('error');
    }
}