<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // admin category List 
    public function categoryList () {
        $category = Category::all();
        $category = Category::when(request('key'),function($query){
                                            $query->where('title','like','%'.request('key').'%');
                                            })
                                            ->orderBy('id','desc')
                                            ->paginate(5);
        return view ('admin.category.list',compact('category'));
    }

    // category Create Page
    public function categoryCreatePage (){
         return view('admin.category.create');
    }

    // carete category
    public function categoryCreate (Request $request){
        $validator = $this->getValidationCheck ($request);
        $data = $this->getCategoryData($request);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        Category::create($data);
        return back()->with('Success' ,  ' Category Created');
    }

    // category delete
    public function categoryDelete ($id){
        $category = Category::where('id',$id)->first();

        Category::where('id',$id)->delete($category);
        return back()->with(['success' => 'Delete Success']);
    }

    // category edit
    public function editPage () {

        $category = Category::first();
        return view('admin.category.edit',compact('category'));
    }

    // category edit
    public function categoryEdit ($id,Request $request) {
        $validator = $this->editValidationCheck ($request);
        $data = $this->getCategoryData($request);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $category = Category::where('id',$id)->update($data);

        return redirect()->route('admin@categoryList')->with(["success" => 'Edit Success']);
    }

    private function getCategoryData ($request){
        return [
            'title' => $request->categoryTitle,
        ];
    }

    private function getValidationCheck ($request){
        return  Validator::make($request->all(), [
            'categoryTitle' => 'required|max:55|unique:categories,title',
        ]);
    }
    private function editValidationCheck ($request){
        return  Validator::make($request->all(), [
            'categoryTitle' => 'max:55|unique:categories,title',
        ]);
    }
}