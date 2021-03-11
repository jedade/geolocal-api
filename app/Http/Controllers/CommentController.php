<?php
/**
 * @OA\Get(
 * path="/api/comments/",
 * summary="les commentaires",
 * description="Listes des commentaires",
 * operationId="",
 * tags={"Commentaires"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="",
 *    @OA\JsonContent(
 *       required={"",""},
 *       
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
 * @OA\Get(
 * path="/api/comments/{name}",
 * summary="Recherche des commentaires par utilisateur",
 * description="Renvoie les commentaires des utilisateur ",
 * operationId="",
 * tags={"Commentaires"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="",
 *    @OA\JsonContent(
 *       required={"",""},
 *       
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
 * @OA\Get(
 * path="/api/comments/problemes/{id}",
 * summary="Recherche les commentaire par problemes",
 * description="Renvoie les commentaires du problemes voulue juste en renseignant l'id du problemes ",
 * operationId="",
 * tags={"Commentaires"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="",
 *    @OA\JsonContent(
 *       required={"",""},
 *       
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
 * path="/api/comments/",
 * summary="Creation de commentaire",
 * description="",
 * operationId="",
 * tags={"Commentaires"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="",
 *    @OA\JsonContent(
 *      required={"name"},
 *       @OA\Property(property="comment", type="string", format="string", example="mon commentaire"),
 *      @OA\Property(property="name", type="string", format="string", example="username"),
 *      @OA\Property(property="problem_id", type="string", format="int", example="1"),
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
 * path="/api/comments/{id}",
 * summary="modificatins",
 * description="commentaires modifications",
 * operationId="",
 * tags={"Commentaires"},   
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
 * path="/api/comments/{id}",
 * summary="Suppression",
 * description="suppression d'une commune",
 * operationId="",
 * tags={"Commentaires"},   
 * @OA\RequestBody(
 *    required=true,
 *    description="",
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
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listall()
    {
        // check logged user
           $comment = Comment::all();

            if(count($comment) == 0) {

                    return response()->json([ "status" => "failed", 
                 "count" => count($comment), 
                 "message" => "Erreur aucun  Comment" ], 200
                );
            }
 
            else {
                return response()->json([
                    "status" => "success", "count" => count($comment), 
                    "data" =>$comment ], 200
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
           $comment =  Comment::find($id);
             
            return response()->json([
                    "status" => "success",  
                    "data" =>$comment], 200
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
            "comment"=> "required",
            "name"=> "required",
            "problem_id"=> "required",
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => "failed", 
                "validation_errors" => $validator->errors()
            ]);
        }

       $commentInput=$request->all();

       $comment =  Comment::create($commentInput);

        if(!is_null($comment)) {
            return response()->json(["status" => "success", "message" => "Success!  Comment created", "data" =>$comment]);
        }

        else {
            return response()->json(["status" => "failed", "message" => "Whoops!  Comment not created"]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req,  Comment $comment)
    {
            //$req = $request->all(); 
           
            // validation
            $validator = Validator::make($req->all(), [
                "comment"=> "required",
                "name"=> "required",
                "problem_id"=> "required",
            ]);

            if($validator->fails()) {
                return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
            } else{

            //update data
            $update=DB::table('Comment')
                    ->where('id', $req->id)
                    ->update($req->all());
                
                if($update){
                    return response()->json(["status" => "success", "message" => "Felicitaton!  Comment mise a jour", "data" => $update], 200);
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
        
           $comment = Comment::find($id);
            $delete=$comment->delete();
            if($delete){
                return response()->json(["status" => "success", "message" => "Success!  Comment deleted"], 200);
            }else{
                return response()->json(["status" => "error", "message" => "Erreur!  Comment Supprimé"], 200);
            }
            
    }
        
    

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
    
            $comment = Comment::where("name", $name)->get();
            return response()->json(["data" =>$comment], 200);
      
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search_problemes($id)
    {
            $comment = Comment::where("problem_id", $id)->get();
           return response()->json(["data" =>$comment], 200);
    }
}
