<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $customer = DB::table('interview')->select('id', 'full_name', 'phone_number', 'email', 'ip_address', 'status')->when($search, function ($cust, $search) {
            $cust = $cust->where('full_name', 'like', '%' . $search . '%');
        })->latest()->paginate(50)->appends(['search' => $search]);

        return view('customer-index', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'full_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'ip_address' => 'required',
            'status' => 'required',
        ]);

        $last_id = DB::table('interview')->select('id')->latest('id')->first();
        $id = $last_id->id + 1;

        $post = Customer::Create([
            'id' => $id,
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'ip_address' => $request->ip_address,
            'status' => $request->status,
        ]);

        return redirect()->route('customer.index')->with('success', 'Data created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customer-edit', compact('customer'));
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
        // Validasi input
        $this->validate($request, [
            'full_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'ip_address' => 'required',
            'status' => 'required',
        ]);

        Customer::find($id)->update($request->all());

        return redirect()->route('customer.index')->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // dd($request);
        Customer::find($id)->delete();

        return redirect()->route('customer.index')->with('success', 'Data deleted successfully');
    }
}
