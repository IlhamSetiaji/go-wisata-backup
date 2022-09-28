<?php

namespace App\Http\Controllers;

use App\Models\TempatSewa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Villa;
use App\Models\Tempat;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\Models\Detail_transaksi;
use App\Models\BookingTempatSewa;
use App\Models\ReviewTempatSewa;
use App\Models\Reviewvilla;
use App\Models\Ruang;
use App\Models\Tiket;
use Illuminate\Support\Facades\DB;
use App\Models\Pay;

class TempatSewaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tempatsewa = TempatSewa::orderby('id', 'desc')->where('user_id', Auth::user()->id)->get();
        return view('admin.tempatsewa.halaman_tempatsewa', [
            'tempatsewa' => $tempatsewa,
        ]);
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
        $tempat = Tempat::where('user_id', Auth::user()->petugas_id)->first();
        $this->validateStore($request);
        $foto = (new TempatSewa())->userAvatar($request);
        $data['tempat_id'] = $tempat->id;
        $data['user_id'] = Auth::user()->id;
        $data['nama'] = $request->nama;
        $data['deskripsi'] = $request->deskripsi;
        $data['lokasi'] = $request->lokasi;
        $data['telp'] = $request->telp;
        $data['foto'] = $foto;

        if (TempatSewa::create($data)) {
            Toastr::success('Berhasil menambahkan data vtempat :)', 'Success');
        }
        return redirect()->back();
    }
    public function validateStore($request)
    {
        return  $this->validate($request, [
            'foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
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
        $tempatsewa = TempatSewa::find($id);
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->pluck('id')->first();
        $ruang  = Ruang::where('tempat_id', $tempat)->where('tempatsewa_id', $id)->orderby('id', 'desc')->get();
        return view('admin.tempatsewa.halaman_ruang', compact('tempatsewa', 'ruang', 'tempat'));
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
        $tempatsewa = TempatSewa::find($id);
        $imageName = $tempatsewa->foto;
        if ($request->hasFile('foto')) {
            $imageName = (new TempatSewa)->userAvatar($request);
            if ($tempatsewa->foto == null) {
            } else {
                unlink(public_path('images/' . $tempatsewa->foto));
            }
        }
        $data['foto'] = $imageName;
        $tempatsewa->update($data);
        Toastr::success(' Berhasil mengubah data :)', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tempatsewa = TempatSewa::find($id);
        $tempatsewa->delete($tempatsewa);
        Toastr::success(' Berhasil menghapus data:)', 'Success');
        return redirect()->back();
    }
    public function toggleStatus($id)
    {
        $sesii = TempatSewa::find($id);
        $sesii->status = !$sesii->status;
        $sesii->save();
        Toastr::success(' Berhasil mengubah status :)', 'Success');
        return redirect()->back();
    }
    public function tambah_ruang(Request $request)
    {
        $data = $request->all();
        $name = (new Ruang())->userAvatar($request);
        $data['foto'] = $name;
        $data['user_id'] = Auth::user()->id;
        Ruang::create($data);
        Toastr::success('Data ruang berhasil ditambahkan :)', 'Success');
        return redirect()->back();
    }
    public function update_ruang(Request $request, $id)
    {
        $this->validateUpdate($request);
        $data = $request->all();
        $ruang = Ruang::find($id);
        $imageName = $ruang->foto;
        if ($request->hasFile('foto')) {
            $imageName = (new Ruang)->userAvatar($request);
            if ($ruang->foto == null) {
            } else {
                unlink(public_path('images/' . $ruang->foto));
            }
        }
        $data['foto'] = $imageName;
        $ruang->update($data);
        Toastr::success(' Berhasil mengubah data :)', 'Success');
        return redirect()->back();
    }
    public function validateUpdate($request)
    {
        return  $this->validate($request, [
            'foto' => 'image|mimes:jpg,png,jpeg,gif,svg',
        ]);
    }
    public function toggleStatus_ruang($id)
    {
        $sesii = Ruang::find($id);
        $sesii->status = !$sesii->status;
        $sesii->save();
        Toastr::success(' Berhasil mengubah status :)', 'Success');
        return redirect()->back();
    }
    public function hapus_ruang($id)
    {
        $ruang = Ruang::find($id);
        $ruang->delete($ruang);
        Toastr::success(' Berhasil menghapus data:)', 'Success');
        return redirect()->back();
    }
    public function booking_tempat($id)
    {
        $tempatsewa = TempatSewa::find($id);
        $ruang = Ruang::where('tempatsewa_id', $tempatsewa->id)->get();
        return view('explore.halaman_booking_tempatsewa', compact('tempatsewa', 'ruang'));
    }
    public function search_tempatsewa(Request $request, $id)
    {
        $checkin = $request->checkin . " " . $request->time_checkin;
        $checkout = $request->checkout . " " . $request->time_checkout;
        $tempatsewa = TempatSewa::find($id);

        // $villa = DB::SELECT("SELECT * FROM tb_villa WHERE id NOT IN (SELECT villa_id FROM tb_BookingVilla 
        //     WHERE ('$checkin' BETWEEN checkin AND checkout) OR ('$checkout' BETWEEN checkin AND checkout))");
        $data_ruang = DB::SELECT("SELECT * FROM tb_ruang WHERE tempatsewa_id = '$tempatsewa->id'AND id NOT IN (SELECT ruang_id FROM tb_bookingtempatsewa
                    WHERE ('$checkin' BETWEEN checkin AND checkout) OR ('$checkout' BETWEEN checkin AND checkout))");
        return view('explore.halaman_booking_tempatsewa', compact('tempatsewa', 'data_ruang', 'checkin', 'checkout'));
    }
    public function form_booking($checkin, $checkout, $id)
    {
        // $jam   = floor($diff / (60 * 60));

        // $menit = $diff - $jam * (60 * 60);

        // echo 'Waktu Tersisa tinggal: ' . $jam .  ' jam, ' . floor($menit / 60) . ' menit';

        // dd($checkout);
        $ruang = Ruang::find($id);
        $awal  = strtotime($checkin); //waktu awal
        $akhir = strtotime($checkout); //waktu akhir
        $diff  = $akhir - $awal;
        $jam   = floor($diff / (60 * 60));
        $menit = $diff - $jam * (60 * 60);
        $durasi_jam = (int)$jam;
        $durasi_menit = floor($menit / 60);
        if ($durasi_menit == 30) {
            $biaya_jam = $ruang->harga * $durasi_jam;
            $biaya_menit = ($ruang->harga / 2);
            $biaya = $biaya_jam + $biaya_menit;
        } else {
            $biaya = $ruang->harga * $durasi_jam;
        }
        return view('explore/halaman_tempatsewa_formpesan', [
            "title" => "Explore",
            "ruang" => $ruang,
            "checkin" => $checkin,
            "checkout" => $checkout,
            "durasi_jam" => $durasi_jam,
            "durasi_menit" => $durasi_menit,
            "biaya" => $biaya,
        ]);
    }
    public function pesan_tempatsewa(Request $request, $id, $checkin, $checkout, $durasi_jam, $durasi_menit, $biaya)
    {
        $ruang = Ruang::find($id);
        $tempat = Tempat::where('id', $ruang->tempat_id)->first();
        $id_user_tiket = Auth::user()->id;
        $now_tgl = Carbon::now()->format('d');

        //kodetiket
        $data = Tiket::max('id');
        $urutan = (int)($data);
        $urutan++;
        $huruf =  "LT-";
        $checkout_kode = $huruf . $urutan . $id_user_tiket . $now_tgl;

        $data = BookingTempatSewa::create([
            'kode_tiket' => $checkout_kode,
            'kode_booking' => $request->kode_booking,
            'nama' => $request->nama,
            'telp' => $request->telp,
            'nik' => $request->nik,
            'keperluan' => $request->keperluan,
            'jml_orang' => $request->jml_orang,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'durasi' => $durasi_jam . " jam " . $durasi_menit . " menit",
            'biaya' => $biaya,
            'user_id' =>  $id_user_tiket,
            'ruang_id' => $id,
            'status' => '1',
        ]);
        Tiket::create([
            'kode' => $checkout_kode,
            'user_id' => Auth::user()->id,
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'telp' => Auth::user()->telp,
            'harga' => $biaya,
            "tempat_id" => $tempat->id,
        ]);

        $ck =  date('Y-m-d', strtotime($checkin));
        $co =  date('Y-m-d', strtotime($checkout));
        Detail_transaksi::create([
            "name" => "Reservasi " . $ruang->nama,
            'user_id' =>  $id_user_tiket,
            'durasi' => $durasi_jam . " jam " . $durasi_menit . " menit",
            "tanggal_a" => $ck,
            "tanggal_b" => $co,
            "kode_tiket" => $checkout_kode,
            "id_produk" => $ruang->tempatsewa_id,
            "booking_id" => $request->kode_booking,
            "harga" => $biaya,
            'jumlah' => $request->jml_orang,
            "kategori" => "tempat sewa",
            "tempat_id" => $tempat->id,
        ]);
        Toastr::success('Berhasil pesan, silahkan cek detail pesanan dan lakukan pembayaran :) ', 'Success');
        return redirect("pesananku");
    }
    public function rating($kode)
    {
        $dt = Detail_transaksi::where('kode_tiket', $kode)->first();
        return view('rating.ratingtempatsewa', compact('dt'));
    }
    public function tambah_rating(Request $request, $id)
    {
        $review = ReviewTempatSewa::find($id);
        $review->tempatsewa_id = $request->tempatsewa_id;
        $review->nama = $request->nama;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->kode_tiket = $request->kode_tiket;
        $review->user_id = $request->user_id;
        $review->status = '1';
        $review->save();
        Toastr::success('Berhasil menambahkan ulasan :)', 'Success');
        return redirect('/pesananku');
    }
    public function delete_rating($id)
    {
        $rating = ReviewTempatSewa::find($id);
        $rating->delete($rating);
        Toastr::success('Berhasil menghapus ulasan :)', 'Success');
        return redirect()->back();
    }
    public function update_rating(Request $request, $id)
    {
        $review = ReviewTempatSewa::find($id);
        $review->nama = $request->nama;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();
        Toastr::success('Berhasil update komentar :)', 'Success');
        return redirect()->back();
    }
    public function check_tempatsewa(Request $request)
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
                    return view('admin.booking.check_tempatsewa');
                }
                $data = Tiket::where('kode', $id)->first();
                $data2 = Detail_transaksi::where('kode_tiket', $id)->where('tempat_id', $id_tempat)->where('kategori', 'tempat sewa')->first();
                if ($data2 == null) {
                    $kosong = 0;
                    Toastr::warning('Kode ID ini Tidak Valid !', 'Gagal !');
                    return view('admin.booking.check_tempatsewa');
                }
                $pay = Pay::where('kodeku', $id)->first();
                $db = BookingTempatSewa::where('kode_tiket', $id)->first();
                $db2 = BookingTempatSewa::where('kode_tiket', $id)->get();
                $cek = BookingTempatSewa::where('kode_tiket', $id)->first();
                $ck = (int)$cek->status;
                return view('admin.booking.check_tempatsewa', compact('db', 'db2', 'data', 'data2', 'user', 'pay', 'id', 'ck'));
                break;
        }
        $cek = "yo";
        return view('admin.booking.check_tempatsewa', compact('detail', 'cek'));
    }
    public function toggleStatus_checkin($id)
    {
        $mytime = Carbon::now();
        $sesii = BookingTempatSewa::find($id);
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
        $sesii = BookingTempatSewa::find($id);
        $dt = Detail_transaksi::where('kode_tiket', $sesii->kode_tiket)->first();
        $sesii->status = "3";
        $sesii->checkoutt = $mytime;
        $sesii->save();
        $dt->status = "3";
        $dt->save();
        return redirect()->back();
    }
    public function jadwal_sewa()
    {
        $today = Carbon::now()->format('Y-m-d');
        $tempat  = Tempat::where('user_id', Auth::user()->petugas_id)->where('status', '1')->first();
        $dt = Detail_transaksi::where('tempat_id', $tempat->id)->where('kategori', 'tempat sewa')->orderby('tanggal_a', 'Desc')->get();
        return view('admin.booking.jadwal_sewa', compact('dt'));
    }
    public function review_index()
    {
        $review = ReviewTempatSewa::orderby('id', 'desc')->whereNotNull('comment')->get();
        return view('admin.tempatsewa.halaman_review', [
            'review' => $review
        ]);
    }
    public function review_delete($id)
    {
        $review = ReviewTempatSewa::find($id);
        $review->delete($review);
        Toastr::success(' Berhasil menghapus data:)', 'Success');
        return redirect()->back();
    }
}
