<?php

use Illuminate\Http\Request;



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

Route::get('/', 'GlavniController@kategorije')->name('naslovna');
Route::get('/{url}/teme','GlavniController@teme_kategorije')->name('teme');
Route::get('/zadnje_teme','GlavniController@zadnje_teme')->name('zadnje.teme');
Route::get('tema/{slug}','GlavniController@tema_komentari')->name('komentari_na_temu');
Route::post('/kreiraj_temu/{id}','GlavniController@kreiraj_temu')->name('kreiraj_temu')->middleware('auth');
Route::post('/ostavi_komentar/{id}','GlavniController@ostavi_komentar')->name('ostavi_komentar')->middleware('auth');
Route::get('/korisnik/{slug}','GlavniController@teme_korisnika')->name('teme_korisnika');
Route::get('/korisnik/{slug}/komentari','GlavniController@komentari_korisnika')->name('komentari_korisnika');
Route::get('/pretraga','GlavniController@pretrazi_teme')->name('pretrazi.teme');
Route::get('komentari_zadnja/{slug}', 'DashboardController@komentari_zadnja')->name('komentari.zadnja');
Auth::routes();
Route::get('/profil', 'DashboardController@panel')->name('panel');
Route::get('/promjena_lozinke', 'DashboardController@promjena_lozinke_form')->name('promjena_lozinke_form');
Route::post('/promijeni_lozinku', 'DashboardController@promijeni_lozinku')->name('promijeni_lozinku');
Route::get('/admin_panel', 'DashboardController@admin_panel')->name('admin.panel');
Route::put('/img_up', 'DashboardController@image_upload')->name('image.upload');
Route::put('/postavi_img','DashboardController@set_profile_image')->name('postavi.img');
Route::get('/slika_profila','DashboardController@change_profile_img_link')->name('slika.profila');
Route::delete('/delete_img','DashboardController@delete_profile_image')->name('delete.img');
Route::post('/napravi_kategoriju', 'DashboardController@napravi_kategoriju')->name('napravi.kategoriju');
Route::delete('/izbrisi_kategoriju', 'DashboardController@izbrisi_kategoriju')->name('izbrisi.kategoriju');
Route::post('/kategorija_postoji', 'DashboardController@kategorija_postoji')->name('kategorija.postoji');
Route::delete('/izbrisi_temu', 'GlavniController@izbrisi_temu')->name('izbrisi.temu')->middleware('auth');
Route::delete('/izbrisi_komentar', 'GlavniController@izbrisi_komentar')->name('izbrisi.komentar')->middleware('auth');
