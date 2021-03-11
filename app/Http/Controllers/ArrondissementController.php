<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arrondissement;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
/**
 * @OA\Get(
 * path="/api/arrondissements/",
 * summary="les differents arrondissements couvrir par l'api",
 * description="Les arrondissements sont liées au commune",
 * operationId="",
 * tags={"Arrondissements"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="",
 *    @OA\JsonContent(
 *       required={"",""},
 *       @OA\Property(property="name", type="string", format="string", example="koda"),
 *    ),
 * ),
 * @OA\Response(
 *    response=200,
 *    description="",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong phone or password. Please try again")
 *        )
 *     )
 * )
 */

/**
 * @OA\Post(
 * path="/api/arrondissements",
 * summary="liste des problemes",
 * description="",
 * operationId="",
 * tags={"Arrondissements"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="Vous devez vous connectez d'abord et etre admin",
 *    @OA\JsonContent(
 *      required={"name","commune_id"},
 *       @OA\Property(property="name", type="string", format="string", example="bohicon"),
 *       @OA\Property(property="commune_id", type="int", format="int", example="1"),
 *    ),
 * ),
 * @OA\Response(
 *    response=422,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong phone or password. Please try again")
 *        )
 *     )
 * )
 */

/**
 * @OA\Patch(
 * path="/api/arrondissements/{id}",
 * summary="modificatins",
 * description="Pour modifier un attributs des problemes vous devez etre admin",
 * operationId="",
 * tags={"Arrondissements"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="Vous devez vous connectez d'abord et etre admin ",
 *    @OA\JsonContent(
 *    ),
 * ),
 * @OA\Response(
 *    response=422,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong phone or password. Please try again")
 *        )
 *     )
 * )
 */

/**
 * @OA\Delete(
 * path="/api/arrondissements/{id}",
 * summary="Suppression",
 * description="suppression d'un arrondissement",
 * operationId="",
 * tags={"Arrondissements"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="Uniquement par un compte admin",
 *    @OA\JsonContent(
 *       
 *    ),
 * ),
 * @OA\Response(
 *    response=422,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong phone or password. Please try again")
 *        )
 *     )
 * )
 */

class ArrondissementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listall()
    {
        // check logged user
            $arrondissement =  Arrondissement::all();
             
             if(count($arrondissement) == 0) {

                    return response()->json(["status" => "failed", 
                 "count" => count($arrondissement), 
                 "message" => "Erreur aucun Arrondissement"], 200
                );
             }
 
             else {
                return response()->json([
                    "status" => "success", "count" => count($arrondissement), 
                    "data" => $arrondissement], 200
                   );
             }
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list($id=null, $name=null)
    {
        // check logged user
        
        $arrondissement =  Arrondissement::find($id);
        
           
             
            return response()->json([
                    "status" => "success",  
                    "data" => $arrondissement], 200
                   );
             
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$user = Auth::user();
        
        //if(!is_null($user) && $user->rule="admin") {

            $validator=Validator::make($request->all(), [
                "name"=> "required",
                "commune_id"=> "required"  
            ]);
    
            if($validator->fails()) {
                return response()->json([
                    "status" => "failed", 
                    "validation_errors" => $validator->errors()
                ]);
            }
    
            $arrondissementInput=$request->all();
    
            $arrondissement = Arrondissement::create($arrondissementInput);
    
            if(!is_null($arrondissement)) {
                return response()->json(["status" => "success", "message" => "Success! Arrondissement created", "data" => $arrondissement]);
            }
    
            else {
                return response()->json(["status" => "failed", "message" => "Whoops! arrondissement not created"]);
            }

        //}else{
        //    return response()->json(["status" => "failed", "message" => "Un-authorized user"], 403);
        //}
       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Arrondissement $arrondissement)
    {
        $user = Auth::user();
            //$req = $request->all(); 
            if(!is_null($user) && $user->rule="admin") {
                 // validation
                $validator = Validator::make($req->all(), [
                    "name"=> "required",
                    "commune_id"=> "required",
                ]);

                if($validator->fails()) {
                    return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
                } else{
                    // update post
                    //$update = $arrondissement->update($request->all());
                    $commune = Arrondissement::find($req->id);
                    $commune->name = $req->name;
                    $commune->commune_id = $req->commune_id;
                    $update = $commune->save();
                    if($update){
                        return response()->json(["status" => "success", "message" => "Felicitaton! arrondissement mise a jour", "data" => $update], 200);
                    }else{
                        return response()->json(["status" => "Erreur", "message" => "Erreur! pas de mise a jour"], 200);
                    }
                    
                }
            }else{
                return response()->json(["status" => "failed", "message" => "Un-authorized user"], 403);
            }

    }



     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        
        if(!is_null($user) && $user->rule="admin") {
            $arrondissement = Arrondissement::find($id);
            $delete=$arrondissement->delete();
            if($delete){
                return response()->json(["status" => "success", "message" => "Success! Arrondissement deleted"], 200);
            }else{
                return response()->json(["status" => "error", "message" => "Erreur! Arrondissement Supprimé"], 200);
            }
            
        }
        else {
            return response()->json(["status" => "failed", "message" => "Un-authorized user"], 403);
        }
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        //$user = Auth::user();
        
        //if(!is_null($user)) {
            $arrondissement = Arrondissement::where("name", $name)->get();
            return response()->json(["data" =>$arrondissement], 200);
       // }
        //else {
        //    return response()->json(["status" => "failed", "message" => "Un-authorized user"], 403);
       // }
    }

}
