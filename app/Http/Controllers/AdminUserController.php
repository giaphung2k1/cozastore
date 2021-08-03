<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->get();
        $users->transform(function($user){
            $user->role = $user->getRoleNames()->first();
            return $user;
        });
        return response()->json($users,200);
    }



    public function profile(Request $request)
    {
        
        if(isset($request->avatar)){
            $rules = [
                'avatar' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $data = $request->all();
            $user =  User::where('id',$data['id'])->update([
                'avatar' => $data['avatar']
            ]);
            return response()->json($user, 200);
        }
        else{
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'address' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $data = $request->all();
            $user =  User::where('id',$data['id'])->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'address' => $data['address']
            ]);
            return response()->json($user, 200);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUser $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        
        $role = Role::where('name',$request->role)->get();
        $user->assignRole($role);

        


        if($request->has('permissions')){
            $list_permission = Permission::all();
            $permissions = [];
            foreach($list_permission as $permission){
                if(in_array($permission->name,$request->permissions)){
                    array_push($permissions,$permission);
                }
            }
            $user->givePermissionTo($permissions);
        }
        $user->save();
        return response()->json($user,200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
       
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
