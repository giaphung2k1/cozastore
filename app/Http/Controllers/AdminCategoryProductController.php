<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;

class AdminCategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $categories = Category::withTrashed()->get();
        if (is_null($categories)) {
            return response()->json(['message' => 'Record not found !'], 404);
        }

        foreach ($categories as $item) {
            $item->creator = $item->user->email;
        }
        return response()->json($categories, 200);
    }


    public function show($id){
        $category = Category::find($id);
        if (is_null($category)) {
            return response()->json(['message' => 'Record not found !'], 404);
        }

       
        return response()->json($category, 200);

    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $rules = [
        //     'name' => 'required',
        //     'description' => 'required',
        //     'status' => 'required',
        //     'user_id' => 'required',
        //     'thumbUrl' => 'required'
        // ];
        // $validator = Validator::make($request->all(), $rules);
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 400);
        // }

        // $data = $request->all();
        // $category = Category::create([
        //     'name' => $data['name'],
        //     'description' => $data['description'],
        //     'status' => $data['status'],
        //     'user_id' => $data['user_id'],
        //     'thumbUrl' => $data['thumbUrl']
        // ]);
        return response()->json($request->all(), 201);
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $rules = [
        //     'name' => 'required',
        //     'description' => 'required',
        //     'status' => 'required',
        //     'user_id' => 'required',
        //     'thumbUrl' => 'required'
        // ];
        // $validator = Validator::make($request->all(), $rules);
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 400);
        // }

        // $data = $request->all();
        // $category = Category::where('id',$id)->update([
        //     'name' => $data['name'],
        //     'description' => $data['description'],
        //     'status' => $data['status'],
        //     'user_id' => $data['user_id'],
        //     'thumbUrl' => $data['thumbUrl']
        // ]);
        return response()->json($request->all(), 200);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category  = Category::onlyTrashed()->where('id',$id)->get();
        if (is_null($category)) {
            return response()->json(['message' => 'Record not found !'], 404);
        }

        Category::onlyTrashed()->where('id',$id)->forceDelete();
        return response()->json(null, 204);

    }

    public function restore($id){
        $category  = Category::onlyTrashed()->where('id',$id)->get();
        if (is_null($category)) {
            return response()->json(['message' => 'Record not found !'], 404);
        }

        Category::onlyTrashed()->where('id',$id)->restore();
        return response()->json(null, 201);
    }


    public function goToTrash($id)
    {
        $category  = Category::find($id);
        if (is_null($category)) {
            return response()->json(['message' => 'Record not found !'], 404);
        }

        $category = $category->delete();
        return response()->json($category, 201);
    }
}
