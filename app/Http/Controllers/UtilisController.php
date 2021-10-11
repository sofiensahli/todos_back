<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Utilis;
use App\Models\ToDos;

use App\Models\Categories;
use Illuminate\Http\Request;


class UtilisController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sign_up(Request $request){
        $data = $request->all();
        $utilis = new Utilis();
        $utilis->username = $data['username'];
        $utilis->password = $data['password'];
        $utilis->save();
        $categor = new Categories(); 
        $categor-> title = "Uncategorized";
        $categor-> utilis_id = $utilis->id;
        $categor->save();
        $utilis->categories = [$categor];

        return response()->json($utilis);

    }
    
    public function sign_in(Request $request){
        $data = $request->all();
        $utilis =  Utilis::where("username",
        $data['username'] )->where("password",
        $data["password"])->get();
        $cats = Categories::where('utilis_id' , $utilis[0]->id)->get();
         foreach($cats as $c ){
             $todos = ToDos::where("cat_id", $c->id)->get();
             $c->todos = $todos;
         }
        
        $utilis[0]->categories = $cats;

     return response()->json($utilis[0]);
    }

    public function newCategories(Request $request){
        $data = $request->all();
        $categor = new Categories(); 
        $categor-> title = $data['title'];
        $categor-> utilis_id = $data['utilis_id'];
        $categor->save();
        return response()->json($categor);
    }

    public function newTod(Request $request){
        $todos = new ToDos();

        if ($request->hasFile('file')) {
            // $request->image->store();
            $fileName = $request->file("file");
            $path = $request->file->store("public/images");
            $todos->filepath ="storage".substr($path,6);
        }
        $data =json_decode( $request['data'], true);
        $todos->description = $data['description'];
        $todos->title = $data['title'];
        $todos->date = $data['date'];
        $todos->priority = $data['priority'];
        $todos->cat_id = $data['cat_id'];
        $todos->status = $data['status'];
        $todos->save();
        return response()->json($todos);
    }
    public function updateTod(Request $request){
  

        $data =json_decode( $request['data'], true);
        $todos = ToDos::find($data['id']);
        $todos->description = $data['description'];
        $todos->title = $data['title'];
        $todos->date = $data['date'];
        $todos->priority = $data['priority'];
        $todos->status = $data['status'];
        $todos->save();
        return response()->json($todos);
    }
    public function deletetodo ( Request $request ){ 
        $data =json_decode( $request['data'], true);
        $todos = ToDos::find($data['id'])->delete();
    }
}
