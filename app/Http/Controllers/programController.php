<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\program;

class programController extends Controller
{
    public function update(Request $request, $id) {
        $user = Auth::user();

        if($user && $user->role == 'admin') {
            $data = $request->only(['title', 'image', 'file', 'description']);
            $id = $request->id;

            if ($id == 'new') {
                $program = program::create($data);
            } else {
                $program = program::findOrFail($id);
                $program->update($data);
            }

            $program->Types()->sync(
                ($request->types)?$request->types:[]
            );            
            $program->Bodies()->sync(
                ($request->bodies)?$request->bodies:[]
            );

            return response()->json(['program' => $program->Show('en')], 200);
        } else {
            return response()->json(['errors' => 'no access'], 401);
        }        
    }

    public function index (Request $request) {
        $list = program::get();

        return response()->json(
            [
                'list' => $list->map(function($item){
                    return $item->Show('en');
                }),
            ], 200);
    }

    public function edit (Request $request, $id) {
        $item = program::findOrFail($id);

        return response()->json(['item' => $item->Show('ru')], 200);
    }

    public function destroy($id) {
        $item = program::findOrFail($id);
        $item->delete();

        return response()->json(['status' => 'done'], 200);
    }
}
