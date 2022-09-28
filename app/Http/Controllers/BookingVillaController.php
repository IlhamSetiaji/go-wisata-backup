<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Villa;
use App\Models\Tempat;
use App\Models\Tiket;
use App\Models\BookingVilla;
use App\Models\Detail_transaksi;
use App\Models\ReviewVilla;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use LDAP\Result;
use App\Models\Pay;


class BookingVillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $BookingVilla = BookingVilla::orderby('id', 'desc')->get();
        $Villa = Villa::all();
        $total_order = BookingVilla::count();
        $sudah_dibayar = 0;
        $belum_dibayar = 0;
        $selesai = 0;
        foreach (BookingVilla::orderby('id', 'desc')->get() as $book) {
            foreach (Pay::where('kodeku', $book->kode_tiket)->where('status_message', 'settlement')->get() as $pay => $val) {
                $sudah_dibayar += 1;
            }
        }
        foreach (BookingVilla::orderby('id', 'desc')->get() as $book) {
            foreach (Tiket::where('kode', $book->kode_tiket)->where('status', '0')->get() as $tiket => $val) {
                $belum_dibayar += 1;
            }
        }
        foreach (BookingVilla::orderby('id', 'desc')->get() as $book) {
            foreach (Detail_transaksi::where('kode_tiket', $book->kode_tiket)->where('status', '3')->get() as $dt => $val) {
                $selesai += 1;
            }
        }
        return view('admin.booking.halaman_bookingvilla', compact('BookingVilla', 'Villa', 'total_order', 'sudah_dibayar', 'belum_dibayar', 'selesai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dt = Tempat::where('user_id', 'D007')->first();
        $tempat_id = $dt->id;
        $this->validateStore($request);
        date_default_timezone_set('Asia/Jakarta');
        $default = $request->daterange;
        $startDate = Str::before($request->daterange, ' -');
        $endDate = Str::after($request->daterange, '- ');
        $formatted_dt1 = Carbon::parse($startDate);
        $formatted_dt2 = Carbon::parse($endDate);
        $durasi = $formatted_dt1->diffInDays($formatted_dt2);
        if ($durasi < 0) {
            return redirect()->back();
        }
        $dataVilla = DB::select(
            "SELECT  a.harga FROM `tb_villa` AS a
            LEFT JOIN tb_BookingVilla AS b ON b.villa_id = a.id
            WHERE a.id = $request->villa_id"
        );

        foreach ($dataVilla as $a) {
            // $biaya = $a->harga * ($durasi + 1);
            $biaya = $a->harga * $durasi;
        }
        $data = Tiket::max('id');
        $urutan = (int)($data);
        $urutan++;
        $huruf =  "LT-";
        $checkout_kode = $huruf . $urutan . uniqid();
        $kartu_identitas = (new BookingVilla)->userAvatar($request);
        $data = BookingVilla::create([
            'kode_tiket' => $checkout_kode,
            'kode_booking' => $request->kode_booking,
            'nama' => $request->nama,
            'telp' => $request->telp,
            'nama_tempat' => $request->nama_tempat,
            'checkin' => $startDate,
            'checkout' => $endDate,
            'jml_orang' => $request->jml_orang,
            // 'durasi' => $durasi + 1,
            'durasi' => $durasi,
            'biaya' => $biaya,
            'kartu_identitas' => $kartu_identitas,
            'user_id' =>  $request->user_id,
            'villa_id' => $request->villa_id,
            'status' => '1',
        ]);
        Tiket::create([
            'kode' => $checkout_kode,
            'user_id' => Auth::user()->id,
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'telp' => Auth::user()->telp,
            'harga' => $biaya,
            "tempat_id" => $tempat_id,

        ]);
        Detail_transaksi::create([
            "name" => $request->nama_tempat,
            "user_id" => $request->user_id,
            // "durasi" => $durasi + 1,
            'durasi' => $durasi,
            "tanggal_a" => $startDate,
            "tanggal_b" => $endDate,
            "kode_tiket" => $checkout_kode,
            "id_produk" => $request->villa_id,
            "booking_id" => $request->kode_booking,
            "harga" => $biaya,
            "jumlah" => $request->jml_orang,
            "kategori" => "villa",
            "tempat_id" => $tempat_id,

        ]);


        if ($data) {
            Toastr::success('Berhasil menambahkan data pemesanan:)', 'Success');
        }
        return redirect()->back();
    }
    public function validateStore($request)
    {
        return  $this->validate($request, [
            'nama' => 'required',
            'telp' => 'required',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $BookingVilla = BookingVilla::find($id);
        $Villa = Villa::all();
        return view('admin.booking.halaman_detailBookingVilla',  compact('BookingVilla', 'Villa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateUpdate($request, $id);
        $data = $request->all();
        $BookingVilla = BookingVilla::find($id);
        $imageName = $BookingVilla->kartu_identitas;
        if ($request->hasFile('kartu_identitas')) {
            $imageName = (new BookingVilla)->userAvatar($request);
            if ($BookingVilla->kartu_identitas == null) {
            } else {
                unlink(public_path('images/' . $BookingVilla->kartu_identitas));
            }
        }
        $data['kartu_identitas'] = $imageName;
        $formatted_dt1 = Carbon::parse($request->checkin);
        $formatted_dt2 = Carbon::parse($request->checkout);
        $durasi = $formatted_dt1->diffInDays($formatted_dt2);
        // $data['durasi'] = $durasi + 1;
        $data['durasi'] = $durasi;
        if ($durasi < 0) {
            return redirect()->back();
        }
        $dataVilla = DB::select(
            "SELECT  a.harga FROM `tb_villa` AS a
            LEFT JOIN tb_BookingVilla AS b ON b.villa_id = a.id
            WHERE a.id = $request->villa_id"
        );
        $datatiket = DB::select(
            "SELECT  a.harga , a.id FROM `tb_tiket` AS a
            LEFT JOIN tb_BookingVilla AS b ON b.kode_tiket = a.kode
            WHERE a.kode = '$request->kode_tiket' "
        );
        $datadetailtransaksi = DB::select(
            "SELECT  a.id, a.durasi , a.tanggal_a, a.tanggal_b, a.jumlah, a.harga FROM `tb_detailtransaksi` AS a
            LEFT JOIN tb_BookingVilla AS b ON b.kode_tiket = a.kode_tiket
            WHERE a.kode_tiket = '$request->kode_tiket' "
        );


        foreach ($datatiket as $d) {
            $uptiket['id'] = $d->id;
            $tikettt = Tiket::find($d->id);
        }
        foreach ($dataVilla as $a) {
            $data['biaya'] = $a->harga * ($durasi);
            $uptiket['harga'] = $a->harga * ($durasi);
            $updetail['harga'] = $a->harga * ($durasi);
        }
        foreach ($datadetailtransaksi as $t) {
            $detailtransaksi = Detail_transaksi::find($t->id);
            // $updetail['durasi'] =  $durasi + 1;
            $updetail['durasi'] =  $durasi;
            $updetail['tanggal_a'] =  $request->checkin;
            $updetail['tanggal_b'] =  $request->checkout;
            $updetail['jumlah'] =  $request->jml_orang;
        }
        $BookingVilla->update($data);
        $tikettt->update($uptiket);
        $detailtransaksi->update($updetail);

        Toastr::success(' Berhasil mengubah data:)', 'Success');
        return redirect()->back();
    }
    public function validateUpdate($request, $id)
    {
        return  $this->validate($request, [
            'nama' => 'required',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $BookingVilla = BookingVilla::find($id);
        $BookingVilla->delete($BookingVilla);
        Toastr::success(' Berhasil menghapus data:)', 'Success');
        return redirect()->back();
    }
    public function rating($kode)
    {
        $dt = Detail_transaksi::where('kode_tiket', $kode)->first();
        return view('rating.ratingVilla', compact('dt'));
    }
    public function tambah_rating(Request $request, $id)
    {
        $review = ReviewVilla::find($id);
        $review->villa_id = $request->villa_id;
        $review->nama = $request->nama;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->kode_tiket = $request->kode_tiket;
        $review->user_id = $request->user_id;
        $review->status = '1';
        $review->save();
        Toastr::success(' Berhasil menambahkan ulasan :)', 'Success');
        return redirect('/pesananku');
    }
    public function delete_rating($id)
    {
        $rating = ReviewVilla::find($id);
        $rating->delete($rating);
        Toastr::success('Berhasil menghapus ulasan :)', 'Success');
        return redirect()->back();
    }
    public function update_rating(Request $request, $id)
    {
        $review = ReviewVilla::find($id);
        $review->nama = $request->nama;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();
        Toastr::success('Berhasil update komentar :)', 'Success');
        return redirect()->back();
    }
    public function check_order(Request $request)
    {
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $id_tempat = $tempat->id;
        $detail = Detail_transaksi::where('tempat_id', $id_tempat)->get();
        switch ($request->submit) {
            case 'todo':
                $id = $request->order_id;
                $user = Tiket::where('kode', $id)->first();
                if ($user == null) {
                    Toastr::warning('Kode ID ini Tidak Valid !', 'Gagal !');
                    return view('admin.booking.check_villa');
                }
                $data = Tiket::where('kode', $id)->first();
                $data2 = Detail_transaksi::where('kode_tiket', $id)->where('tempat_id', $id_tempat)->where('kategori', 'villa')->first();
                if ($data2 == null) {
                    $kosong = 0;
                    Toastr::warning('Kode ID ini Tidak Valid !', 'Gagal !');
                    return view('admin.booking.check_villa', compact('kosong'));
                }

                $pay = Pay::where('kodeku', $id)->first();
                $db = BookingVilla::where('kode_tiket', $id)->first();
                $db2 = BookingVilla::where('kode_tiket', $id)->get();
                $cek = BookingVilla::where('kode_tiket', $id)->first();
                $ck = (int)$cek->status;
                return view('admin.booking.check_villa', compact('db', 'db2', 'data', 'data2', 'user', 'pay', 'id', 'ck'));
                break;
        }
        $cek = "yo";
        return view('admin.booking.check_villa', compact('detail', 'cek'));
    }
    public function toggleStatus_checkin($id)
    {
        $mytime = Carbon::now();
        $sesii = BookingVilla::find($id);
        $sesii->status = "2";
        $sesii->checkinn = $mytime;
        $sesii->save();
        $dt = Detail_transaksi::where('kode_tiket', $sesii->kode_tiket)->first();
        $dt->status = "2";
        $dt->kedatangan = 1;
        $dt->save();
        return redirect()->back();
    }
    public function toggleStatus_checkout($id)
    {
        $mytime = Carbon::now();
        $sesii = BookingVilla::find($id);
        $dt = Detail_transaksi::where('kode_tiket', $sesii->kode_tiket)->first();
        $sesii->status = "3";
        $sesii->checkoutt = $mytime;
        $sesii->save();
        $dt->status = "3";
        $dt->save();
        return redirect()->back();
    }
    public function toggleStatus_intodayck($id)
    {
        $mytime = Carbon::now();
        $dt = Detail_transaksi::find($id);
        $dt->status = "2";
        $dt->kedatangan = 1;
        $dt->save();
        $sesii = BookingVilla::where('kode_tiket', $dt->kode_tiket)->first();
        $sesii->status = "2";
        $sesii->checkinn = $mytime;
        $sesii->save();
        return redirect()->back();
    }
    public function toggleStatus_intodayco($id)
    {
        $mytime = Carbon::now();
        $dt = Detail_transaksi::find($id);
        $dt->status = "3";
        $dt->save();
        $sesii = BookingVilla::where('kode_tiket', $dt->kode_tiket)->first();
        $sesii->status = "3";
        $sesii->checkoutt = $mytime;
        $sesii->save();
        return redirect()->back();
    }
}
