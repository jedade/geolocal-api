<?php
/**
 * @OA\Get(
 * path="/api/communes/",
 * summary="les communes",
 * description="Listes des communes",
 * operationId="",
 * tags={"Communes"},   
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
 **/

/**
 * @OA\Post(
 * path="/api/communes/",
 * summary="Creation de communes",
 * description="",
 * operationId="",
 * tags={"Communes"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="Vous devez vous connectez d'abord et etre admin",
 *    @OA\JsonContent(
 *      required={"name"},
 *       @OA\Property(property="name", type="string", format="string", example="bohicon"),
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
 **/

/**
 * @OA\Patch(
 * path="/api/communes/{id}",
 * summary="modificatins",
 * description="Pour modifier un attributs de communes vous devez etre admin",
 * operationId="",
 * tags={"Communes"},   
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
 * path="/api/communes/{id}",
 * summary="Suppression",
 * description="suppression d'une commune",
 * operationId="",
 * tags={"Communes"},   
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
 **/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commune;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CommuneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listall()
    {
        // check logged user
            $commune =  Commune::all();
             
             if(count($commune) == 0) {

                    return response()->json(["status" => "failed", 
                 "count" => count($commune), 
                 "message" => "Erreur aucun Commune"], 200
                );
             }
 
             else {
                return response()->json([
                    "status" => "success", "count" => count($commune), 
                    "data" => $commune], 200
                   );
             }
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list($id)
    {
        // check logged user
        
        $commune =  Commune::find($id);
        
             
            return response()->json([
                    "status" => "success",  
                    "data" => $commune], 200
                   );
             
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        
        if(!is_null($user) && $user->rule="admin") {
            $validator=Validator::make($request->all(), [
                "name"=> "required",
                
            ]);

            if($validator->fails()) {
                return response()->json([
                    "status" => "failed", 
                    "validation_errors" => $validator->errors()
                ]);
            }

            $communeInput=$request->all();

            $commune = Commune::create($communeInput);

            if(!is_null($commune)) {
                return response()->json(["status" => "success", "message" => "Success! Commune created", "data" => $commune]);
            }

            else {
                return response()->json(["status" => "failed", "message" => "Whoops! Commune not created"]);
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
    public function update(Request $req, Commune $commune)
    {
            //$req = $request->all(); 
            if(!is_null($user) && $user->rule="admin") {
                // validation
                $validator = Validator::make($req->all(), [
                    "name"=> "required",
                    
                ]);

                if($validator->fails()) {
                    return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
                } else{
                    // update post
                    //$update = $commune->update($request->all());
                    $commune = Commune::find($req->id);
                    $commune->name = $req->name;
                    $update = $commune->save();
                    if($update){
                        return response()->json(["status" => "success", "message" => "Felicitaton! Commune mise a jour", "data" => $update], 200);
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
        
        if(!is_null($user) && $user->rule =='admin') {
            $commune = Commune::find($id);
            $delete=$commune->delete();
            if($delete){
                return response()->json(["status" => "success", "message" => "Success! Commune deleted"], 200);
            }else{
                return response()->json(["status" => "error", "message" => "Erreur! Commune Supprimé"], 200);
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
            $commune = Commune::where("name", $name)->get();
            return response()->json(["data" =>$commune], 200);
       // }
        //else {
        //    return response()->json(["status" => "failed", "message" => "Un-authorized user"], 403);
       // }
    }

}
