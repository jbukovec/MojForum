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
            $teme_novi_komentari = Auth::user()->teme()->with(['komentari' => function($q){$q->where('pogledano', false)->where('user_id','!=', Auth::id());}])->whereHas('komentari', function($q){$q->where('pogledano', false)->where('user_id','!=', Auth::id());})->get();
            return view('panel')->with('teme_novi_komentari',$teme_novi_komentari);
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
                'image' => 'image',
            ],
            [
                'image' => 'Datoteka koju ste izabrali nije slika!.',
            ])->validate();

            $img = $request->file('image');
            $img_name = pathinfo($img->getClientOriginalName(), PATHINFO_FILENAME) . '_' . time() . '.jpg';
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

    function napravi_kategoriju(Request $request)
    {

        $request->validate([
            'naziv' => 'required',
        ]);

        if (Auth::user()->is_admin == 1) {
        $nova_kategorija = new Kategorija();
        $nova_kategorija->naziv_kategorije = $request->naziv;
        $url_naziv = str_replace(' ', '_', strtolower($request->naziv));
        $url_naziv = str_replace(['č', 'ć', 'ž', 'š', 'đ'], ['c', 'c', 'z', 's', 'd'], $url_naziv);
        $nova_kategorija->url_naziv = $url_naziv; 
        $nova_kategorija->save();
        return redirect()->back()->with('status', 'Nova kategorija je uspješno napravljena!');
        }
    }
    function izbrisi_kategoriju($id)
    {
        if (Auth::user()->is_admin == 1) {
            $kategorija = Kategorija::findOrFail($id);
            $kategorija->delete();
            return redirect()->back()->with('status', 'Kategorija je uspješno izbrisna!');
        }
    }
    function komentari_zadnja($id)
    {
        $komentari = Komentar::with('user')->where('tema_id', $id)->orderBy('created_at', 'asc')->paginate(15);
        return redirect('tema/'. $id .'/komentari' . '?page=' . $komentari->lastPage());
    }

}
