<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


/**
 * @OA\Get(
 * path="/api/categories/",
 * summary="les differents categories couvrir par l'api",
 * description="Les arrondissements sont liées au categories",
 * operationId="",
 * tags={"Categories"},   
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
 * @OA\Patch(
 * path="/api/categories/{id}",
 * summary="modificatins",
 * description="Pour modifier une categories vous devez etre admin ou admin_locaux",
 * operationId="",
 * tags={"Categories"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="Vous devez vous connectez d'abord et etre admin ou admin_locaux ",
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
 * path="/api/categories/{id}",
 * summary="Suppression",
 * description="suppression d'une categories etre admin ou admin_locaux",
 * operationId="",
 * tags={"Categories"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="Uniquement par un compte admin ou admin_locaux",
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

/**
 * @OA\Post(
 * path="api/categories/",
 * summary="Categories",
 * description="Liste des categories de categories et ne peut etre creer que par un admin ou admin_locaux",
 * operationId="",
 * tags={"Categories"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"title","description","type","commune_id"},
 *       @OA\Property(property="title", type="string", format="string", example="Traveaux publics"),
 *       @OA\Property(property="description", type="string", format="string", example="explication"),
 *       @OA\Property(property="type", type="specifique|general", example="specifique"),
 *       @OA\Property(property="commune_id", type="int", example="1"),
 *    ),
 * ),
 * @OA\Response(
 *    response=422,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
 *        )
 *     )
 * )
*/


 class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listall()
    {
        // check logged user
            $category =   Category::all();

            if(count($category) == 0) {

                    return response()->json(["status" => "failed", 
                 "count" => count($category), 
                 "message" => "Erreur aucun  Category"], 200
                );
            }
 
            else {
                return response()->json([
                    "status" => "success", "count" => count($category), 
                    "data" => $category], 200
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
            $category =   Category::find($id);
             
            return response()->json([
                    "status" => "success",  
                    "data" => $category], 200
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
        
        if(!is_null($user) && ($user->rule="admin" || $user->rule="admin_locaux")) {
            $validator=Validator::make($request->all(), [
                "title" => "required",
                "type" => "required",
                "commune_id" => "required",
                "type" => "required" 
            ]);

            if($validator->fails()) {
                return response()->json([
                    "status" => "failed", 
                    "validation_errors" => $validator->errors()
                ]);
            }

            $categoryInput=$request->all();

            $category = Category::create($categoryInput);

            if(!is_null($category)) {
                return response()->json(["status" => "success", "message" => "Success!  Category created", "data" => $category]);
            }

            else {
                return response()->json(["status" => "failed", "message" => "Whoops!  Category not created"]);
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
    public function update(Request $req,  Category $category)
    {
            //$req = $request->all(); 
           
            // validation
        $user = Auth::user();
        
        if(!is_null($user) && ($user->rule="admin" || $user->rule="admin_locaux")) {
                $validator = Validator::make($req->all(), [
                    "title"=> "required",
                    "type"=> "required",
                    "commune_id"=> "required",
                ]);

                if($validator->fails()) {
                    return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
                } else{
                    // update post
                    //$update = $category->update($request->all());
                    //$category =  Category::find($req->id);
                    //$category->name = $req->name;
                    //$value = $category->update($req->all());
                    //$update=$value->save();

                    $update=DB::table('category')
                        ->where('id', $req->id)
                        ->update($req->all());
                    
        

                    if($update){
                        return response()->json(["status" => "success", "message" => "Felicitaton!  Category mise a jour", "data" => $update], 200);
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
        
        if(!is_null($user) && ($user->rule="admin" || $user->rule="admin_locaux")) {
            $category = Category::find($id);
            $delete=$category->delete();
            if($delete){
                return response()->json(["status" => "success", "message" => "Success!  Category deleted"], 200);
            }else{
                return response()->json(["status" => "error", "message" => "Erreur!  Category Supprimé"], 200);
            }
            
        }
        else {
            return response()->json(["status" => "failed", "message" => "Un-authorized user"], 403);
        }
    }

}
