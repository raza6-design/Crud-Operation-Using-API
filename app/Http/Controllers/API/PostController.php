<?php

namespace App\Http\Controllers\API;

use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['posts'] = post::all();

        return $this->sendResponse($data,'All Posts Data.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'title'=>'required',
                'description'=>'required|',
                'image'=>'required|mimes:png,jpg,jpeg,gif'
            ]
            );

            if($validateUser->fails()){
                return $this->sendError('Validation Error',$validateUser->errors()->all(),401);
            }

            $img = $request->image;
            $ext = $img->getClientOriginalExtension();
            $imageName = time(). '.' . $ext;
            $img->move(public_path(). '/uploads',$imageName);

            $post = post::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $imageName,
            ])->paginate(3);
 
               return $this->sendResponse($post,'Post Created Successfully.');
             }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['post'] = post::select(
            'id',
            'title',
            'description',
            'image'
        )->where(['id' => $id])->get();

        return $this->sendResponse($data,'Single Post Data.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'title'=>'required',
                'description'=>'required|',
                'image'=>'nullable|image|mimes:png,jpg,jpeg,gif'
            ]
            );

            if($validateUser->fails()){
                return $this->sendError('Validation Error',$validateUser->errors()->all(),401);
            }

            $postImg = post::select('id','image')->where(['id'=> $id])->get();

            if($request->image != ''){
                $path =public_path(). '/uploads/';

                if($postImg[0]->image != '' && $postImg[0]->image != null){
                    $old_file =$path. $postImg[0]->image;
                    if(file_exists($old_file)){
                        unlink($old_file);
                    }
                }
                $img = $request->image;
                $ext = $img->getClientOriginalExtension();
                $imageName = time(). '.' . $ext;
                $img->move(public_path(). '/uploads',$imageName);    
            }else{
                $imageName = $postImg[0]->image;
            }

            $post = post::where(['id'=>$id])->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $imageName,
            ]);
        return $this->sendResponse($post,'Post Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagePath = post::select('image')->where('id',$id)->get();
        $filePath = public_path(). '/uploads/'. $imagePath[0]['image'];
        unlink($filePath);

        $post = post::where('id',$id)->delete();

        return $this->sendResponse($post,'Post Deleted Successfully.');

    }
}
