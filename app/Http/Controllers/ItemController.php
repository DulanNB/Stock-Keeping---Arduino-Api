<?php

namespace App\Http\Controllers;

use App\Items;
use App\Models\Category;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ItemController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');

//        $this->middleware('permission:create', ['only' => ['item-add']]);
//        $this->middleware('permission:store', ['only' => ['item-add']]);
//        $this->middleware('permission:destroy', ['only' => ['item-remove']]);
//        $this->middleware('permission:edit', ['only' => ['item-edit']]);
//        $this->middleware('permission:update', ['only' => ['item-edit']]);
    }

    public function index()
    {
        $items = Items::orderBy('id','DESC')->paginate(10);;
        return view('items.index',compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'item_name'=>'string|required',
            'item_description'=>'string|required',
            'quantity'=>'numeric|required',
            'price'=>'numeric|required',
        ]);
        $data= $request->all();

        $status=Items::create($data);

        if($status){
            request()->session()->flash('success','Item successfully added');
        }

        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }

        return redirect()->route('items.index');
    }
    public function destroy($id)
    {

        $items=Items::findOrFail($id);

        $status=$items->delete();

        if($status){
            request()->session()->flash('success','Item successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting Item');
        }
        return redirect()->route('items.index');
    }
    public function edit($id)
    {
        $items=Items::findOrFail($id);
        return view('items.edit')->with('item',$items);
    }

    public function update(Request $request, $id)
    {
        $items=Items::findOrFail($id);

        $this->validate($request,[
            'item_name'=>'string|required',
            'item_description'=>'string|required',
            'quantity'=>'numeric|required',
            'price'=>'numeric|required',
        ]);
        $data= $request->all();
        $status=$items->fill($data)->save();

        if($status){
            request()->session()->flash('success','Item Data successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return Redirect::back();
    }

}
