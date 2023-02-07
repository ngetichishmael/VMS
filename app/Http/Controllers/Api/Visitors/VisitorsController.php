<?php

namespace App\Http\Controllers\Api\Visitors;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVisitorRequest;
use App\Models\Visitor;

class VisitorsController extends Controller
{
    public function index()
    {
        $visitors = Visitor::all();

        return response()->json([
            'status' => true,
            'visitors' => $visitors
        ]);
    }
    public function create()
    {
        //
    }
    public function store(StoreVisitorRequest $request)
    {
        $visitor = Post::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Visitor's Details Uploaded Successfully!",
            'visitor' => $visitor
        ], 200);
    }
    public function show(Visitor $visitor)
    {
        //
    }
    public function edit(Visitor $visitor)
    {
        //
    }
    public function update(StoreVisitorRequest $request, Visitor $visitor)
    {
//        $visitor->update($request->all());
//
//        return response()->json([
//            'status' => true,
//            'message' => "Visitor's Details Updated Successfully!",
//            'visitor' => $visitor
//        ], 200);
    }
    public function destroy(Visitor $visitor)
    {
//        $visitor->delete();
//
//        return response()->json([
//            'status' => true,
//            'message' => "Visitor's Details successfully!",
//        ], 200);
    }
}
