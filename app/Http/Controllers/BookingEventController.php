<?php

namespace App\Http\Controllers;

use App\Models\BookingEvent;
use App\Models\Event;
use App\Models\Tempat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Detail_transaksi;
use App\Models\Tiket;
use App\Models\Pay;
use App\Models\PesertaEvent;
use App\Models\ReviewEvent;


class BookingEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = Event::all();
        $ue = Event::where('user_id', Auth::user()->id)->get();
        $bookingevent = BookingEvent::orderby('id', 'desc')->get();
        $total_order = BookingEvent::count();
        $sudah_dibayar = 0;
        $belum_dibayar = 0;
        $selesai = 0;
        foreach (BookingEvent::orderby('id', 'desc')->get() as $book) {
            foreach (Pay::where('kodeku', $book->kode_tiket)->where('status_message', 'settlement')->get() as $pay => $val) {
                $sudah_dibayar += 1;
            }
        }
        foreach (BookingEvent::orderby('id', 'desc')->get() as $book) {
            foreach (Tiket::where('kode', $book->kode_tiket)->where('status', '0')->get() as $tiket => $val) {
                $belum_dibayar += 1;
            }
        }
        foreach (BookingEvent::orderby('id', 'desc')->get() as $book) {
            foreach (Detail_transaksi::where('kode_tiket', $book->kode_tiket)->where('status', '3')->get() as $dt => $val) {
                $selesai += 1;
            }
        }
        return view('admin.booking.halaman_bookingevent', compact('bookingevent', 'event', 'total_order', 'sudah_dibayar', 'belum_dibayar', 'selesai', 'ue'));
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
        $this->validateStore($request);
        $dataevent = DB::select(
            "SELECT  a.harga FROM `tb_event` AS a
            LEFT JOIN tb_bookingevent AS b ON b.event_id = a.id
            WHERE a.id = $request->event_id"
        );
        foreach ($dataevent as $a) {
            $data['biaya'] = $a->harga * $request->jml_orang;
        }
        $data['kode_booking'] = $request->kode_booking;
        $data['nama'] = $request->nama;
        $data['alamat'] = $request->alamat;
        $data['telp'] = $request->telp;
        $data['jml_orang'] =   $request->jml_orang;
        $data['user_id'] = $request->user_id;
        $data['event_id'] = $request->event_id;
        // dd($data);

        if (BookingEvent::create($data)) {
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
        $bookingevent = BookingEvent::find($id);
        $event = Event::all();
        return view('admin.booking.halaman_detailbookingevent',  compact('bookingevent', 'event'));
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
        $bookingevent = BookingEvent::find($id);
        $dataevent = DB::select(
            "SELECT  a.harga FROM `tb_event` AS a
            LEFT JOIN tb_bookingevent AS b ON b.event_id = a.id
            WHERE a.id = $request->event_id"
        );
        foreach ($dataevent as $a) {
            $data['biaya'] = $a->harga * $request->jml_orang;
        }
        $bookingevent->update($data);
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
        $bookingevent = BookingEvent::find($id);
        $bookingevent->delete($bookingevent);
        Toastr::success(' Berhasil menghapus data:)', 'Success');
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
                    return view('admin.booking.check');
                }
                $data = Tiket::where('kode', $id)->first();
                $data2 = Detail_transaksi::where('kode_tiket', $id)->where('tempat_id', $id_tempat)->where('kategori', 'events')->first();
                if ($data2 == null) {
                    $kosong = 0;
                    Toastr::warning('Kode ID ini Tidak Valid !', 'Gagal !');
                    return view('admin.booking.check');
                }

                $pay = Pay::where('kodeku', $id)->first();
                $db = BookingEvent::where('kode_tiket', $id)->first();
                $db2 = BookingEvent::where('kode_tiket', $id)->get();
                $cek = BookingEvent::where('kode_tiket', $id)->first();
                $ck = (int)$cek->status;
                return view('admin.booking.check', compact('db', 'db2', 'data', 'data2', 'user', 'pay', 'id', 'ck'));
                break;
        }
        $cek = "yo";
        return view('admin.booking.check', compact('detail', 'cek'));
    }
    public function toggleStatus_checkin($id)
    {
        $mytime = Carbon::now();
        $sesii = BookingEvent::find($id);
        $sesii->status = "2";
        $sesii->checkin = $mytime;
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
        $sesii = BookingEvent::find($id);
        $dt = Detail_transaksi::where('kode_tiket', $sesii->kode_tiket)->first();
        $sesii->status = "3";
        $sesii->checkout = $mytime;
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
        $sesii = BookingEvent::where('kode_tiket', $dt->kode_tiket)->first();
        $sesii->status = "2";
        $sesii->checkin = $mytime;
        $sesii->save();
        return redirect()->back();
    }
    public function toggleStatus_intodayco($id)
    {
        $mytime = Carbon::now();
        $dt = Detail_transaksi::find($id);
        $dt->status = "3";
        $dt->save();
        $sesii = BookingEvent::where('kode_tiket', $dt->kode_tiket)->first();
        $sesii->status = "3";
        $sesii->checkout = $mytime;
        $sesii->save();
        return redirect()->back();
    }
    public function rating($kode)
    {
        $dt = Detail_transaksi::where('kode_tiket', $kode)->first();
        return view('rating.ratingevent', compact('dt'));
    }
    public function tambah_rating(Request $request, $id)
    {
        $review = ReviewEvent::find($id);
        $review->event_id = $request->event_id;
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
        $rating = ReviewEvent::find($id);
        $rating->delete($rating);
        Toastr::success('Berhasil menghapus ulasan :)', 'Success');
        return redirect()->back();
    }
    public function update_rating(Request $request, $id)
    {
        $review = ReviewEvent::find($id);
        $review->nama = $request->nama;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();
        Toastr::success('Berhasil update komentar :)', 'Success');
        return redirect()->back();
    }
    public function kedatangan_peserta($id)
    {
        $sesii = PesertaEvent::find($id);
        $sesii->kedatangan = "1";
        $sesii->save();
        return redirect()->back();
    }
}
