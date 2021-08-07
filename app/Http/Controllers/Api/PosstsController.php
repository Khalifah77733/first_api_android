<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Posst;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PosstsController extends Controller
{
    //

    public function create(Request $request){
        $possts = new Posst();
        $possts->user_id = Auth::user()->id;
        $possts->desc = $request->desc;

        //check if posst has photo
        if ($request->photo !=''){
         //choose a unique name for photo
            $photo = time().'jpg';
            //need to link storage folder to public
            file_put_contents('storage/possts/'.$photo,base64_decode($request->photo));
            $possts->photo = $photo;
        }

        $possts->save();
        $possts->user;
        return response()->json([
            'success'=>true,
            'message' => 'possted',
            'posst' => $possts
        ]);
    }// end of create

    public function delete(Request $request){

        $posst = Posst::find($request->id);
        // check if user is editgin his own posst
        if (Auth::user()->id != $request->id){
            return response()->json([
                'success' => false,
                'message' => 'unauthorized access'
            ]);
        }

        //check if post has photo to delete
            if ($posst->photo != ''){
                Storage::delete('public/possts/'.$posst->photo);
            }


        $posst->delete();
        return response()->json([
            'success' => true,
            'message' => 'posst delete'
        ]);



    }// end of delete



    public function update(Request $request){

        $posst = Posst::find($request->id);
        // check if user is editgin his own posst
        if (Auth::user()->id != $request->id){
            return response()->json([
               'success' => false,
               'message' => 'unauthorized access'
            ]);
        }

        $posst->desc = $request->desc;
        $posst->update();
        return response()->json([
            'success' => true,
            'message' => 'posst edited'
        ]);


    }// end of update

public function possts(Request $request){

        $possts = Posst::orderBy('id', 'desc')->get();
        foreach ($possts as $posst){
            // get user of post
            $posst->user;
            // comments count
            $posst['commentsCount'] = count($posst->comments);
            //likes count
            $posst['likesCount'] = count($posst->likes);
            //check if users liked his own post
            $posst['selfLike'] = false;
            foreach ($posst->likes as $like){
                $posst['selfLike'] = true;
            }
        }

        return response()->json([
            'success' => true,
            'possts' => $possts
        ]);



    }// end of possts











}
