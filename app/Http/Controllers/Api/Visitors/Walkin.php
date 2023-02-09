<?php

namespace App\Http\Controllers\Api\Visitors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Walkin extends Controller
{
//    public function index(){
//        $visitors = \App\Models\WalkIn::join('organization','organization.organizationId','=','organization.id')
//            ->join('','','=','organization.id')
//            ->whereNull('parentID')
//
//            ->get();
//
//        return response()->json([
//            "success" => true,
//            "message" => "Visitor List",
//            "data" => $visitors
//        ]);
//    }
    public function create(Request $request){

    }
}
