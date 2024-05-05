<?php

namespace App\Http\Controllers;

use App\Items;
use App\Mail\StockAlert;
use App\Models\Category;
use App\Models\student;
use App\StockOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ItemController extends Controller
{

    function __construct()
    {
        //$this->middleware('auth');

//        $this->middleware('permission:create', ['only' => ['item-add']]);
//        $this->middleware('permission:store', ['only' => ['item-add']]);
//        $this->middleware('permission:destroy', ['only' => ['item-remove']]);
//        $this->middleware('permission:edit', ['only' => ['item-edit']]);
//        $this->middleware('permission:update', ['only' => ['item-edit']]);
    }

    public function index()
    {
        $items = Items::orderBy('id', 'DESC')->paginate(10);

        foreach ($items as $item) {
            $totalReceivedQuantity = 0;

            foreach ($item->stockOrders as $order) {
                if ($order->state === 'received') {
                    $totalReceivedQuantity += $order->received_quantity;
                }
            }

            $item->stock_orders_sum_received_quantity = $totalReceivedQuantity;
        }

        return view('items.index', compact('items'));
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
            'product_weight'=>'numeric|required',
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
            'price'=>'numeric|required',
            'low_stock_margin'=>'numeric|nullable',
            'sensor_id'=>'numeric|nullable',
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

    public function updateStock(Request $request,)
    {
        Log::info($request);


        $total_weight = $request['value'];

        $item = Items::where('sensor_id', $request['device_id'])->first();

        $low_stock_margin = $item->low_stock_margin;

        $stock = StockOrders::where('item_id', $item->id)
            ->where('state', 'received')
            ->where('received_quantity', '>=', 0)
            ->first();

        $new_count = round($total_weight / $item->product_weight);

        //dd($new_count);
        if ($new_count <= 0) {
//            'state' => 'expired',
            StockOrders::where('id', $stock->id)->update([ 'received_quantity' => 0]);
        } else {
            StockOrders::where('id', $stock->id)->update(['received_quantity' => $new_count]);
        }


        if ($new_count <= $low_stock_margin) {
            Log::info(Cache::has('stock_alert_email_sent'));
            // Check if the emails was sent within the last minute
            if (!Cache::has('stock_alert_email_sent')) {
                $itemName = $item->item_name;
                Mail::to('admin@admin.com')->send(new StockAlert($itemName));

                // Log the event
                Log::info('Stock for item ' . $item->item_name . ' has fallen below the low stock margin.');

                // Store a flag in the cache to indicate that the emails was sent
                Cache::put('stock_alert_email_sent', true, now()->addSeconds(120));
            }
        }


    }


}
