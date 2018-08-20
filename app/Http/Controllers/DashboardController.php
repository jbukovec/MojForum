<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\slikaProfila;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Tema;
use App\Kategorija;
use App\Komentar;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function panel()
    {
        $teme_novi_komentari = Auth::user()->teme()->with(['komentari' => function($q){
            $q->where('pogledano', false)->where('user_id','!=', Auth::id());
            $q->with('user');
        }])->whereHas('komentari', function($q){
            $q->where('pogledano', false)->where('user_id','!=', Auth::id());
        })->get();

            return view('panel')->with('teme_novi_komentari',$teme_novi_komentari);
    }

    public function pogledano(Request $request){
        $tema = Tema::find($request->id);
        if (isset($tema)) { 
            if($tema->user_id == Auth::id()){
                $tema->komentari()->where('pogledano', false)->update(['pogledano'=>true]);
                return response()->json(['success' => true]);
            }
            else{
                return response()->json(['success' => false]);
            }
        }
        else{
            return response()->json(['success' => false]);
        }
    }

    public function admin_panel()
    {
        if (Auth::user()->is_admin == 1) {
            $kategorije = Kategorija::all();
            return view('admin_panel')->with('kategorije', $kategorije);
        } else {
            return redirect()->route('panel');
        }
    }

    public function image_upload(Request $request)
    {
        if ($request->has('image')) {

            /*$request->validate(['image'=>'image|max:1999']);*/

            Validator::make($request->all(), [
                'image' => 'image|max:1999',
            ],
            [
                'image' => 'Datoteka koju odaberete mora biti slika i ne smije biti veća od 2 MB!',
            ])->validate();

            $img = $request->file('image');
            $img_name = str_replace(' ', '_', substr(pathinfo($img->getClientOriginalName(), PATHINFO_FILENAME), 0, 50));
            $img_name = str_replace(['č', 'ć', 'ž', 'š', 'đ'], ['c', 'c', 'z', 's', 'd'], $img_name) . '_' . time() . '.jpg';
            Image::make($img)->fit(400, 400)->save('storage/' . Auth::user()->name . '/' . $img_name);
            $user = Auth::user();
            $user->naziv_slike = $img_name;
            $user->save();
            $slika_profila = new slikaProfila();
            $slika_profila->user_id = Auth::id();
            $slika_profila->naziv_profilne_slike = $img_name;
            $slika_profila->save(); 

            return redirect()->back()->with('status', 'Slika je uspješno postavljena!');
        } else {
            return redirect()->back()->withErrors(['Niste odabrali sliku za upload!']);
        }
    }

    public function set_profile_image(Request $request)
    {
        $user = Auth::user();
        $user->naziv_slike =  $request->profilna_slika;
        $user->save();
        return redirect()->back()->with('status','Slika Vašeg profila je uspješno promijenjena!');
    }

    public function change_profile_img_link()
    {
        $slike_profila = Auth::user()->profilne_slike()->get();
        return view('profile_img_change')->with('slike_profila',$slike_profila);
    }
    public function delete_profile_image(Request $request) 
    {
        $slika_za_brisanje = Auth::user()->profilne_slike()->find($request->img_id);
        if(!($slika_za_brisanje->naziv_profilne_slike == Auth::user()->naziv_slike)){
        $img_path= 'public/'.Auth::user()->name.'/'.$slika_za_brisanje->naziv_profilne_slike;
        Storage::delete($img_path);
        $slika_za_brisanje->delete();
        return redirect()->back()->with('status', 'Slika izbrisana!');
        }
    }
    public function promjena_lozinke_form()
    {
        return view('auth.passwords.change_password');
    }

    public function promijeni_lozinku(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return redirect()->back()->with("error","Vaša sadašnja lozinka i lozinka koju ste unjeli se ne poklapaju. Molimo Vas pokušajte ponovo.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            return redirect()->back()->with("error","Nova lozinka ne smije biti ista kao i Vaša sadašnja. Molimo Vas odaberite drugu lozinku.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
 
        return redirect()->back()->with("status","Uspješno ste promjenili lozinku!");
    }  

    public function napravi_kategoriju(Request $request)
    {   
        if (Auth::user()->is_admin == 1) {

        Validator::make($request->all(), [
            'naziv' => 'required|unique:kategorije,naziv_kategorije|unique:kategorije,url_naziv',
        ],
        [   'naziv.required' => 'Naziv kategorije je obavezan!',
            'naziv.unique' => 'Naziv kategorije već postoji. Naziv kategorije mora biti jedinstven!',
        ])->validate();

        $url_naziv = strtolower(str_replace(['Č', 'Ć', 'Ž', 'Š', 'Đ', 'č', 'ć', 'ž', 'š', 'đ'], ['C', 'C', 'Z', 'S', 'D', 'c', 'c', 'z', 's', 'd'], $request->naziv));
        $url_naziv = preg_replace('([^a-zA-Z0-9\']+)', '-', $url_naziv);
        $url_naziv = str_replace("'",'', $url_naziv);        
        if ($url_naziv[strlen($url_naziv) - 1] == '-') {
            $url_naziv = substr_replace($url_naziv, "", -1);
        }        
        $request->merge(['url_naziv'=> $url_naziv]);

        Validator::make($request->all(), [
            'url_naziv' => 'required|unique:kategorije,url_naziv',
        ],
        [
            'url_naziv.required' => 'Url kategorije je obavezan!',
            'url_naziv.unique' => 'Url kategorije već postoji. Url kategorije mora biti jedinstvena vrijednost!',
        ])->validate();

        $nova_kategorija = new Kategorija();
        $nova_kategorija->naziv_kategorije = $request->naziv;
        $nova_kategorija->url_naziv = $request->url_naziv; 
        $nova_kategorija->save();
        return redirect()->back()->with('status', 'Nova kategorija je uspješno napravljena!');
        }
        else {
            return redirect()->back()->with('error', 'Nemate dozvole super administratora!');
        }
    }

    public function kategorija_postoji(Request $request){
        if (Auth::user()->is_admin == 1) {
            $url_naziv = strtolower(str_replace(['Č', 'Ć', 'Ž', 'Š', 'Đ', 'č', 'ć', 'ž', 'š', 'đ'], ['C', 'C', 'Z', 'S', 'D', 'c', 'c', 'z', 's', 'd'], $request->naziv));
            $url_naziv = preg_replace('([^a-zA-Z0-9\']+)', '-', $url_naziv);
            $url_naziv = str_replace("'",'', $url_naziv);        
            if ($url_naziv[strlen($url_naziv) - 1] == '-') {
                $url_naziv = substr_replace($url_naziv, "", -1);
            }   

            $kategorija = Kategorija::where('naziv_kategorije', $request->naziv)->count();
            $url = Kategorija::where('url_naziv', $url_naziv)->count();
            if($kategorija != 0 || $url != 0){
                return Response::json(['postoji' => true]);
            }
            else {
                return Response::json(['postoji' => false]);
            }
        }
    }

    public function izbrisi_kategoriju(Request $request)
    {
        if (Auth::user()->is_admin == 1) {
            $kategorija = Kategorija::findOrFail($request->id_kategorije);
            $kategorija->delete();
            return redirect()->back()->with('status', 'Kategorija je uspješno izbrisna!');
        }
    }

    public function uredi_kategoriju(Request $request){

        if (Auth::user()->is_admin == 1) {

            Validator::make($request->all(), [
                'novi_naziv' => 'required|unique:kategorije,naziv_kategorije|unique:kategorije,url_naziv',
            ],
            [   'novi_naziv.required' => 'Naziv kategorije je obavezan!',
                'novi_naziv.unique' => 'Naziv kategorije već postoji. Naziv kategorije mora biti jedinstven!',
            ])->validate();
    
            $url_naziv = strtolower(str_replace(['Č', 'Ć', 'Ž', 'Š', 'Đ', 'č', 'ć', 'ž', 'š', 'đ'], ['C', 'C', 'Z', 'S', 'D', 'c', 'c', 'z', 's', 'd'], $request->novi_naziv));
            $url_naziv = preg_replace('([^a-zA-Z0-9\']+)', '-', $url_naziv);
            $url_naziv = str_replace("'",'', $url_naziv);        
            if ($url_naziv[strlen($url_naziv) - 1] == '-') {
                $url_naziv = substr_replace($url_naziv, "", -1);
            }        
            $request->merge(['url_naziv'=> $url_naziv]);
    
            Validator::make($request->all(), [
                'url_naziv' => 'required|unique:kategorije,url_naziv',
            ],
            [
                'url_naziv.required' => 'Url kategorije je obavezan!',
                'url_naziv.unique' => 'Url kategorije već postoji. Url kategorije mora biti jedinstvena vrijednost!',
            ])->validate();
    
            $kategorija = Kategorija::findOrFail($request->id_kategorije);
            $kategorija->naziv_kategorije = $request->novi_naziv;
            $kategorija->url_naziv = $request->url_naziv;
            $kategorija->save();

            return redirect()->back()->with('status', 'Naziv kategorije je uspješno promjenjen!');
            }
            else {
                return redirect()->back()->with('error', 'Nemate dozvole super administratora!');
            }

    }

}
