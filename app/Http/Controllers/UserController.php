<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/**
 * @OA\Post(
 * path="/api/login",
 * summary="Sign in",
 * description="Login, password",
 * operationId="authLogin",
 * tags={"auth"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"phone","password"},
 *       @OA\Property(property="phone", type="string", format="string", example="66068697"),
 *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
 *       @OA\Property(property="persistent", type="boolean", example="true"),
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
 * path="/api/register",
 * summary="Sign up",
 * description="",
 * operationId="authLogin",
 * tags={"auth"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"phone","password","firstname","lastname","communes","genre","rule"},
 *       @OA\Property(property="firstname", type="string", format="string", example="Damas"),
 *       @OA\Property(property="lastname", type="string", format="password", example="Helas"),
 *      @OA\Property(property="phone", type="string", format="string", example="66068697"),
 *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
 *      @OA\Property(property="commune_id", type="int", format="int", example="1"),
 *       @OA\Property(property="genre", type="string", format="password", example="M"),
 *       @OA\Property(property="rule", type="string", format="admin,admin_locaux,users", example="admin"),
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
 * path="/api/user",
 * summary="info sur l'utilisateur",
 * description="",
 * operationId="authLogin",
 * tags={"users"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="Vous devez vous connectez d'abord",
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
 * path="/api/users",
 * summary="liste des utilisateurs",
 * description="",
 * operationId="authLogin",
 * tags={"users"},   
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
 * @OA\GET(
 * path="/api/user/{id}",
 * summary="info sur un utilisateur seulement un admin et admin_locaux",
 * description="",
 * operationId="authLogin",
 * tags={"users"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="Vous devez vous connectez d'abord",
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
 * @OA\Patch(
 * path="/api/user/{id}",
 * summary="mise a jour des infos de l'utilisateurs",
 * description="",
 * operationId="authLogin",
 * tags={"users"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="Vous devez utiliser le token de l'utilisateur ou un admin ou admin_locaux",
 *    @OA\JsonContent(
 *      required={"phone","password","firstname","lastname","communes","genre","rule"},
 *       @OA\Property(property="firstname", type="string", format="string", example="Damas"),
 *       @OA\Property(property="lastname", type="string", format="password", example="Helas"),
 *      @OA\Property(property="phone", type="string", format="string", example="66068697"),
 *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
 *      @OA\Property(property="commune_id", type="int", format="int", example="1"),
 *       @OA\Property(property="genre", type="string", format="password", example="M"),
 *       @OA\Property(property="rule", type="string", format="admin,admin_locaux,users", example="admin"),
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
 * path="/api/user/{id}",
 * summary="suprimer un utilisateur",
 * description="",
 * operationId="authLogin",
 * tags={"users"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="Vous devez utiliser le token de l'utilisateur ou un admin",
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
class UserController extends Controller
{
    
    /**
     * User Registration
     */
    public function register(Request $request) {
        $validator  =   Validator::make($request->all(), [
            "firstname"  =>  "required",
            "lastname"  =>  "required",
            "phone"  =>  "required",
            "password"  =>  "required",
            "commune_id"  =>  "required",
            "genre"  =>  "required",
            "rule"  =>  "required"
        ]);

        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }

        $inputs = $request->all();
        $inputs["password"] = Hash::make($request->password);

        $user   =   User::create($inputs);

        if(!is_null($user)) {
            return response()->json(["status" => "success", "message" => "Success! registration completed", "data" => $user]);
        }
        else {
            return response()->json(["status" => "failed", "message" => "Registration failed!"]);
        }       
    }

    // User login
    public function login(Request $request) {

        $validator = Validator::make($request->all(), [
            "phone" =>  "required",
            "password" =>  "required",
        ]);

        if($validator->fails()) {
            return response()->json(["validation_errors" => $validator->errors()]);
        }

        $user= User::where("phone", $request->phone)->first();

        if(is_null($user)) {
            return response()->json(["status" => "failed", "message" => "Aucun utilisateur ne possède ce numero"]);
        }

        if(Auth::attempt(['phone' => $request->phone, 'password' => $request->password])){
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;

            return response()->json(["status" => "success", "login" => true, "token" => $token, "data" => $user]);
        }
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! invalid password"]);
        }
    }

    
    /**
     * 
     */
    public function user() {
        $user = Auth::user();
        if(!is_null($user)) { 
            return response()->json(["status" => "success", "data" => $user]);
        }

        else {
            return response()->json(["status" => "failed", "message" => "Whoops! no user found"]);
        }        
    }


    /**
     * 
     */
    public function users() {
        $user = Auth::user();
        if(!is_null($user) && ($user->rule="admin" || $user->rule="admin_locaux" ) ) { 
            $users = User::all();
            return response()->json(["status" => "success", "data" => $users]);
        }else {
            return response()->json(["status" => "failed", "message" => "Whoops! no user found"]);
        }        
    }

    /**
     * 
     */
    public function users_info($id) {
        $user = Auth::user();
        if(!is_null($user) && ($user->rule="admin" || $user->rule="admin_locaux" ) ) { 
            $users = User::find($id);
            return response()->json(["status" => "success", "data" => $users]);
        }else {
            return response()->json(["status" => "failed", "message" => "Whoops! no user found"]);
        }   
    } 
    
     /**
     * update user
     */
    public function update($id){
        // validation
        $validator = Validator::make($req->all(), [
            "firstname"  =>  "required",
            "lastname"  =>  "required",
            "phone"  =>  "required",
            "password"  =>  "required",
            "commune_id"  =>  "required",
            "genre"  =>  "required",
            "rule"  =>  "required"
        ]);

        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        } else{
            $update=DB::table('users')
                ->where('id', $req->id)
                ->update($req->all());
            if($update){
                return response()->json(["status" => "success", "message" => "Felicitaton! Problem mise a jour", "data" => $update], 200);
            }else{
                return response()->json(["status" => "Erreur", "message" => "Erreur! pas de mise a jour"], 200);
            }
            
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
            $users = User::find($id);
            $delete=$users->delete();
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
}