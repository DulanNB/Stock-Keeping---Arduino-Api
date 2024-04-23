<?php

namespace App\Http\Controllers;

use App\customers;
use App\Items;
use App\StockOrders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockOrdersController extends Controller
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
        $stock_orders = StockOrders::orderBy('id', 'DESC')
            ->with('vendor')
            ->paginate(10);
        return view('stock-orders.index', compact('stock_orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $items = Items::all();
        $customers = customers::all();
        return view('stock-orders.create', compact('items', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $request->merge([
            'created_by' => Auth::id(),
            'state' => 'pending' // Default state value
        ])->validate([
            'vendor_id' => 'required',
            'note' => 'required',
            'expected_date' => 'required',
            'item_id' => 'required',
            'price' => 'required',
            'order_quantity' => 'required',
        ]);

        StockOrders::create($request->all());

        return redirect()->route('stock-orders.index')->with('success', 'Stock Order created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockOrders  $stockOrder
     * @return \Illuminate\Http\Response
     */
    public function show(StockOrders $stockOrder)
    {
        return view('stock_orders.show', compact('stockOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StockOrders  $stockOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(StockOrders $stockOrder)
    {
        return view('stock_orders.edit', compact('stockOrder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StockOrders  $stockOrder
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, StockOrders $stockOrder)
    {
        $request->validate([
            'reference_id' => 'required',
            'vendor_id' => 'required',
            'note' => 'required',
            'expected_date' => 'required',
            'created_by' => 'required',
            'state' => 'required',
            'item_id' => 'required',
            'price' => 'required',
            'order_quantity' => 'required',
            'received_quantity' => 'required',
            'received_date' => 'required',
        ]);

        $stockOrder->update($request->all());

        return redirect()->route('stock_orders.index')->with('success', 'Stock Order updated successfully.');
    }

    public function receive(Request $request)
    {
        $request->validate([
            'received_quantity' => 'required|numeric|min:0', // Validate received quantity
        ]);

        $stockOrder = StockOrders::findOrFail($request['order_id']);

        $existing_order = StockOrders::where('item_id',$stockOrder->item_id)->where('state','received')->where('received_quantity','>',0)->exists();

        if ($existing_order){
            return redirect()->route('stock-orders.index')->with('error', 'There is ongoing stock order');
        }

        // Update the stock order with received quantity and date
        $stockOrder->update([
            'received_quantity' => $request->received_quantity,
            'received_date' => Carbon::now(), // Parse received date using Carbon
            'state' => 'received', // Update state to 'received'
        ]);

        return redirect()->route('stock-orders.index')->with('success', 'Stock Order marked as received.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StockOrders  $stockOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockOrders $stockOrder)
    {
        $stockOrder->delete();

        return redirect()->route('stock_orders.index')->with('success', 'Stock Order deleted successfully.');
    }
}
