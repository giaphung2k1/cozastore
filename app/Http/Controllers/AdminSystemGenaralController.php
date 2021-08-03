<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSystemGenaralController extends Controller
{
    public function index(){
        $data = DB::table('system_genarals')->first();
        if(empty($data)){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json($data,200);
    }
}
