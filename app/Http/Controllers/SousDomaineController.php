<?php

namespace App\Http\Controllers;

use App\Models\SousDomaine;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSousDomaineRequest;
use App\Http\Requests\UpdateSousDomaineRequest;

class SousDomaineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sousDomaine = SousDomaine::with(['creator', 'modifier', 'domaine'])->get();
        return $this->customJsonResponse("sous-domaine retrieved successfully", $sousDomaine);
    }
    public function getSousDomaines($domaineId)
{
    $sousDomaines = SousDomaine::where('domaine_id', $domaineId)->get();
    return response()->json($sousDomaines);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSousDomaineRequest $request)
    {
 // Validation des données de la requête
 $data = $request->validated();

 // Création d'une nouvelle instance de SousDomaine
 $sousDomaine = new SousDomaine();
 $sousDomaine->fill( $request->validated() );
 if ( $request->hasFile( 'image' ) ) {
     $image = $request->file( 'image' );
     $sousDomaine->image = $image->store( 'images', 'public' );
 }
 $sousDomaine->created_by = Auth::id();
 $sousDomaine->save();

 return $this->customJsonResponse("Sous-domaine créé avec succès", $sousDomaine, Response::HTTP_CREATED);
    }



    /**
     * Update the specified resource in storage.
     */


     public function update(UpdateSousDomaineRequest $request, $id)
     {
         $data = $request->validated();

         $sousDomaine = SousDomaine::find($id);
         // Vérifier si le sous-domaine existe
         if (!$sousDomaine) {

             return $this->customJsonResponse("Sous-domaine introuvable", null, Response::HTTP_NOT_FOUND);
         }
         if ( $request->hasFile( 'image' ) ) {
             $image = $request->file( 'image' );
             $sousDomaine->image = $image->store( 'images', 'public' );
         } else {
             // Si l'image n'est pas fournie, garder l'ancienne image
             $sousDomaine->image = $sousDomaine->image;
         }

         $sousDomaine->fill($data);

         $sousDomaine->modified_by = Auth::id();
         $sousDomaine->save();

         return $this->customJsonResponse("Sous-domaine mis à jour avec succès", $sousDomaine);
        }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SousDomaine $sousDomaine)
    {
        $sousDomaine->delete();
        return $this->customJsonResponse("sous-domaine supprimé avec succès", null, Response::HTTP_OK);

    }
  // app/Http/Controllers/SousDomaineController.php
  public function getEntrepreneurs($id)
  {
      // Trouver le sous-domaine par ID
      $sousDomaine = SousDomaine::find($id);

      // Vérifier si le sous-domaine existe
      if (!$sousDomaine) {
          return response()->json(['message' => 'Sous-domaine non trouvé'], 404);
      }

      // Récupérer les entrepreneurs associés
      $entrepreneurs = $sousDomaine->users;

      return response()->json(['entrepreneurs' => $entrepreneurs], 200);
  }

}
