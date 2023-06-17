<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // post list 
    public function postList () {

        $post = Post::select('posts.*','categories.title as category_name')
                            ->leftJoin('categories', 'posts.category_id','categories.id')
                            ->when(request('key'),function($query){
                                $query->where('name','like','%'. request('key').'%');
                            })
                            ->orderBy('posts.created_at','desc')
                            ->paginate(8);
        
        return view ('admin.post.postList',compact('post'));
    }

    //post 
    public function index () {
        $categories = Category::select('id','title')->get();
            return view ('admin.post.index',compact('categories'));
    }

    // post create
    public function Create (Request $request){
        $categories = Category::select('id','title')->get();
        $userData = $this->getPostData($request);
        $validator = $this->getPostValidation($request);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $fileName = uniqid().'_'.$request->file('postImage')->getClientOriginalName();
        $request->file('postImage')->storeAs('public',$fileName);
        $userData['image'] = $fileName;

        Post::create($userData);
        return to_route('admin@postCreate',compact('categories'))->with(['Success' => 'Create Post Success']);
    }

    // post delete
    public function postDelete ($id) {
        $post = Post::where('id',$id)->delete();

        return back()->with(["success" => 'Delete Success']);
    }

    // post edit
    public function postEditPage ($id) {
        $categories = Category::get();
        $post = Post::where('id',$id)->first();
        // dd($post->toArray());
        return view('admin.Post.edit',compact('categories','post'));
    }

    // post update 
    public function postUpdate ($id,Request $request){
         $data = $this->getPostData($request);
         $validator = $this->getPostValidation($request);

         if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

         if($request->hasFile('postImage')){
            $oldImageName = Post::where('id',$request->id)->first();
            $oldImageName = $oldImageName->image;

            if($oldImageName != null) {
                Storage::delete('public'.$oldImageName);
            }

            $fileName = uniqid().'_'.$request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs('public',$fileName);
            $data['image'] =$fileName;
         }

         Post::where('id',$id)->update($data);
         return back()->with(["success" => 'success']);

    }

    // post details
    public function postDetails ($id) {
        $postdata = Post::select('posts.*','categories.title as category_name')
                                                ->leftJoin('categories', 'posts.category_id','categories.id')
                                                ->first();
        $post = Post::where('id',$id)              
                            ->first();
                           
        return view('admin.Post.details',compact('post','postdata'));
    }

    // all post list
    public function allPost () {

        $posts = Post::orderByDesc('created_at')
                                ->get();

        return view('admin.Post.allPost',compact('posts'));
    }

    private function getPostData ($request) {
        return [
            "name" => $request->postName,
            'category_id' => $request->postCategoryName,
            'description' => $request->postDescription,
            'created_at' => Carbon::now()->diffForHumans(),

        ];
    }

    private function getPostValidation ($request) {
        return Validator::make($request->all(), [
                    'postName' => 'required|max:200',
                    'postCategoryName' => 'required',
                    'postDescription' => 'required',
                    'postImage' => 'mimes:jpg,jpeg,png,web,jfif'
                ]);
    }
}
