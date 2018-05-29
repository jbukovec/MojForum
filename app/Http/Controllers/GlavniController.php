<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Kategorija;
use App\Tema;
use App\Komentar;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class GlavniController extends Controller
{
   /* public function __construct()
    {
        $this->middleware('auth',['except' => ['kategorije','teme_kategorija']]);
    }*/

    public function kategorije()
    {
        $kategorije = Kategorija::with('teme')->get();
        return view('welcome')->with('kategorije', $kategorije);
    }
    public function teme_kategorije($url)
    {
        $kategorija = Kategorija::where('url_naziv', $url)->firstOrFail();
        $teme = Tema::with('user','komentari','kategorija')->where('kategorija_id', $kategorija->id)->orderBy('created_at', 'desc')->paginate(25); //desc je novije
        return view('teme')->with('teme', $teme)->with('id', $kategorija->id);
    }
    public function zadnje_teme()
    {
        $teme = Tema::with('user','komentari','kategorija')->orderBy('created_at', 'desc')->paginate(25); //desc je novije
        return view('teme')->with('teme', $teme)->with('id', 0);
    }
    public function komentari_teme($id)
    {
        $komentari= Komentar::with('user')->where('tema_id', $id)->orderBy('created_at', 'asc')->paginate(15);
        $tema= Tema::findOrFail($id);
        $context = ['komentari'=>$komentari, 'tema'=>$tema];

        if(Auth::check()){
            if($tema->user_id == Auth::id()){
                $komentari_ids = [];
                foreach ($komentari as $komentar) {
                    array_push($komentari_ids, $komentar->id);
                }
                if (count($komentari_ids) > 0){
                Komentar::where('tema_id', $id)->whereIn('id', $komentari_ids)->where('pogledano', false)->update(['pogledano' => true]);
            }
            }
        }
        return view('komentari')->with($context);

    }  
    public function kreiraj_temu(Request $request, $id)
    {
        Validator::make($request->all(), [
            'naslov' => 'required|max:255',
            'opis' => 'required',
        ], ['required' => 'Polje :attribute je obavezno.',
            'max' => 'Naslov je prevelik! Maksimalno 255 zankova.'])->validate();
        $nova_tema = new Tema;
        $nova_tema->naslov_teme = $request->naslov;
        $nova_tema->opis_teme = $request->opis;
        $nova_tema->kategorija_id = $id;
        $nova_tema->user_id = auth()->id();
        $nova_tema->save();
        return redirect()->back()->with('status', 'Tema je uspješno postavljena!');
    }

    public function ostavi_komentar(Request $request, $id)
    {
        Validator::make($request->all(), [
            'komentar' => 'required',
        ], ['required' => 'Polje komentara je obavezno.'])->validate();

        $novi_komentar = new Komentar;
        $novi_komentar->tekst_komentara = $request->komentar;
        $novi_komentar->tema_id = $id;
        $novi_komentar->user_id = auth()->id();
        $novi_komentar->save();
        return redirect()->back()->with('status', 'Komentar uspješno objavljen');
    }
    public function teme_korisnika($id)
    {
        $teme = Tema::where('user_id', $id)->paginate(25);
        $user = User::findOrFail($id);
        $context = [
            'teme' => $teme,
            'user' => $user,
        ];
        return view('teme_korisnika')->with($context);
    }

    public function komentari_korisnika($id)
    {
        $komentari = Komentar::with('tema')->where('user_id', $id)->paginate(25);
        $user = User::findOrFail($id);
        $context = [
            'komentari' => $komentari,
            'user' => $user,
        ];
        return view('komentari_korisnika')->with($context);
    }
    public function pretrazi_teme(Request $request)
    {
        $teme = Tema::search($request->q)->paginate(1)->appends($request->query());
        $teme->load('komentari', 'user');
        //$pretraga = Tema::search($request->q)->get();
        //$teme = Tema::with('user', 'komentari')->whereIn('id', $pretraga->pluck('id'))->paginate(25)->appends(request()->query());
        return view('teme')->with('teme', $teme)->with('id', $request->q);
    }
}
