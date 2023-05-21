<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Protype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminProtypeController extends Controller
{
    public function protype(){
        $allProtypes = Protype::all();
        $protype=Protype::orderBy('id', 'desc')->paginate(10);
        return view('admin.admin-protype',[
            'allProtypes'=>$allProtypes,
            'protype'=>$protype,
        ]);
    }
    function destroy(Protype $protype){
        $product=Product::where('type_id',$protype['id'])->count();
        if($product>0){
            return redirect()->route('admin.listprotype')->with('unsuccess','Delete Unsuccessful');
        }else{
        $protype->delete();
        return redirect()->route('admin.listprotype')->with('success','Delete Success');
        }
    }
    function edit($id){
        $protype=Protype::where('id',$id)->get();
        return view('Admin.admin-editProtype',compact('protype'));
    }
    function update(Request $request){
        $protype=Protype::where('name',$request->name)->count();
        if($protype>0){
            return redirect()->route('admin.editprotype',['id'=>$request['id']])->with(['error'=>'Edit Unsuccessful because the name already exists','name'=>$request->name]);
        }
        DB::Table('protypes')->where('id',$request->id)->update(['name'=>$request->name]);
        return redirect()->route('admin.listprotype')->with('success','Edit Success');
    }
    function add(Request $request){
        $protype= Protype::where('name',$request->name)->count();
        if($protype>0){
            return redirect()->route('protype.add')->with(['usuccess'=>'Add Unsuccessful','name'=>$request->name]);
        }else{
        DB::Table('protypes')->insert(['name'=>$request->name]);
        return redirect()->route('admin.listprotype')->with('success','Add Success');
        }
    }
}
