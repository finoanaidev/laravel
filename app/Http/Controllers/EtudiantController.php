<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etudiants = Etudiant::all();
        return response()->json($etudiants);
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
        $validator = Validator::make($request->all(),
    [
        'nom'=> ['required', 'min:3', 'max:150', 'string'],
        'prenom' => ['required', 'string',  'max:150', 'min:3'],
        'email' => ['required', 'string',  'max:150', 'min:3'],
        'sexe' => ['required', 'string',  'max:1'],
        'telephone' => ['required', 'string',  'max:150', 'min:3'],
        'niveau' => ['required', 'string',  'min:2' ],
        'filiere' => ['required', 'string',  'min:2' ],
        'profession_pere' => ['required', 'string',  'max:150', 'min:3'],
        'profession_mere' => ['required', 'string',  'max:150', 'min:3'],
        'date_naissance' => ['required', 'string',  'max:150', 'min:3'],
        'etablissement_origine' => ['required', 'string',  'max:150', 'min:3']
    ]);

    if($validator->fails()){
        return response()->json(['errors' => $validator->errors()], 401);
    }

        $etudiant = Etudiant::create([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'date_naissance' => $request->input('date_naissance'),
            'email' => $request->input('email'),
            'sexe' => $request->input('sexe'),
            'niveau' => $request->input('niveau'),
            'filiere' => $request->input('filiere'),
            'telephone' => $request->input('telephone'),
            'profession_pere' => $request->input('profession_pere'),
            'profession_mere' => $request->input('profession_mere'),
            'etablissement_origine' => $request->input('etablissement_origine'),
            'nom_entreprise' => $request->input('nom_entreprise'),
            'duree' => $request->input('duree'),
            'user_id' => 1
        ]);

        return response()->json($etudiant);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $etudiant = Etudiant::find($id);
        /*if(!$etudiant){
            return response()->json(['message'=> 'errors'], 403);
        }*/

        return $etudiant;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $etudiant =Etudiant::find($id);
        return $etudiant;
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
        $etudiant= Etudiant::find($id);
        $etudiant->nom = $request->nom;
        $etudiant->prenom = $request->prenom;
        $etudiant->date_naissance = $request->date_naissance;
        $etudiant->email = $request->email;
        $etudiant->sexe = $request->sexe;
        $etudiant->niveau = $request->niveau;
        $etudiant->filiere = $request->filiere;
        $etudiant->telephone = $request->telephone;
        $etudiant->profession_pere = $request->profession_pere;
        $etudiant->profession_mere = $request->profession_mere;
        $etudiant->etablissement_origine = $request->etablissement_origine;
        $etudiant->nom_entreprise = $request->nom_entreprise;
        $etudiant->duree = $request->duree;
        $etudiant->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $etudiant = Etudiant::find($id)->delete();  
    }

    public function niveau (){
        $niveau = Etudiant::where('niveau', '=', 'L1')->where('abandon','=','0')->get();
        return response()->json($niveau);
        //$nbr = Etudiant::where('niveau', '=', 'L1')->count();
    //     return response()->json([
    //         'niveau' => $niveau,
    //         'nbr' => $nbr,
    //     ]);
    }

    public function niveau2()
    {
        $niveau2 = Etudiant::where('niveau', '=', 'L2')->where('abandon','=','0')->get();
        return response()->json($niveau2);
    }

    public function niveau3()
    {
        $niveau3 = Etudiant::where('niveau', '=', 'L3')->where('abandon','=','0')->get();
        return response()->json($niveau3);
    }

    public function niveau4()
    {
        $niveau4 = Etudiant::where('niveau', '=', 'M1')->where('abandon','=','0')->get();
        return response()->json($niveau4);
    }

    public function niveau5()
    {       
        $niveau5 = Etudiant::where('niveau', '=', 'M2')->where('abandon','=','0')->get();
        return response()->json($niveau5); 
    }
    
    public function search(Request $request)
    {
        $param = $request->input('search');
        if($param){
            $etudiants = Etudiant::where('prenom', 'like', '%' . $param . '%')->where('abandon','=','0')->get();
        } else {
            $etudiants = Etudiant::all();
        }
        return response()->json($etudiants);
   }
   public function feminin()
    {       
        $feminin = Etudiant::where('sexe', '=', 'F')->where('abandon','=','0')->get();
        return response()->json($feminin); 
    }

    public function masculin()
    {       
        $masculin = Etudiant::where('sexe', '=', 'M')->where('abandon','=','0')->get();
        return response()->json($masculin); 
    } 
    
    public function statistique()
    {       
        $statistique = Etudiant::where('abandon', '=', '1')->count();
        return response()->json($statistique); 
    }

    public function abandon()
    {       
        $abandon = Etudiant::where('abandon', '=', '1')->get();
        return response()->json($abandon); 
    }
    public function masculinL1()
    {
    $masculinL1= Etudiant::where('niveau','=','L1')->where('sexe','=','M')->where('abandon','=','0')->get();
    return response()->json($masculinL1);
}   
public function masculinL2()
{
$masculinL2= Etudiant::where('niveau','=','L2')->where('sexe','=','M')->where('abandon','=','0')->get();
return response()->json($masculinL2);
}   
public function masculinL3()
{
$masculinL3= Etudiant::where('niveau','=','L3')->where('sexe','=','M')->where('abandon','=','0')->get();
return response()->json($masculinL3);
}   
public function masculinM1()
{
$masculinM1= Etudiant::where('niveau','=','M1')->where('sexe','=','M')->where('abandon','=','0')->get();
return response()->json($masculinM1);
}   
public function masculinM2()
{
$masculinM2= Etudiant::where('niveau','=','M2')->where('sexe','=','M')->where('abandon','=','0')->get();
return response()->json($masculinM2);
}   
public function femininL3()
{
$femininL3= Etudiant::where('niveau','=','L3')->where('sexe','=','F')->where('abandon','=','0')->get();
return response()->json($femininL3);
}   
public function femininL1()
{
$femininL1= Etudiant::where('niveau','=','L1')->where('sexe','=','F')->where('abandon','=','0')->get();
return response()->json($femininL1);
}   
public function femininL2()
{
$femininL2= Etudiant::where('niveau','=','L2')->where('sexe','=','F')->where('abandon','=','0')->get();
return response()->json($femininL2);
}   
public function femininM1()
{
$femininM1= Etudiant::where('niveau','=','M1')->where('sexe','=','F')->where('abandon','=','0')->get();
return response()->json($femininM1);
}   
public function femininM2()
{
$femininM2= Etudiant::where('niveau','=','M2')->where('sexe','=','F')->where('abandon','=','0')->get();
return response()->json($femininM2);
}   
public function devfeminin()
{
$devfeminin= Etudiant::where('filiere','=','DEV')->where('sexe','=','F')->where('abandon','=','0')->get();
return response()->json($devfeminin);
}   
public function msifeminin()
{
$msifeminin= Etudiant::where('filiere','=','MSI')->where('sexe','=','F')->where('abandon','=','0')->get();
return response()->json($msifeminin);
}   
public function rsifeminin()
{
$rsifeminin= Etudiant::where('filiere','=','RSI')->where('sexe','=','F')->where('abandon','=','0')->get();
return response()->json($rsifeminin);
}   
public function cybfeminin()
{
$cybfeminin= Etudiant::where('filiere','=','CYB')->where('sexe','=','F')->where('abandon','=','0')->get();
return response()->json($cybfeminin);
}   
}
