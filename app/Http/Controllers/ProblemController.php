<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Problem;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


/**
 * @OA\GET(
 * path="/api/problemes",
 * summary="liste des problemes",
 * description="Elle renvoit aussi le nombre total de problemes",
 * operationId="",
 * tags={"Problemes"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="Vous n'avez pas besoin de vous connecter",
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
 * @OA\GET(
 * path="/api/problemes/commune/{id}",
 * summary="Recherche les problemes d'une commune",
 * description="Renvoie les problemes d'une commune",
 * operationId="",
 * tags={"Problemes"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="Vous n'avez pas besoin de vous connecter",
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
 * @OA\GET(
 * path="/api/problemes/category/{id}",
 * summary="recherche les problemes appartenant a une category",
 * description="Renvoie les problemes d'une category",
 * operationId="",
 * tags={"Problemes"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="Vous n'avez pas besoin de vous connecter",
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
 * @OA\GET(
 * path="/api/problemes/users/{users}",
 * summary="recherche les problemes d'un utilisateur",
 * description="Renvoie les problemes propre a un utilisateur",
 * operationId="",
 * tags={"Problemes"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="Vous n'avez pas besoin de vous connecter",
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
 * @OA\Post(
 * path="/api/problemes/",
 * summary="liste des problemes",
 * description="",
 * operationId="",
 * tags={"Problemes"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="Vous n'avez pas besoin de vous connecter",
 *    @OA\JsonContent(
 *      required={"longitude","latitude","image","commune","arrondissement"},
 *       @OA\Property(property="code", type="string", format="string", example="automatique"),
 *       @OA\Property(property="description", type="string", format="string", example="un text"),
 *      @OA\Property(property="audio", type="string", format="string", example=""),
 *       @OA\Property(property="image", type="string", format="string", example=""),
 *      @OA\Property(property="users", type="string", format="string", example="NameUser"),
 *       @OA\Property(property="anonymes", type="boolean", format="True|False", example="True"),
 *       @OA\Property(property="status", type="string", format="string", example=""),
 *       @OA\Property(property="longitude", type="float", format="float", example="15.6"),
 *       @OA\Property(property="latitude", type="float", format="float", example="15.6"),
 *       @OA\Property(property="commune_id", type="int", format="", example="1"),
 *       @OA\Property(property="arrondissement_id", type="int", format="", example="1"),
 *       @OA\Property(property="category_id", type="int", format="", example="1"),
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
 * path="/api/problemes/{id}",
 * summary="modificatins",
 * description="Pour modifier un attributs des problemes vous devez etre admin ou admin_locaux",
 * operationId="",
 * tags={"Problemes"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="Vous devez vous connectez d'abord et etre admin ou admin_locaux",
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
 * path="/api/problemes/{id}",
 * summary="Suppression",
 * description="Vous devez vous connectez en admin pour effectuer la suppression ",
 * operationId="",
 * tags={"Problemes"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="Vous devez vous connectez d'abord et etre admin",
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
class ProblemController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listall()
    {
        // check logged user
            $problem =  Problem::all();
             
             if(count($problem) == 0) {

                    return response()->json(["status" => "failed", 
                 "count" => count($problem), 
                 "message" => "Erreur aucun Problem"], 200
                );
             }
 
             else {
                return response()->json([
                    "status" => "success", "count" => count($problem), 
                    "data" => $problem], 200
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
            $problem =  Problem::find($id);
             
            return response()->json([
                    "status" => "success",  
                    "data" => $problem], 200
                   );
             
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator=Validator::make($request->all(), [
            "longitude"=> "required",
            "latitude"=> "required",
            "image"=> "required",
            "commune_id"=> "required",
            "arrondissement_id"=> "required"
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => "failed", 
                "validation_errors" => $validator->errors()
            ]);
        }

        
        $problemInput=$request->all();
        //if(!is_null($problemInput['commune_id']) && !is_null($problemInput['arrondissement_id'])){
        $problemInput['code']="Commune".$problemInput['commune_id']."Arrondissement".$problemInput['arrondissement_id'].Str::random(5);
        //}
       
        $problem = Problem::create($problemInput);

        if(!is_null($problem)) {
            return response()->json(["status" => "success", "message" => "Success! Problem created", "data" => $problem]);
        }

        else {
            return response()->json(["status" => "failed", "message" => "Whoops! Problem not created"]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Problem $problem)
    {
        $user = Auth::user();
            //$req = $request->all(); 
        if(!is_null($user) && ($user->rule="admin" || $user->rule="admin_locaux" )) {  
            // validation
            $validator = Validator::make($req->all(), [
                "longitude"=> "required",
                "latitude"=> "required",
                "image"=> "required",
                "commune_id"=> "required",
                "arrondissement_id"=> "required"
            ]);

            if($validator->fails()) {
                return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
            } else{
                // update post
                //$update = $problem->update($request->all());
                //$problem = Problem::find($req->id);
                //$problem->name = $req->name;
                //$value = $problem->update($req->all());
                //$update=$value->save();

                $update=DB::table('problems')
                    ->where('id', $req->id)
                    ->update($req->all());
                
     

                if($update){
                    return response()->json(["status" => "success", "message" => "Felicitaton! Problem mise a jour", "data" => $update], 200);
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
        
        if(!is_null($user) && ($user->rule="admin")) {
            $problem = Problem::find($id);
            $delete=$problem->delete();
            if($delete){
                return response()->json(["status" => "success", "message" => "Success! Problem deleted"], 200);
            }else{
                return response()->json(["status" => "error", "message" => "Erreur! Problem Supprimé"], 200);
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
    public function search_users($users)
    {
        
            $problem=Problem::where("users", $users)->get();
            return response()->json(["data" =>$problem], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search_commune($id)
    {
        
            $problem=Problem::where("commune_id", $id)->get();
            return response()->json(["data" =>$problem], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search_category($id)
    {
        
            $problem=Problem::where("category_id", $id)->get();
            return response()->json(["data" =>$problem], 200);
    }

}
