<?php

namespace App\Http\Controllers;

use App\customers;
use App\Items;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');

//        $this->middleware('permission:create', ['only' => ['customer-add']]);
//        $this->middleware('permission:store', ['only' => ['customer-add']]);
//        $this->middleware('permission:destroy', ['only' => ['customer-remove']]);
//        $this->middleware('permission:edit', ['only' => ['customer-edit']]);
//        $this->middleware('permission:update', ['only' => ['customer-edit']]);
    }

    public function index()
    {
        $customers = customers::orderBy('id','DESC')->paginate(10);;
        return view('customer.index',compact('customers'));
    }
    public function create(){
        return view('customer.create');
    }

    public function store(Request  $request)
    {
        $this->validate($request,[
            'name'=>'string|required',
            'email'=>'email:rfc,dns|string|required',
            'address'=>'string|required',
            'phone_number'=>'required|min:13|numeric',
        ]);
        $data= $request->all();

        $status=customers::create($data);

        if($status){
            request()->session()->flash('success','Customer successfully added');
        }

        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }

        return redirect()->route('customer.index');
    }
    public function edit($id)
    {
        $customer=customers::findOrFail($id);
        return view('customer.edit')->with('customer',$customer);
    }

    public function update(Request $request, $id)
    {
        $customer=customers::findOrFail($id);

        $this->validate($request,[
            'name'=>'string|required',
            'email'=>'email:rfc,dns|string|required',
            'address'=>'string|required',
            'phone_number'=>'required|min:13|numeric',
        ]);
        $data= $request->all();
        $status=$customer->fill($data)->save();

        if($status){
            request()->session()->flash('success','Customer data successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return Redirect::back();
    }
    public function destroy($id)
    {

        $customer=customers::findOrFail($id);

        $status=$customer->delete();

        if($status){
            request()->session()->flash('success','Customer successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting Item');
        }
        return redirect()->route('customer.index');
    }
}
