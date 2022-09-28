<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\ReviewEvent;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\KategoriEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Setting;
use App\Models\User;
use App\Models\Tempat;
use App\Models\Tiket;
use App\Models\BookingEvent;
use App\Models\PesertaEvent;
use App\Models\Detail_transaksi;
use App\Models\Pay;
use Illuminate\Support\Facades\Auth;


class EventController extends Controller
{
    //menampilkan data kategori event
    public function index_kategorievent()
    {
        $kategorievent = KategoriEvent::all();
        return view('admin.event.halaman_kategorievent', [
            'kategorievent' => $kategorievent
        ]);
    }
    //tambah data kategori event
    public function create_kategorievent(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|unique:tb_kategorievent',
        ]);
        KategoriEvent::create($validatedData);
        Toastr::success(' Berhasil menambahkan data:)', 'Success');
        return redirect()->back();
    }
    //update data kategori event
    public function update_kategorievent(Request $request, $id)
    {
        $kategorievent = KategoriEvent::find($id);
        $validatedData = $request->validate([
            'nama_kategori' => 'required|unique:tb_kategorievent',
        ]);
        $kategorievent->update($validatedData);
        Toastr::success(' Berhasil mengedit data:)', 'Success');
        return redirect()->back();
    }
    //menghapus data kategori event
    public function delete_kategorievent($id)
    {
        $kategorievent = KategoriEvent::find($id);
        $kategorievent->delete($kategorievent);
        Toastr::success(' Berhasil menghapus data:)', 'Success');
        return redirect()->back();
    }
    public function index_event()
    {
        $event = Event::orderby('id', 'desc')->where('user_id', Auth::user()->id)->get();
        $kategorievent = KategoriEvent::all();
        return view('admin.event.halaman_event', [
            'event' => $event,
            'kategorievent' => $kategorievent
        ]);
    }
    public function create_event(Request $request)
    {
        $this->validateStore($request);
        date_default_timezone_set('Asia/Jakarta');

        $startDate = Str::before($request->daterange, ' -');
        $endDate = Str::after($request->daterange, '- ');
        $formatted_dt1 = Carbon::parse($startDate);
        $formatted_dt2 = Carbon::parse($endDate);
        $durasi = $formatted_dt1->diffInDays($formatted_dt2);
        if ($durasi < 0) {
            return redirect()->back();
        }
        $formatted_jam1 = Carbon::parse($request->jambuka);
        $formatted_jam2 = Carbon::parse($request->jamtutup);
        $durasi2 = $formatted_jam1->diffInHours($formatted_jam2);
        $foto = (new Event)->userAvatar($request);
        $data['kode_event'] = $request->kode_event;
        $data['nama'] = $request->nama;
        $data['deskripsi'] = $request->deskripsi;
        $data['lokasi'] = $request->lokasi;
        $data['waktu_mulai'] = $request->waktu_mulai;
        $data['waktu_selesai'] = $request->waktu_selesai;
        $data['tgl_buka'] = $startDate;
        $data['tgl_tutup'] = $endDate;
        $data['harga'] =   (int) preg_replace('/\D/', '', $request->harga);
        $data['foto'] = $foto;
        $data['link_video'] = $request->link_video;
        $data['kapasitas_awal'] = $request->kapasitas_awal;
        $data['kategorievent_id'] = $request->kategorievent_id;
        $data['user_id'] = Auth::user()->id;

        if (Event::create($data)) {
            Toastr::success('Membuat event berhasil :)', 'Success');
        }
        return redirect()->back();
    }
    public function validateStore($request)
    {
        return  $this->validate($request, [
            'foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);
    }
    public function toggleStatus($id)
    {
        $sesii = Event::find($id);
        $sesii->status = !$sesii->status;
        $sesii->save();
        return redirect()->back();
    }
    public function detail_event($id)
    {
        $event = Event::find($id);
        $kategorievent = KategoriEvent::all();
        return view('admin.event.halaman_detailevent',  compact('event', 'kategorievent'));
    }
    public function update_event(Request $request, $id)
    {
        $this->validateUpdate($request, $id);
        $data = $request->all();
        $event = Event::find($id);
        $imageName = $event->foto;
        if ($request->hasFile('foto')) {
            $imageName = (new Event)->userAvatar($request);
            if ($event->foto == null) {
            } else {
                unlink(public_path('images/' . $event->foto));
            }
        }
        $data['foto'] = $imageName;
        $data['harga'] =   (int) preg_replace('/\D/', '', $request->harga);
        $event->update($data);
        Toastr::success(' Berhasil mengubah data:)', 'Success');
        return redirect()->back();
    }
    public function validateUpdate($request)
    {
        return  $this->validate($request, [
            'foto' => 'image|mimes:jpg,png,jpeg,gif,svg',
        ]);
    }
    public function delete_event($id)
    {
        $event = Event::find($id);
        $event->delete($event);
        Toastr::success(' Berhasil menghapus data:)', 'Success');
        return redirect()->back();
    }

    public function review_index()
    {
        $tempat = Tempat::where('user_id', Auth::user()->petugas_id)->first();
        $review = ReviewEvent::orderby('id', 'desc')->whereNotNull('comment')->get();
        return view('admin.event.halaman_review', [
            'review' => $review
        ]);
    }
    public function review_delete($id)
    {
        $review = ReviewEvent::find($id);
        $review->delete($review);
        Toastr::success(' Berhasil menghapus data:)', 'Success');
        return redirect()->back();
    }
    public function rekap_pesertaevent($id)
    {
        $event = Event::find($id);
        return view('admin.event.rekap_peserta', [
            'event' => $event
        ]);
    }
    public function print_pesertaevent($id)
    {
        $data = Event::where('id', $id)->first();
        return view('admin.event.print_pesertaevent', compact('data'));
    }
    public function explore_event_detail(Request $request, $id, $nama, $harga, $tgl_buka, $tgl_tutup, $kapasitas_akhir, $kapasitas_awal)
    {
        $setting =  Setting::first();
        if ($request->has('cari')) {
            $event = Event::where('nama', 'LIKE', '%' . $request->cari . '%')->where('status', 1)->orderby('tgl_buka', 'DESC')->paginate(5);
        } else {
            $event = Event::where('status', 1)->orderby('tgl_buka', 'DESC')->paginate(5);
        }
        if ($request->jml_orang > 5) {
            Toastr::warning('Maksimal pesan 5 tiket', 'Warning');
            return redirect('/explore-event');
        }
        if ($kapasitas_akhir + $request->jml_orang > $kapasitas_awal) {
            Toastr::warning('Tiket tinggal sisa untuk ' . $kapasitas_awal - $kapasitas_akhir . ' orang', 'Warning');
            return redirect('/explore-event');
        } else {
            $data['jml_orang'] = $request->jml_orang;
            return view('explore/halaman_explore_event_detail', [
                "title" => "Explore",
                "setting" => $setting,
                "jml_orang" => $data['jml_orang'],
                "id" => $id,
                "harga" => $harga,
                "nama_event" => $nama,
                "tgl_buka" => $tgl_buka,
                "tgl_tutup" => $tgl_tutup,
            ]);
        }
    }
    public function pesantiketevent(Request $request, $jml_orang, $id, $harga, $nama_event, $tgl_buka, $tgl_tutup)
    {
        $jamsekarang = Carbon::now();
        $user_event = Event::where('id', $id)->first();
        $user_eventt = $user_event->user_id;
        $users = User::where('id', $user_eventt)->first();
        $dt = Tempat::where('user_id', $users->petugas_id)->first();
        $tempat_id = $dt->id;
        $totalbiaya = $jml_orang * $harga;

        $nama = auth()->user()->name;
        $user_id = auth()->user()->id;
        $now_tgl = Carbon::now()->format('d');

        $datatiket = Tiket::max('id');
        $urutantiket = (int)($datatiket);
        $urutantiket++;
        $huruftiket =  "LT-";
        // $checkout_kode = $huruftiket . $urutantiket . uniqid();
        $checkout_kode = $huruftiket . $urutantiket . $user_id . $now_tgl;
        $kode_booking = $request->kode_booking;
        // dd($totalbiaya);

        BookingEvent::create([
            'kode_tiket' => $checkout_kode,
            'kode_booking' => $kode_booking,
            'nama' => $nama,
            'jml_orang' => $jml_orang,
            'biaya' => $totalbiaya,
            'user_id' =>  $user_id,
            'event_id' => $id,
            'status' => '1',
        ]);
        $kode_peserta = array();
        $nama_peserta = array();
        $email = array();
        $telp = array();
        foreach ($request->kode_peserta as $k) {
            array_push($kode_peserta, $k);
        }
        foreach ($request->nama_peserta as $n) {
            array_push($nama_peserta, $n);
        }
        foreach ($request->email as $e) {
            array_push($email, $e);
        }
        foreach ($request->telp as $t) {
            array_push($telp, $t);
        }

        for ($i = 0; $i < $jml_orang; $i++) {
            $peserta = new PesertaEvent();
            $peserta->kode_peserta = $kode_peserta[$i];
            $peserta->kode_booking = $kode_booking;
            $peserta->nama_peserta = $nama_peserta[$i];
            $peserta->email = $email[$i];
            $peserta->telp = $telp[$i];
            $peserta->event_id = $id;
            $peserta->user_id = $user_id;
            $peserta->save();
        }

        $formatted_dt1 = Carbon::parse($tgl_buka);
        $formatted_dt2 = Carbon::parse($tgl_tutup);
        $durasi = $formatted_dt1->diffInDays($formatted_dt2);

        Detail_transaksi::create([
            "name" => "Event $nama_event",
            "durasi" => $durasi + 1,
            "tanggal_a" => $tgl_buka,
            "tanggal_b" => $tgl_tutup,
            "user_id" => Auth::user()->id,
            "kode_tiket" => $checkout_kode,
            "id_produk" => $id,
            "booking_id" => $kode_booking,
            "jumlah" => $jml_orang,
            "harga" => $totalbiaya,
            "kategori" => "events",
            "tempat_id" => $tempat_id,
        ]);

        if ($totalbiaya <= 0) {
            Tiket::create([
                'kode' => $checkout_kode,
                'user_id' => Auth::user()->id,
                'check' => 'settlement',
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'telp' => Auth::user()->telp,
                'harga' => $totalbiaya,
                'status' => 1,
                "tempat_id" => $tempat_id,
            ]);
            Pay::create([
                'id' => $checkout_kode,
                'status_message' => 'settlement',
                'order_id' => $checkout_kode,
                'payment_type' => 'gratis',
                'transaction_time' => $jamsekarang,
                'transaction_status' => 'settlement',
                'va_bank' => null,
                'va_number' => null,
                'kodeku' => $checkout_kode,
            ]);
            $detail = Detail_transaksi::where('kode_tiket', $checkout_kode)->get();
            foreach ($detail as $dt => $detail) {
                $detail->status = 1;
                $detail->save();
            }
            $eventkeg = Event::where('id', $detail->id_produk)->first();
            $eventkeg->kapasitas_akhir += (int)$detail->jumlah;
            $eventkeg->save();

            $review = new ReviewEvent();
            $review->kode_tiket = $checkout_kode;
            $review->save();
            Toastr::success('Berhasil pesan, gratis bisa langsung cetak invoice :) ', 'Success');
        } elseif ($totalbiaya > 0) {
            Tiket::create([
                'kode' => $checkout_kode,
                'user_id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'telp' => Auth::user()->telp,
                'harga' => $totalbiaya,
                "tempat_id" => $tempat_id,
            ]);
            Toastr::success('Berhasil pesan, silahkan cek detail pesanan dan lakukan pembayaran :) ', 'Success');
        }
        return redirect("pesananku");
    }
    public function calender_event()
    {
        $event = Event::all();
        return view('admin.event.halaman_calender_event', [
            'event' => $event
        ]);
    }
    public function jscalender()
    {
        $json = array();
        $data_event = Event::where('user_id', Auth::user()->id)->get();
        foreach ($data_event as $da) {
            if ($da['status'] == '1') {
                $json[] = array(
                    'backgroundColor' => 'rgba(58,87,232,0.2)',
                    'textColor' => 'rgba(58,87,232,1)',
                    'borderColor' => 'rgba(58,87,232,1)',
                    'title' => $da['nama'],
                    'start' => $da['tgl_buka'],
                    'url' => '/adminevent/detail/' . $da['id']
                );
            } elseif ($da['status'] == '0') {
                $json[] = array(
                    'backgroundColor' => 'rgba(206,32,20,0.2)',
                    'textColor' => 'rgba(206,32,20,1)',
                    'borderColor' => 'rgba(206,32,20,1)',
                    'title' => $da['nama'],
                    'start' => $da['tgl_buka'],
                    'url' => '/adminevent/detail/' . $da['id']
                );
            }
        }
        echo json_encode($json);
    }
}
