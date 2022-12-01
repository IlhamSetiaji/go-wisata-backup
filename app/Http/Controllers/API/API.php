<?php

namespace App\Http\Controllers\API;

use App\Models\Pay;
use App\Models\Desa;
use App\Models\User;
use App\Models\Event;
use App\Models\ListEvent;
use App\Models\Kamar;
use App\Models\Tiket;
use App\Models\Tempat;
use App\Models\Wahana;
use App\Models\Hotel;
use App\Models\Villa;
use App\Models\Kuliner;
use Illuminate\Support\Str;
use App\Models\EventBooking;
use Illuminate\Http\Request;
use App\Models\Detail_transaksi;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Penginapan;
use App\Models\MenuKuliner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class API extends Controller
{
    //Wahana
    public function tempat()
    {
        $tempat  = new Tempat();
        $tempat  = $tempat
            ->where('kategori', 'wisata')
            ->where('status', '1')
            ->get();
        foreach ($tempat as $key) {
            $key->wahana = Wahana::where('tempat_id', $key->id)->get();
        }
        $res = response()->json($tempat);
        return $res;
    }
    public function wahanabytempat($id)
    {
        $wahana  = new Wahana();
        $wahana  = $wahana
            ->where('tempat_id', $id)
            ->where('status', '1')
            ->get();
        if ($wahana->count() > 0) {
            $res = response()->json($wahana);
        } else {
            $res = response()->json(['message' => 'Data Tidak Ditemukan'], 404);
        }
        return $res;
    }
    public function wahana()
    {
        $wahana  = new Wahana();
        $wahana  = $wahana
            ->join('tb_tempat', 'tb_wahana.tempat_id', 'tb_tempat.id')
            ->select(
                '*',
                'tb_wahana.name as wahana_name',
                'tb_wahana.id as wahana_id',
                'tb_wahana.image as wahana_image',
                'tb_wahana.deskripsi as wahana_deskripsi',
                'tb_tempat.name as tempat_name',
                'tb_tempat.deskripsi as tempat_deskripsi',
                'tb_tempat.image as tempat_image'
            )
            ->get();
        return response()->json($wahana);
    }

    public function createwahana(Request $request)
    {
        if (
            $request->name == null ||
            $request->tempat_id == null ||
            $request->deskripsi == null ||
            $request->harga == null
        ) {
            return response()->json(array('data' => 'Failed create'), 401);
        }
        $wahana  = new Wahana();
        $wahana->name = $request->name;
        $wahana->tempat_id = $request->tempat_id;
        $wahana->deskripsi = $request->deskripsi;
        $wahana->harga = $request->harga;
        $wahana->image = '7Lc8xmt78n8teJXlDUgvlOrJDVSBt4BBtDhSt2Xh.jpg';
        if ($wahana->save()) {
            return response()->json(array('data' => 'Success'));
        } else {
            return response()->json(array('data' => 'Failed create'), 401);
        }
    }
    public function editwahana(Request $request)
    {
        if (
            $request->name == null ||
            $request->tempat_id == null ||
            $request->deskripsi == null ||
            $request->harga == null
        ) {
            return response()->json(array('data' => 'Failed update'), 401);
        }
        $wahana  = wahana::find($request->id);
        $wahana->name = $request->name;
        $wahana->tempat_id = $request->tempat_id;
        $wahana->deskripsi = $request->deskripsi;
        $wahana->harga = $request->harga;
        // $wahana->image = '7Lc8xmt78n8teJXlDUgvlOrJDVSBt4BBtDhSt2Xh.jpg';
        if ($wahana->save()) {
            return response()->json(array('data' => 'Success'));
        } else {
            return response()->json(array('data' => 'Failed update'), 401);
        }
    }
    public function deletewahana(Request $request)
    {
        $wahana  = Wahana::find($request->id);
        if ($wahana != null) {
            $wahana->delete();
            return response()->json(array('data' => 'Success'));
        } else {
            return response()->json(array('data' => 'Failed create'));
        }

        return response()->json($wahana);
    }
    public function kamar()
    {
        $kamar = new Kamar();
        $kamar = $kamar->get();
        return response()->json($kamar);
    }
    public function event()
    {
        $event = new EventBooking();
        $event = $event->get();
        return response()->json($event);
    }
    public function user()
    {
        $user = new User();
        $user = $user->get();
        return response()->json($user);
    }
    public function getCart(Request $request)
    {
        if ($request->id != null) {
            $cart = session('cart');
            return response()->json($cart);
        } else {
            return response()->json(['data' => 'Login First'], 401);
        }
    }
    public function addCart(Request $request)
    {
        $cart = session("cart");
        $kode = "W001";
        $request->tempat_id = 4;
        $request->durasi = 1;
        $request->kategori = "wahana";
        $produk = Wahana::where('kode_wahana', $kode)->first();
        $cart[$kode] = [
            "kode_produk" => $produk->kode,
            "kategori" => $request->kategori,
            "durasi" => "1",
            "user_id" => $request->user_id,
            "nama_produk" =>  "Tiket Wahana " . $produk->name,
            "harga_produk" => $produk->harga,
            "jumlah" => $request->jumlah,
            "count" => $request->jumlah,
            "tanggal_a" => "0",
            "tanggal_b" => "0",
            "tempat_id" => $request->tempat_id,

        ];
        // dd($cart);
        session(["cart" => $cart]);
        return response()->json(['data' => ' Berhasil menambahkan ke cart :)']);
    }
    public function getTransaksi(Request $request)
    {
        if ($request->id != null) {
            $transaksi = Detail_transaksi::where('user_id', $request->id)

                ->get();
            return response()->json($transaksi);
        } else {
            return response()->json(['data' => 'Login First'], 401);
        }
    }
    public function addTiket(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = Tiket::max('id');
        $urutan = (int)($data);
        $urutan++;
        $huruf =  "LT-";
        $checkout_kode = $huruf . $urutan . uniqid();

        $grandtotal = 0;
        $data = json_decode($request->datauser);
        if (!isset($data->user_id)) {
            return response()->json(['data' => 'Login First'], 401);
        }
        $user_id = $data->user_id;
        foreach (json_decode($request->dataproduk) as $key) {
            $kode_tiket = $checkout_kode;
            $id_produk = $key->id;
            $kategori = $key->kategori;
            $name = $key->nama;
            $durasi = "1";
            $type_bayar = "Transfer";
            $harga = $key->harga;
            $user_id = $data->user_id;
            $tanggal_a = $request->date;
            $tanggal_b = 0;
            $jumlah = $key->qty;
            $status = "0";
            $count = $key->qty;
            $tempat_id = $key->tempat_id;

            $subtotal = $harga * $jumlah * $durasi;
            $grandtotal += $subtotal;
            Detail_transaksi::tambah_detail_transaksi($name, $durasi, $user_id, $tanggal_a, $tanggal_b, $kode_tiket, $id_produk, $jumlah, $subtotal, $tempat_id, $kategori, $type_bayar, $status, $count);
        }

        Tiket::create([
            // 'token' => $token,
            'kode' => $checkout_kode,
            'user_id' => $data->user_id,
            'name' => $data->name,
            'email' => $data->email,
            'telp' => $data->telp,
            'harga' => $grandtotal,

        ]);
        return response()->json(['data' => ' Berhasil checkout :)']);
    }
    public function addTransaksi(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = Tiket::max('id');
        $urutan = (int)($data);
        $urutan++;
        $huruf =  "LT-";
        $checkout_kode = $huruf . $urutan . uniqid();

        $grandtotal = 0;
        $data = json_decode($request->datauser);
        if (!isset($data->user_id)) {
            return response()->json(['data' => 'Login First'], 401);
        }
        $user_id = $data->user_id;
        $tmp = json_decode($request->dataproduk);
        $kode_tiket = $checkout_kode;
        $id_produk = $tmp->id;
        $kategori = $tmp->kategori;
        $name = $tmp->nama;
        $durasi = "1";
        $type_bayar = "Transfer";
        $harga = $tmp->harga;
        $user_id = $data->user_id;
        $tanggal_a = $request->date;
        $tanggal_b = 0;
        $jumlah = $tmp->qty;
        $status = "0";
        $count = $tmp->qty;
        $tempat_id = $tmp->tempat_id;

        $subtotal = $harga * $jumlah * $durasi;
        $grandtotal += $subtotal;
        $tmp = [
            'user_id  :' . $user_id,
            'kategori  :' . $kategori,
            'tempat_id  :' . $tempat_id,
            'subtotal  :' . $subtotal,
            'kode_tiket  :' . $kode_tiket,
            'id_produk  :' . $id_produk,
            'jumlah  :' . $jumlah,
            'status  :' . $status,
            'count  :' . $jumlah,
            'type_bayar :' . $type_bayar,
            'name  :' . $name,
            'durasi  :' . $durasi,
            'tanggal_a  :' . $tanggal_a,
            'tanggal_b  :' . $tanggal_b,
        ];
        Detail_transaksi::tambah_detail_transaksi($name, $durasi, $user_id, $tanggal_a, $tanggal_b, $kode_tiket, $id_produk, $jumlah, $subtotal, $tempat_id, $kategori, $type_bayar, $status, $count);

        Tiket::create([
            // 'token' => $token,
            'kode' => $checkout_kode,
            'user_id' => $data->user_id,
            'name' => $data->name,
            'email' => $data->email,
            'telp' => $data->telp,
            'harga' => $grandtotal,

        ]);
        return response()->json(['data' => ' Berhasil checkout :)']);
    }
    public function getPesanan(Request $request)
    {
        if ($request->id != null) {
            $tiket = Tiket::where('user_id', $request->id)
                ->orderby('id', 'desc')
                ->get();
            // $accessToken = auth()->user()->createToken('authToken')->accessToken;
            if ($tiket->count() > 0) {
                return response()->json($tiket);
            } else {
                return response()->json(['data' => 'Tiket not found'], 404);
            }
        } else {
            return response()->json(['data' => 'Login First'], 401);
        }
    }
    public function getTiket(Request $request)
    {
        if ($request->id != null) {
            $tiket = Tiket::where('user_id', $request->id)
                ->orderby('id', 'desc')
                ->get();
            // $accessToken = auth()->user()->createToken('authToken')->accessToken;
            if ($tiket->count() > 0) {
                return response()->json($tiket);
            } else {
                return response()->json(['data' => 'Tiket not found'], 404);
            }
        } else {
            return response()->json(['data' => 'Login First'], 401);
        }
    }
    public function getTiketDetail(Request $request)
    {
        if ($request->id != null) {
            if ($request->kode != null) {
                $tiket = Detail_transaksi::where('kode_tiket', $request->kode)->get();
                if ($tiket->count() > 0) {
                    return response()->json($tiket);
                } else {
                    return response()->json(['data' => 'Tiket not found'], 404);
                }

                return response()->json($tiket);
            } else {
                return response()->json(['data' => 'Tiket not found'], 404);
            }
        } else {
            return response()->json(['data' => 'Login First'], 401);
        }
    }
    public function login(Request $request)
    {
        $login = User::where('email', $request->email)->first();
        if ($login != null) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // $token = $user->createToken($signInRequest->input('device_name'))->plainTextToken;
                // $token = $login->createToken('authToken')->accessToken;
                return response()->json(['data' => $login]);
            } else {
                return response()->json(['data' => 'Failed Login'], 401);
            }
        } else {
            return response()->json(['data' => 'Email not found'], 401);
        }
    }
    public function register(Request $request)
    {
        if (!isset($request->name) || !isset($request->email) || !isset($request->password) || !isset($request->telp)) {
            return response()->json(['data' => 'Gagal register'], 500);
        }
        $user = new User();
        // dd($request->email);
        $password = Hash::make($request->password);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password;
        $user->telp = $request->telp;
        $user->email_verified_at = date('Y-m-d H:i:s');
        try {
            if ($user->save()) {
                $login = User::where('email', $request->email)->first();
                return response()->json(['data' => $login, 'message' => 'Berhasil register']);
            }
        } catch (\Throwable $th) {

            return response()->json(['data' => 'Gagal register'], 500);
        }
    }
    // public function verify(Request $request)
    // {
    //     $verify = User::where($request->id)->first();
    //     $verify->update([
    //         'email_verified_at' => date('Y-m-d H:i:s'),
    //     ]);
    // }
    public function checkLogin()
    {
        $check = Auth::check();
        return response()->json(['data' => $check]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return response()->json(array('data' => 'Loggedout'));
    }

    //payment

    public function payment(Request $request)
    {
        \Midtrans\Config::$serverKey = 'SB-Mid-server-OLGi2F3Pcf_ivfQla_Qf59kG';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        // $transaction_details = array("id"=>"12","name"=> "testingtrx7",   "price"=> 190000,  "quantity"=> 1);
        $datauser = json_decode($request->datauser);
        $dataproduk = json_decode($request->dataproduk);
        // $items = array(
        //     array(
        //         'id'       => $dataproduk->id,
        //         'price'    => $dataproduk->harga,
        //         'quantity' => $dataproduk->qty,
        //         'name'     => $dataproduk->nama,
        //     )
        // );
        $customer_details = array(
            'first_name'       => $datauser->name,
            'email'            => $datauser->email,
            'phone'            => $datauser->telp,
        );

        $params = array(
            'transaction_details' => array(
                'order_id' => $request->kodeTransaksi,
                'gross_amount' => $request->total,
            ),
            // 'item_details'=> $items,
            'customer_details' => $customer_details
        );


        try {
            // Get Snap Payment Page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;


            // Redirect to Snap Payment Page
            return response()->json(['data' => $paymentUrl]);
            //   header('Location: ' . $paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function finish(Request $request)
    {
        \Midtrans\Config::$serverKey = 'SB-Mid-server-OLGi2F3Pcf_ivfQla_Qf59kG';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $pay = Pay::where('id', $request->id)->count();
        $status = \Midtrans\Transaction::status($request->id);
        echo var_dump($status);
        if ($pay < 1) {
            Pay::create([
                'id' => $status->order_id,
                'status_message' => $status->status_message,
                'order_id' => $status->order_id,
                'payment_type' => $status->payment_type,
                'transaction_time' => $status->transaction_time,
                'transaction_status' => $status->transaction_status,
                'va_bank' => $status->va_numbers[0]->bank,
                'va_number' => $status->va_numbers[0]->va_number,
                'kodeku' => $status->order_id
            ]);
        } else {
            if ($status->transaction_status == 'settlement') {
                $findpay = Pay::where('id', $request->id)->first();
                $findpay->transaction_status = $status->transaction_status;
                if ($findpay->save()) {
                    echo 'pay update';
                }
                $findtiket = Tiket::where('kode', $status->order_id)->first();
                $findtiket->status = '1';
                if ($findtiket->save()) {
                    echo 'tiket update';
                }
                $statustiket = Detail_transaksi::where('kode_tiket', $status->order_id)->first();
                $statustiket->status = '1';
                if ($statustiket->save()) {
                    echo 'tiket update';
                }
            }
        }
    }



    //tempat

    public function kulinershow()
    {
        $kuliner = Kuliner::where('tempat_id', '9')->where('status', '1')->get();
        return response()->json([
            'success' => true,
            'message' => 'Ambil data berhasil',
            'data' => $kuliner,
        ]);
    }

    public function kulinershow1()
    {
        $kuliner = Kuliner::where('tempat_id', '10')->where('status', '1')->get();
        return response()->json([
            'success' => true,
            'message' => 'Ambil data berhasil',
            'data' => $kuliner,
        ]);
    }

    public function kulinershow2()
    {
        $kuliner = Kuliner::where('tempat_id', '11')->where('status', '1')->get();
        return response()->json([
            'success' => true,
            'message' => 'Ambil data berhasil',
            'data' => $kuliner,
        ]);
    }

    public function kuliner()
    {
        $kuliner  = new Tempat();
        $kuliner  = $kuliner

            // ->select(
            //     '*',
            //     'tb_kuliner.name as kuliner_name',
            //     'tb_kuliner.id as kuliner_id',
            //     'tb_kuliner.image as kuliner_image',
            //     'tb_kuliner.deskripsi as kuliner_deskripsi',
            //     'tb_tempat.name as tempat_name',
            //     'tb_tempat.deskripsi as tempat_deskripsi',
            //     'tb_tempat.image as tempat_image'
            // )
            ->where('tb_tempat.kategori', 'kuliner')
            ->where('tb_tempat.status', '1')
            ->get();
        return response()->json($kuliner);
    }

    public function menukuliner($id)
    {
        $menukuliner = new MenuKuliner();
        $menukuliner = $menukuliner
            // ->join('tb_kuliner', 'tb_kuliner.tempat_id', 'tb_tempat.id')
            ->where('tempat_id', $id)
            ->where('status', '1')
            ->get();
        return response()->json($menukuliner);
    }

    public function createkuliner(Request $request)
    {
        if (
            $request->name == null ||
            $request->tempat_id == null ||
            $request->deskripsi == null ||
            $request->harga == null
        ) {
            return response()->json(array('data' => 'Failed create'), 401);
        }
        $kuliner  = new Kuliner();
        $kuliner->name = $request->name;
        $kuliner->tempat_id = $request->tempat_id;
        $kuliner->deskripsi = $request->deskripsi;
        $kuliner->harga = $request->harga;
        $kuliner->image = '7Lc8xmt78n8teJXlDUgvlOrJDVSBt4BBtDhSt2Xh.jpg';
        if ($kuliner->save()) {
            return response()->json(array('data' => 'Success'));
        } else {
            return response()->json(array('data' => 'Failed create'), 401);
        }
    }
    public function editkuliner(Request $request)
    {
        if (
            $request->name == null ||
            $request->tempat_id == null ||
            $request->deskripsi == null ||
            $request->harga == null
        ) {
            return response()->json(array('data' => 'Failed update'), 401);
        }
        $kuliner  = Kuliner::find($request->id);
        $kuliner->name = $request->name;
        $kuliner->tempat_id = $request->tempat_id;
        $kuliner->deskripsi = $request->deskripsi;
        $kuliner->harga = $request->harga;
        // $wahana->image = '7Lc8xmt78n8teJXlDUgvlOrJDVSBt4BBtDhSt2Xh.jpg';
        if ($kuliner->save()) {
            return response()->json(array('data' => 'Success'));
        } else {
            return response()->json(array('data' => 'Failed update'), 401);
        }
    }
    public function deletekuliner(Request $request)
    {
        $kuliner  = Kuliner::find($request->id);
        if ($kuliner != null) {
            $kuliner->delete();
            return response()->json(array('data' => 'Success'));
        } else {
            return response()->json(array('data' => 'Failed create'));
        }

        return response()->json($kuliner);
    }
    public function getTempat(Request $request)
    {
        if ($request->id != null) {
            $tiket = Tempat::where('user_id', $request->id)->get();
            // $accessToken = auth()->user()->createToken('authToken')->accessToken;
            if ($tempat->count() > 0) {
                return response()->json($tempat);
            } else {
                return response()->json(['data' => 'Tiket not found'], 404);
            }
        } else {
            return response()->json(['data' => 'Login First'], 401);
        }
    }
    public function desa()
    {
        $desa = new Desa();
        $desa = $desa
            ->where('kategori', 'desa')
            ->where('status', '1')
            ->get();
        return response()->json($desa);
    }

    public function listevent()
    {
        $listevent = new ListEvent();
        $listevent = $listevent->get();
        return response()->json($listevent);
    }

    public function hotel()
    {
        $hotel = new Hotel();
        $hotel = $hotel->get();
        return response()->json($hotel);
    }

    public function villa()
    {
        $villa = new Villa();
        $villa = $villa->get();
        return response()->json($villa);
    }
}
