<?php

use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TempatController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CampingController;
use App\Http\Controllers\WahanaController;
use App\Http\Controllers\KulinerController;
use App\Http\Controllers\ATWController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DanaController;
use App\Http\Controllers\DanaKController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\DanaPController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ATFController;
use App\Http\Controllers\TodayController;
use App\Http\Controllers\JadwalKamarController;
use App\Http\Controllers\JadwalCampController;
use App\Http\Controllers\RekapWController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VillaController;
use App\Http\Controllers\BookingEventController;

use App\Http\Controllers\BookingVillaController;
use App\Http\Controllers\TempatSewaController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\BookingTempatSewaController;
use App\Http\Controllers\BudgetingController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\TbPaketController;
use App\Http\Controllers\TbPaketkulinerController;
use App\Http\Controllers\TopUpController;
use App\Http\Middleware\Kuliner;
use Illuminate\Auth\Events\Login;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/






Auth::routes(['verify' => true]);
Route::resource('/', FrontendController::class);
Route::post('/get-penginapan', [FrontendController::class, 'getPenginapan'])->name('get-penginapan');
//event
Route::get('/explore', [FrontendController::class, 'explore']);
Route::get('/explore-event', [FrontendController::class, 'explore_event']);
Route::get('/detail/explore-event/{id}', [FrontendController::class, 'detail_explore_event']);
//penginapan
Route::get('/explore-penginapan', [FrontendController::class, 'explore_villa']);
Route::get('/explore-penginapan/search', [FrontendController::class, 'booking_search']);
Route::get('/explore-penginapan-detail/{id}', [FrontendController::class, 'explore_villa_detail']);
Route::get('/explore-hotel/{id}', [FrontendController::class, 'explore_hotel']);
Route::post('/explore-hotel/{id}', [FrontendController::class, 'check_hotel']);
//penyewaan tempat
Route::get('/explore-penyewaan-tempat', [FrontendController::class, 'explore_penyewaan_tempat']);
Route::get('/explore-penyewaan-tempat-detail/{id}', [FrontendController::class, 'explore_penyewaan_tempat_detail']);
//explore desa wisata
Route::get('/explore_desa_wisata', [FrontendController::class, 'explore_desa_wisata']);

//Explore kuliner
Route::get('/explore_kuliner',  [FrontendController::class, 'explore_kuliner']);

//profile
Route::resource('/profile', ProfileController::class)->middleware(['verified', 'customer']);
Route::put('/profile/updateprofil/{id}', [ProfileController::class, 'update'])->name('profile.update');
Route::put('/profile/updateimage/{id}', [ProfileController::class, 'update2'])->name('profile.update2');
Route::put('/profile/updatepassword/{id}', [ProfileController::class, 'update3'])->name('profile.update3');


//login admin
Route::get('/login-admin', [LoginAdminController::class, 'index'])->middleware('guest');
Route::post('/post-login', [LoginAdminController::class, 'login']);

Route::group([
    'middleware' => ['auth', 'pelanggan', 'verified'],
], function () {



    Route::get('/topup', [TopUpController::class, 'index'])->name('top.up');
    Route::post('/topup', [TopUpController::class, 'inputNominal'])->name('store.topup');
    Route::get('/pending/{id}', [TopUpController::class, 'pendingPay'])->name('pending');
    Route::post('/pending/{id}', [TopUpController::class, 'statusPay']);
    Route::get('/success/{id}', [TopUpController::class, 'successPay'])->name('status.success');



    Route::get('/mau/camping/{id}', [App\Http\Controllers\FrontendController::class, 'maucamping'])->name('mau.camping');
    Route::post('/mau/camping/pesan', [App\Http\Controllers\FrontendController::class, 'pesancamping'])->name('pesan.camping');
    Route::get('/my-tiket/print/{kode}', [App\Http\Controllers\FrontendController::class, 'print']);
    Route::post('/my-tiket/print/{kode}', [App\Http\Controllers\FrontendController::class, 'print'])->name('print.tiket');

    Route::get('/cart', [TiketController::class, 'cart'])->name('cart');
    Route::get('/cart/tambah/{kode}', [TiketController::class, 'do_tambah_cart'])->where("id", "[0-9]+");
    Route::post('/cart/tambah/{kode}', [TiketController::class, 'do_tambah_cart'])->where("id", "[0-9]+");

    Route::post('/cart/tambah/camp/{kode}', [TiketController::class, 'do_tambah_cart_camp'])->where("id", "[0-9]+");

    Route::get('/cart/tambah/camp/{kode}', [TiketController::class, 'do_tambah_cart_camp'])->where("id", "[0-9]+");
    Route::post('/cart/tambah/tiket/{id}', [TiketController::class, 'do_tambah_cart_tiket'])->where("id", "[0-9]+");
    Route::get('/cart/tambah/tiket/{id}', [TiketController::class, 'do_tambah_cart_tiket'])->where("id", "[0-9]+");

    Route::get('/cart/hapus/{kode}', [TiketController::class, 'do_hapus_cart'])->where("id", "[0-9]+");
    Route::get('/cart/hapus/camping/{kode}', [TiketController::class, 'do_hapus_cart_camping'])->where("id", "[0-9]+");

    Route::get('/transaksi/tambah', [TiketController::class, 'do_tambah_transaksi']);
    Route::post('/transaksi/tambah', [TiketController::class, 'do_tambah_transaksi']);
    Route::delete('/transaksi/batal/{kode}', [TiketController::class, 'do_batal_transaksi'])->name('transaksi.batal');

    Route::get('/cart/kuliner', [TiketController::class, 'cart_kuliner'])->name('cart.kuliner');
    Route::post('/cart/tambah/kuliner/{kode}', [TiketController::class, 'do_tambah_kuliner'])->where("id", "[0-9]+");
    Route::get('/cart/tambah/kuliner/{kode}', [TiketController::class, 'do_tambah_kuliner'])->where("id", "[0-9]+");
    Route::get('/cart/hapus/kuliner/{kode}', [TiketController::class, 'do_hapus_cart_kuliner'])->where("id", "[0-9]+");
    Route::get('/transaksi/tambah/kuliner', [TiketController::class, 'do_tambah_transaksi_kuliner'])->name('tambah.kuliner');
    Route::post('/transaksi/tambah/kuliner', [TiketController::class, 'do_tambah_transaksi_kuliner']);

    Route::get('/cart/camping', [TiketController::class, 'cart_camping'])->name('cart.camping');
    Route::post('/pilihcamping/{id}', [FrontendController::class, 'pilihcamping'])->where("id", "[0-9]+");
    Route::get('/pilihcamping/2/{id}', [FrontendController::class, 'pilihcamping2'])->where("id", "[0-9]+");
    Route::post('/pilihcamping/2/{id}', [FrontendController::class, 'pilihcamping2'])->where("id", "[0-9]+");
    Route::get('/transaksi/tambah/camping', [TiketController::class, 'do_tambah_transaksi_camping'])->name('tambah.camping');
    Route::post('/transaksi/tambah/camping', [TiketController::class, 'do_tambah_transaksi_camping']);

    Route::get('/cart/booking', [FrontendController::class, 'cart_booking'])->name('cart.booking');
    Route::post('/penginapanpesan/{kode}', [FrontendController::class, 'cart_tambah_booking'])->where("id", "[0-9]+");
    Route::get('/cart/hapus/penginapan/{kode}', [TiketController::class, 'do_hapus_cart_penginapan'])->where("id", "[0-9]+");
    Route::get('/transaksi/tambah/booking', [TiketController::class, 'do_tambah_transaksi_booking'])->name('tambah.booking');
    Route::post('/transaksi/tambah/booking', [TiketController::class, 'do_tambah_transaksi_booking']);

    //PESAN BUDGETING
    Route::get('/cart/budgeting', [TiketController::class, 'cart_budgeting'])->name('cart.budgeting');
    Route::post('/cart/tambah/budgeting/{id}', [TiketController::class, 'do_tambah_cart_budgeting']);
    Route::get('/cart/tambah/budgeting/{id}', [TiketController::class, 'do_tambah_cart_budgeting']);

    //pesanan
    Route::get('/pesananku', [PaymentController::class, 'pesananku'])->name('pesananku');
    Route::get('/pesanan/detail/{kode}', [PaymentController::class, 'pesananku_detail']);

    //pesan event
    Route::get('/explore-event-detail/{id}/{nama}/{harga}/{tgl_buka}/{tgl_tutup}/{kapasitas_akhir}/{kapasitas_awal}', [EventController::class, 'explore_event_detail']);
    Route::post('/pesantiketevent/{jml_orang}/{id}/{harga}/{nama_event}/{tgl_buka}/{tgl_tutup}', [EventController::class, 'pesantiketevent']);
    Route::get('/ratingevent/{kode}', [BookingEventController::class, 'rating']);
    Route::post('/create_ratingevent/{id}', [BookingEventController::class, 'tambah_rating']);
    Route::get('/detail/explore-event/komentar/delete/{id}', [BookingEventController::class, 'delete_rating']);
    Route::post('/komentar/update/{id}', [BookingEventController::class, 'update_rating']);

    //pesan villa
    Route::get('/explore-penginapan/booking/{checkin}/{checkout}/{id}', [VillaController::class, 'booking_villa']);
    Route::post('/pesan/villa/{id}/{checkin}/{checkout}/{durasi}', [VillaController::class, 'formpesan_villa']);
    Route::get('/ratingvilla/{kode}', [BookingVillaController::class, 'rating']);
    Route::post('/create_ratingvilla/{id}', [BookingVillaController::class, 'tambah_rating']);
    Route::get('/explore-penginapan-detail/komentartempat/delete/{id}', [BookingVillaController::class, 'delete_rating']);
    Route::post('/komentartempat/update/{id}', [BookingVillaController::class, 'update_rating']);

    //pesan tempat sewa
    Route::get('/pesan/tempatsewa/{id}', [TempatSewaController::class, 'booking_tempat']);
    Route::get('/explore-tempatsewa/search/{id}', [TempatSewaController::class, 'search_tempatsewa']);
    Route::get('/formpesan/tempatsewa/{checkin}/{checkout}/{id}', [TempatSewaController::class, 'form_booking']);
    Route::post('/pesan/tempatsewa/{id}/{checkin}/{checkout}/{durasi_jam}/{durasi_menit}/{biaya}', [TempatSewaController::class, 'pesan_tempatsewa']);
    Route::get('/ratingtempatsewa/{kode}', [TempatSewaController::class, 'rating']);
    Route::post('/create_ratingtempatsewa/{id}', [TempatSewaController::class, 'tambah_rating']);
    Route::get('/explore-penyewaan-tempat-detail/komentartempatsewa/delete/{id}', [TempatSewaController::class, 'delete_rating']);
    Route::post('/komentartempatsewa/update/{id}', [TempatSewaController::class, 'update_rating']);
});


Route::group([
    'middleware' => ['auth', 'admin', 'verified'],
    'prefix' => 'admin',

], function () {
    Route::resource('/admin', AdminController::class);
    Route::resource('/pelanggan', PelangganController::class);
    Route::resource('/tempat', TempatController::class);
    Route::resource('/pesananc', PesananController::class);
    Route::resource('/setting', SettingController::class);

    Route::get('/adana', [DanaController::class, 'acair'])->name('admin.dana');
    Route::get('/tempat/check_slug', [TempatController::class, 'checkSlug'])->name('tempat.checkSlug');

    Route::get('/status/update/{id}', [AdminController::class, 'toggleStatus'])->name('update.status.admin');
    Route::get('/status/update2/{id}', [PelangganController::class, 'toggleStatus'])->name('update.status.pelanggan');
    Route::get('/status/update3/{id}', [TempatController::class, 'toggleStatus'])->name('update.status.tempat');
    Route::get('/konfitmasi/dana/{id}', [DanaController::class, 'konfirmasi'])->name('konfirmasi.dana');
    Route::get('/konfitmasi/danatolak/{id}', [DanaController::class, 'tolak'])->name('penolakan.dana');

    Route::get('crop-about1',  [App\Http\Controllers\CropImageController::class, 'about1']);
    Route::post('crop-about1', [App\Http\Controllers\CropImageController::class, 'cropabout1'])->name('croppie.about1');
    Route::get('crop-about2',  [App\Http\Controllers\CropImageController::class, 'about2']);
    Route::post('crop-about2', [App\Http\Controllers\CropImageController::class, 'cropabout2'])->name('croppie.about2');
});


Route::group([
    'middleware' => ['auth', 'wisata', 'verified'],
    'prefix' => 'awisata',

], function () {
    Route::resource('/tiket', TiketController::class);
    Route::resource('/wisata', WisataController::class);
    Route::resource('/camping', CampingController::class);
    Route::resource('/wahana', WahanaController::class);
    Route::resource('/tempatATW', ATWController::class);

    Route::get('/rekapw', [RekapWController::class, 'rekapwisata'])->name('rekapw.index');
    Route::post('/rekapw', [RekapWController::class, 'sortw']);
    Route::get('/rekapw/print/{date}', [RekapWController::class, 'printwisata'])->name('print.rekapw');

    Route::get('/jadwalcamp', [JadwalCampController::class, 'index'])->name('jadwalcamp.index');

    Route::get('/tempatf', [ATWController::class, 'kuliner'])->name('tempatf.index');
    Route::post('/backcamp/{id}', [CampingController::class, 'backcamp'])->name('backcamp');
    Route::get('/order', [TiketController::class, 'order'])->name('order.index');
    Route::post('/order', [TiketController::class, 'sortOrder']);
    Route::get('/topup', [TopUpController::class, 'topup_list'])->name('topup.index');
    Route::get('/checkw', [TiketController::class, 'checkw'])->name('checkw.index');
    Route::post('/checkw', [TiketController::class, 'checkw'])->name('checkw.cek');
    Route::get('/checkwahana', [TiketController::class, 'checkwahana'])->name('checkwahana.index');
    Route::post('/checkwahana', [TiketController::class, 'checkwahana'])->name('checkwahana.cek');
    Route::resource('/dana', DanaController::class);
    // Route::post('/dana', DanaController::class, 'sortDana')->name('dana.sortdana');
    Route::post('/dana/cair', [DanaController::class, 'cair'])->name('dana.cair');
    Route::get('/update/kedatangan/{id}', [TiketController::class, 'updatekedatangan'])->name('update.kedatangan');
    Route::get('/status/update4/{id}', [WahanaController::class, 'toggleStatus'])->name('update.status.wahana');
    Route::get('/status/update5/{id}', [CampingController::class, 'toggleStatus'])->name('update.status.camp');
    Route::get('/status/update7/{id}', [ATWController::class, 'toggleStatus'])->name('update.status.atwkuliner');
});

Route::group([
    'middleware' => ['auth', 'desa', 'verified'],
    'prefix' => 'adesa',

], function () {
    Route::resource('/desa', DesaController::class);

    Route::get('/admind', [AdminController::class, 'indexd'])->name('admind.index');
    Route::get('/admind/create', [AdminController::class, 'created'])->name('admind.create');
    Route::get('/admind/{id}/edit', [AdminController::class, 'editd'])->name('admin.editd');
    Route::patch('/admind/update/{id}/', [AdminController::class, 'updated'])->name('admin.updated');

    Route::get('/tempatf', [ATWController::class, 'desa'])->name('tempatf.kelola');
    Route::get('/tempatd', [TempatController::class, 'indexd'])->name('tempat.indexd');
    Route::patch('/tempatd/{id}', [TempatController::class, 'updated'])->name('tempat.updated');
    Route::get('/tempatd/create', [TempatController::class, 'created'])->name('tempat.created');
    Route::get('/tempatd/{id}/edit', [TempatController::class, 'editd'])->name('tempat.editd');

    Route::post('/admin/stored', [AdminController::class, 'stored'])->name('admin.stored');
    Route::post('/tempat/stored', [TempatController::class, 'stored'])->name('tempat.stored');

    // Route::patch('/update/data/tempatd/{id}', [ATFController::class, 'updatedesa'])->name('update.data.desa');
    Route::get('/update/tempat/desa/{id}', [DesaController::class, 'toggleStatus'])->name('update.status.desa');
    Route::get('/status/updated/{id}', [TempatController::class, 'toggleStatus'])->name('update.status.tempatd');

    Route::get('/rekapd', [RekapWController::class, 'rekapdesa'])->name('rekapd.index');
    Route::post('/rekapd', [RekapWController::class, 'sortd']);
    Route::get('/rekapd/print/{date}', [RekapWController::class, 'printdesa'])->name('print.rekapd');

    // BUDGETING
    Route::get('/paketd/index', [AdminController::class, 'paketIndex'])->name('paketd.index');
    Route::get('/paketd/create', [AdminController::class, 'paketCreate'])->name('paketd.create');

    Route::post('/paketd/created', [AdminController::class, 'paketCreated'])->name('paketd.created');

    Route::get('/budgeting/index', [BudgetingController::class, 'index'])->name('budget.index');
    Route::get('/budgeting-create', [BudgetingController::class, 'createPaket'])->name('budget.create');
    Route::get('/budgeting-create-detail', [BudgetingController::class, 'detailPaket'])->name('budget.detail.create');
    Route::post('/insert-budgeting', [BudgetingController::class, 'store'])->name('store-budget');
    Route::get('/budgeting-edit/{id}', [BudgetingController::class, 'edit'])->name('budget.edit');
    Route::post('edit-status', [BudgetingController::class, 'editStatus'])->name('update-status');
    Route::post('/edit-paket', [BudgetingController::class, 'updatePaket'])->name('update-paket');
    Route::post('/get-paket', [BudgetingController::class, 'getPaket'])->name('get-data-paket');
    Route::post('/get-kamar', [BudgetingController::class, 'getKamar'])->name('get-data-kamar');
    Route::post('/get-menu', [BudgetingController::class, 'getMenu'])->name('get-data-menu');
});

Route::group([
    'middleware' => ['auth', 'kuliner', 'verified'],
    'prefix' => 'akuliner',

], function () {

    Route::get('/rekapk', [RekapWController::class, 'rekapkuliner'])->name('rekapk.index');
    Route::post('/rekapk', [RekapWController::class, 'sortk']);
    Route::get('/rekapk/print/{date}', [RekapWController::class, 'printkuliner'])->name('print.rekapk');

    Route::get('/tempatkuliner', [ATFController::class, 'kuliner'])->name('atf.kuliner');
    Route::get('/todaykuliner', [TodayController::class, 'todaykuliner'])->name('todaykuliner.index');
    Route::get('/todaykuliner/selesai/{id}', [TodayController::class, 'updatekulinerselesai'])->name('update.selesai.pesanank');
    Route::get('/todaykuliner/print/{today}', [TodayController::class, 'printkulinertoday'])->name('print.pesanank');
    Route::resource('/kuliner', KulinerController::class);
    Route::post('/update-status-kuliner', [KulinerController::class, 'editStatus'])->name('update.status.paket.kuliner');
    Route::resource('/paket', TbPaketkulinerController::class);
    // Route::get('/paket/{id}/edit', [TbPaketkulinerController::class, 'editPaket']);
    
    // Route::get('/paket/create', [TbPaketController::class, 'createPaket'])->name('paket.create');
    Route::get('/status/update9/{id}', [KulinerController::class, 'toggleStatus'])->name('update.status.kuliner');

    Route::get('/orderk', [TiketController::class, 'orderk'])->name('orderk.index');
    Route::get('/checkk', [TiketController::class, 'checkk'])->name('checkk.index');
    Route::post('/checkk', [TiketController::class, 'checkk']);
    Route::get('/update/kedatangank/{id}', [TiketController::class, 'updatekedatangank'])->name('update.kedatangank');
    Route::resource('/danak', DanakController::class);
    Route::post('/danak/cair', [DanakController::class, 'kuliner_cair'])->name('danak.cair');
    // Route::get('/status/update7/{id}', [ATFController::class, 'toggleStatus'])->name('update.status.atfkuliner');
    Route::get('/update/tempat/atfkuliner/{id}', [ATFController::class, 'toggleStatus'])->name('update.status.tempat.kuliner');
    // Route::post('/update/data/tempat{id}', [ATFController::class, 'updatekuliner'])->name('update.data.tempat.kuliner');
    Route::patch('/update/data/tempat{id}', [ATFController::class, 'updatekuliner'])->name('update.data.tempat.kuliner');

    // Route::resource('/kuliner', KulinerController::class);
});

Route::group([
    'middleware' => ['auth', 'penginapan', 'verified'],
    'prefix' => 'penginapan',

], function () {
    //rekapdta
    Route::get('/rekapp', [RekapWController::class, 'rekappenginapan'])->name('rekapp.index');
    Route::post('/rekapp', [RekapWController::class, 'sortp']);
    Route::get('/rekap/hotel/print/{date}', [RekapWController::class, 'rekap_hotel']);
    Route::get('/rekap/villa/print/{date}', [RekapWController::class, 'rekap_villa']);

    Route::patch('/update/datap/tempat{id}', [ATFController::class, 'updatepenginapan'])->name('update.data.tempat.penginapan');
    Route::get('/jadwalkamar', [JadwalKamarController::class, 'index'])->name('jadwalkamar.index');
    Route::get('/tempatpenginapan', [ATFController::class, 'penginapan'])->name('atf.penginapan');

    Route::resource('/hotel/kamar', KamarController::class);
    Route::resource('/hotel', HotelController::class);
    Route::get('/hotel/delete/{id}', [HotelController::class, 'destroy']);
    Route::get('/hotel/kamar/delete/{id}', [KamarController::class, 'destroy']);
    Route::get('/status/update/{id}', [HotelController::class, 'toggleStatus'])->name('update.status.hotel');
    Route::get('/status/update8/{id}', [KamarController::class, 'toggleStatus'])->name('update.status.kamar');
    Route::get('/booking', [TiketController::class, 'booking'])->name('booking.index');
    Route::get('/checkp', [TiketController::class, 'checkp'])->name('checkp.index');

    Route::post('/checkp', [TiketController::class, 'checkp']);
    Route::get('/update/kedatanganp/{id}', [TiketController::class, 'updatekedatanganp'])->name('update.kedatanganp');
    Route::get('/update/kedatanganp2/{id}', [TiketController::class, 'updatekedatanganp2'])->name('update.kedatanganp2');
    Route::resource('/danap', DanapController::class);
    Route::post('/danap/cair', [DanapController::class, 'penginapan_cair'])->name('danap.cair');
    Route::get('/update/tempat/atfpenginapan/{id}', [ATFController::class, 'toggleStatus'])->name('update.status.tempat.penginapan');

    //villa
    Route::resource('/villa', VillaController::class);
    Route::get('/villa/delete/{id}', [VillaController::class, 'destroy']);
    Route::get('/villa/update/status/{id}', [VillaController::class, 'toggleStatus'])->name('update.status.villa');
    Route::get('/villa/rekap_penyewa/{id}', [VillaController::class, 'rekap_penyewa']);
    Route::get('/villa/rekap_penyewa/print/{id}', [VillaController::class, 'print_penyewa']);

    //pemesanan tempat
    Route::get('/check_villa', [BookingVillaController::class, 'check_order']);
    Route::get('/todaypesanvilla', [TodayController::class, 'todaypesanvilla']);
    Route::get('/todayvilla/print/{today}', [TodayController::class, 'print_villa'])->name('print.today.villa');
    Route::get('/check_villa/update/status_checkin/{id}', [BookingVillaController::class, 'toggleStatus_checkin'])->name('update.status.bookingvilla0');
    Route::get('/check_villa/update/status_checkout/{id}', [BookingVillaController::class, 'toggleStatus_checkout'])->name('update.status.bookingvilla1');
    Route::get('/villa/updatestatusck/{id}', [BookingVillaController::class, 'toggleStatus_intodayck'])->name('update.status.cktempat');
    Route::get('/villa/updatestatusco/{id}', [BookingVillaController::class, 'toggleStatus_intodayco'])->name('update.status.cotempat');

    //booking villa
    Route::resource('/order_villa', BookingVillaController::class);
    Route::get('/bookingvilla/{id}/destroy', [BookingVillaController::class, 'destroy']);
});


Route::group([
    'middleware' => ['auth', 'event.sewatempat', 'verified'],

], function () {
    //tempat
    Route::get('/dashboard/tempatadmin', [ATFController::class, 'event_tempatsewa'])->name('atf.event');
    Route::get('/dashboard/update/tempat/{id}', [ATFController::class, 'toggleStatus'])->name('update.status.tempat.event');
    Route::patch('/dashboard/update/datae/tempat{id}', [ATFController::class, 'updateevent'])->name('update.data.tempat.event');

    //kategori event
    Route::get('/kategorievent', [EventController::class, 'index_kategorievent']);
    Route::post('/kategorievent/create', [EventController::class, 'create_kategorievent']);
    Route::post('/kategorievent/{id}/update', [EventController::class, 'update_kategorievent']);
    Route::get('/kategorievent/{id}/delete', [EventController::class, 'delete_kategorievent']);

    //data event
    Route::get('/adminevent', [EventController::class, 'index_event']);
    Route::post('/event/create', [EventController::class, 'create_event']);
    Route::get('/event/update/status/{id}', [EventController::class, 'toggleStatus'])->name('update.status.event');
    Route::get('/adminevent/detail/{id}', [EventController::class, 'detail_event']);
    Route::post('/event/{id}/update', [EventController::class, 'update_event']);
    Route::get('/event/{id}/delete', [EventController::class, 'delete_event']);
    Route::get('adminevent/rekap_pesertaevent/{id}', [EventController::class, 'rekap_pesertaevent']);
    Route::get('adminevent/rekap_pesertaevent/print/{id}', [EventController::class, 'print_pesertaevent']);
    Route::get('/adminevent/calender', [EventController::class, 'calender_event']);
    Route::get('/jscalender', [EventController::class, 'jscalender']);

    //pemesanan event
    Route::get('/check_order', [BookingEventController::class, 'check_order']);
    Route::get('/todaypesanevent', [TodayController::class, 'todaypesanevent']);
    Route::get('/todayevent/print/{today}', [TodayController::class, 'print_event'])->name('print.today.event');
    Route::get('/bookingevent/update/status_checkin/{id}', [BookingEventController::class, 'toggleStatus_checkin'])->name('update.status.bookingevent0');
    Route::get('/bookingevent/update/status_checkout/{id}', [BookingEventController::class, 'toggleStatus_checkout'])->name('update.status.bookingevent1');
    Route::get('/bookingevent/updatestatusck/{id}', [BookingEventController::class, 'toggleStatus_intodayck'])->name('update.status.intodayck');
    Route::get('/bookingevent/updatestatusco/{id}', [BookingEventController::class, 'toggleStatus_intodayco'])->name('update.status.intodayco');
    Route::get('/pesertaevent/update/status_checkin/{id}', [BookingEventController::class, 'kedatangan_peserta'])->name('update.status.pesertaevent');

    //pemesanan tempat sewa
    Route::get('/check_tempatsewa', [TempatSewaController::class, 'check_tempatsewa']);
    Route::get('/check_tempatsewa/update/status_checkin/{id}', [TempatSewaController::class, 'toggleStatus_checkin'])->name('update.status.bookingtempatsewa0');
    Route::get('/check_tempatsewa/update/status_checkout/{id}', [TempatSewaController::class, 'toggleStatus_checkout'])->name('update.status.bookingtempatsewa1');
    Route::get('/jadwalsewa', [TempatSewaController::class, 'jadwal_sewa']);

    //data tempat sewa
    Route::resource('/tempatsewa', TempatSewaController::class);
    Route::get('/status/update/{id}', [TempatSewaController::class, 'toggleStatus'])->name('update.status.tempatsewa');
    Route::get('/tempatsewa/delete/{id}', [TempatSewaController::class, 'destroy']);
    Route::post('/tambah/ruang/', [TempatSewaController::class, 'tambah_ruang']);
    Route::post('/update/ruang/{id}', [TempatSewaController::class, 'update_ruang']);
    Route::get('/hapus/ruang/{id}', [TempatSewaController::class, 'hapus_ruang']);
    Route::get('/status/update/ruang/{id}', [TempatSewaController::class, 'toggleStatus_ruang'])->name('update.status.ruang');

    //bookingall
    Route::get('/booking/eventtempatsewa', [TiketController::class, 'booking_event_tempatsewa']);


    //booking event
    Route::resource('/bookingevent', BookingEventController::class);
    Route::get('/bookingevent/{id}/destroy', [BookingEventController::class, 'destroy']);

    //rekap data
    Route::view('/rekapdata_ep', 'admin.booking.rekap');
    Route::post('/rekapdata_ep', [RekapWController::class, 'sort_event']);
    Route::get('/rekapdata_ep/print/{date}/events', [RekapWController::class, 'print_event']);
    Route::get('/rekapdata_ep/print/{date}/tempatsewa', [RekapWController::class, 'print_tempatsewa']);

    //halaman review
    Route::view('/review', 'admin.booking.halaman_penilaian');
    //review event
    Route::get('/reviewevent', [EventController::class, 'review_index']);
    Route::get('/reviewevent/hapus/{id}', [EventController::class, 'review_delete']);
    //review tempatsewa
    Route::get('/reviewtempatsewa', [TempatSewaController::class, 'review_index']);
    Route::get('/reviewtempatsewa/hapus/{id}', [TempatSewaController::class, 'review_delete']);
});

// BUDGETING


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified')->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('verified')->name('dashboard');
Route::get('/qrcode/{kode}', [App\Http\Controllers\ProfileController::class, 'qrcode'])->middleware('verified')->name('qrcode.kode');
Route::get('/event', [App\Http\Controllers\FrontendController::class, 'event']);
Route::get('/event/{slug}', [App\Http\Controllers\FrontendController::class, 'eventtempat']);

Route::resource('/pay', PaymentController::class)->middleware('verified');
Route::get('/getevent', [App\Http\Controllers\FullCalendarController::class, 'getEvent'])->middleware('verified');
Route::post('/createevent', [App\Http\Controllers\FullCalendarController::class, 'createEvent']);
Route::post('/deleteevent',  [App\Http\Controllers\FullCalendarController::class, 'deleteEvent']);
Route::get('/full-calender', [App\Http\Controllers\FullCalendarController::class, 'index'])->middleware('verified');
Route::post('/full-calender/action', [App\Http\Controllers\FullCalendarController::class, 'action']);


Route::get('/{slug}', [FrontendController::class, 'tempatshow'])->name('front.showd');
Route::post('/budgeting/{id}', [FrontendController::class, 'budgeting'])->name('front.budget');
Route::post('/get-budgeting', [FrontendController::class, 'budgeting'])->name('front.get-budget');
Route::get('/wisata/{slug}', [FrontendController::class, 'tempatshow'])->name('front.showw');
Route::get('/penginapan/{slug}', [FrontendController::class, 'tempatshow'])->name('front.showh');
Route::get('/kuliner/{slug}', [FrontendController::class, 'tempatshow'])->name('front.showk');
Route::get('/event & sewa tempat/{slug}', [FrontendController::class, 'tempatshow']);
Route::post('/tiket/{name}', [TiketController::class, 'beli'])->name('tiket.beli');
Route::get('/logout2', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout2');

//Pembayaran Midrrans
Route::get('/bayar', [PaymentController::class, 'index'])->middleware('verified');
Route::get('/bayar/{id}', [PaymentController::class, 'bayar'])->middleware('verified');
Route::post('/bayar/{id}', [PaymentController::class, 'bayar']);
Route::get('/bayar/snapfinish', [PaymentController::class, 'finish'])->middleware('verified');
Route::post('/bayar/snapfinish/store', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/bayar/status/{kode}', [PaymentController::class, 'status'])->name('bayar_status')->middleware('verified');
Route::post('/bayar/status/update/{kode}', [PaymentController::class, 'update'])->name('payment.update');
Route::post('/bayar/cancel/{kode}', [PaymentController::class, 'cancel'])->name('payment.cancel');
Route::get('/bayar/astatus/{kode}', [PaymentController::class, 'astatus'])->name('admin_bayar_status')->middleware('verified');

Route::get('/checkpenginapan/{id}', [FrontendController::class, 'checkpenginapan']);
Route::post('/checkpenginapan/{id}', [FrontendController::class, 'checkpenginapan']);
Route::get('/mau/nginap', [App\Http\Controllers\FrontendController::class, 'pilihkamar'])->name('pilih.kamar');
Route::post('/mau/nginap/pesan', [App\Http\Controllers\FrontendController::class, 'pesankamar'])->name('pesan.kamar');
Route::get('/mau/nginap/pesan', [App\Http\Controllers\FrontendController::class, 'pesankamar']);
Route::get('/vt_transaction',  [App\Http\Controllers\TransactionController::class, 'transaction'])->middleware('verified');
Route::post('/vt_transaction', [App\Http\Controllers\TransactionController::class, 'transaction_process']);

Route::get('crop-image-upload',  [App\Http\Controllers\CropImageController::class, 'editgambar'])->middleware('verified');
Route::get('crop-image-upload2',  [App\Http\Controllers\CropImageController::class, 'editgambar2'])->middleware('verified');
Route::get('video-upload',  [App\Http\Controllers\TempatController::class, 'indexvideo'])->middleware('verified');
Route::any('video-upload2',  [App\Http\Controllers\TempatController::class, 'videoupload'])->name('video-upload2')->middleware('verified');

Route::post('crop-image-before-upload-using-croppie', [App\Http\Controllers\CropImageController::class, 'uploadCropImage2'])->name('croppie.upload-image');
Route::resource('/kegiatan', KegiatanController::class)->middleware('verified');
Route::get('/status/update/kegiatan/{kode}', [KegiatanController::class, 'toggleStatus'])->name('update.status.kegiatan')->middleware('verified');