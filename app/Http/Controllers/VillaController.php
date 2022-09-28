<?php

namespace App\Http\Controllers;

use App\Models\Villa;
use App\Models\Tempat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\Models\Detail_transaksi;
use App\Models\Bookingvilla;
use App\Models\Reviewvilla;
use App\Models\Tiket;
use App\Models\User;


class VillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $villa = Villa::orderby('id', 'desc')->where('user_id', Auth::user()->id)->get();
        return view('admin.villa.halaman_villa', [
            'villa' => $villa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateStore($request);
        $foto = (new Villa)->userAvatar($request);
        $data['user_id'] = Auth::user()->id;
        $data['kode_tempat'] = $request->kode_tempat;
        $data['nama'] = $request->nama;
        $data['deskripsi'] = $request->deskripsi;
        $data['lokasi'] = $request->lokasi;
        $data['maps'] = $request->maps;
        $data['telp'] = $request->telp;
        $data['harga'] =   (int) preg_replace('/\D/', '', $request->harga);
        $data['foto'] = $foto;
        $data['kapasitas'] = $request->kapasitas;

        if (Villa::create($data)) {
            Toastr::success('Berhasil menambahkan data villa :)', 'Success');
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
        $villa = Villa::find($id);
        return view('admin.villa.halaman_detailvilla',  compact('villa'));
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
        $villa = Villa::find($id);
        $imageName = $villa->foto;
        if ($request->hasFile('foto')) {
            $imageName = (new villa)->userAvatar($request);
            if ($villa->foto == null) {
            } else {
                unlink(public_path('images/' . $villa->foto));
            }
        }
        $data['foto'] = $imageName;
        $data['harga'] =   (int) preg_replace('/\D/', '', $request->harga);
        $villa->update($data);
        Toastr::success(' Berhasil mengubah data:)', 'Success');
        return redirect()->back();
    }
    public function validateUpdate($request, $id)
    {
        return  $this->validate($request, [
            'foto' => 'image|mimes:jpg,png,jpeg,gif,svg',
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
        $villa = Villa::find($id);
        $villa->delete($villa);
        Toastr::success(' Berhasil menghapus data:)', 'Success');
        return redirect()->back();
    }
    public function toggleStatus($id)
    {
        $sesii = Villa::find($id);
        $sesii->status = !$sesii->status;
        $sesii->save();
        Toastr::success(' Berhasil mengubah status :)', 'Success');
        return redirect()->back();
    }
    public function pesan_villa(Request $request, $id)
    {
        $now = Carbon::now()->format('Y-m-d');
        $request->validate([
            'checkin' => 'required|after_or_equal:' . $now,
            'checkout' => 'required|after:checkin'
        ]);
        $villa = Villa::find($id);
        $checkin = $request->checkin;
        $checkout = $request->checkout;
        $formatted_dt1 = Carbon::parse($request->checkin);
        $formatted_dt2 = Carbon::parse($request->checkout);
        $durasi = $formatted_dt1->diffInDays($formatted_dt2);
        return view('explore/halaman_villa_formpesan', [
            "title" => "Explore",
            "villa" => $villa,
            "checkin" => $checkin,
            "checkout" => $checkout,
            "durasi" => $durasi,
        ]);
    }
    public function formpesan_villa(Request $request, $id, $checkin, $checkout, $durasi)
    {
        $user_tempat = Villa::where('id', $id)->first();
        $user_tempatt = $user_tempat->user_id;
        $users = User::where('id', $user_tempatt)->first();
        $dt = Tempat::where('user_id', $users->petugas_id)->first();
        $tempat_id = $dt->id;

        $id_user_tiket = Auth::user()->id;
        $now_tgl = Carbon::now()->format('d');
        date_default_timezone_set('Asia/Jakarta');
        $villa = Villa::find($id);

        //kodetiket
        $data = Tiket::max('id');
        $urutan = (int)($data);
        $urutan++;
        $huruf =  "LT-";
        // $checkout_kode = $huruf . $urutan . uniqid();
        $checkout_kode = $huruf . $urutan . $id_user_tiket . $now_tgl;

        //kodebooking
        $data = BookingVilla::max('kode_booking');
        $huruff = 'BV';
        $urutann = (int) substr($data, 3, 3);
        $urutann++;
        $kode_booking = $huruff . sprintf('%04s', $urutann);

        $biaya = $durasi * $villa->harga;
        $kartu_identitas = $request->kartu_identitas;
        $user_id = auth()->user()->id;
        $data = BookingVilla::create([
            'kode_tiket' => $checkout_kode,
            'kode_booking' => $kode_booking,
            'nama' => $request->nama,
            'telp' => $request->telp,
            'nama_tempat' => $villa->nama,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'jml_orang' => $request->jml_orang,
            'durasi' => $durasi,
            'biaya' => $biaya,
            'kartu_identitas' => $kartu_identitas,
            'user_id' =>  $user_id,
            'villa_id' => $id,
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
            "name" => $villa->nama,
            'user_id' =>  $user_id,
            "durasi" => $durasi,
            "tanggal_a" => $checkin,
            "tanggal_b" => $checkout,
            "kode_tiket" => $checkout_kode,
            "id_produk" => $id,
            "booking_id" => $kode_booking,
            "jumlah" => $request->jml_orang,
            "harga" => $biaya,
            "kategori" => "villa",
            "tempat_id" => $tempat_id,
        ]);
        Toastr::success('Berhasil pesan, silahkan cek detail pesanan dan lakukan pembayaran :) ', 'Success');
        return redirect("pesananku");
    }
    public function review_index()
    {
        $review = ReviewVilla::orderby('id', 'desc')->whereNotNull('comment')->get();
        return view('admin.villa.halaman_review', [
            'review' => $review
        ]);
    }
    public function review_delete($id)
    {
        $review = ReviewVilla::find($id);
        $review->delete($review);
        Toastr::success(' Berhasil menghapus data:)', 'Success');
        return redirect()->back();
    }
    public function booking_villa(Request $request, $checkin, $checkout, $id)
    {
        $villa = Villa::find($id);
        $formatted_dt1 = Carbon::parse($checkin);
        $formatted_dt2 = Carbon::parse($checkout);
        $durasi = $formatted_dt1->diffInDays($formatted_dt2);
        return view('explore/halaman_villa_formpesan', [
            "title" => "Explore",
            "villa" => $villa,
            "checkin" => $checkin,
            "checkout" => $checkout,
            "durasi" => $durasi,
        ]);
    }
    public function rekap_penyewa($id)
    {
        $tempat = Villa::find($id);
        return view('admin.villa.rekap_penyewa', [
            'tempat' => $tempat
        ]);
    }
    public function print_penyewa($id)
    {
        $tempat = Villa::where('id', $id)->first();
        return view('admin.villa.print_penyewa', compact('tempat'));
    }
}
