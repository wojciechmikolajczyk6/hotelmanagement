<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Customer::all();

        return view('customers.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name'=>'required',
            'email' => 'required|email',
            'password' =>'required',
            'phone' => 'required'
        ]);

        if($request->hasFile('photo')) {
            $imgPath = $request->file('photo')->store('img');
        } else {
            $imgPath =null;
        }

        $data=new Customer;
        $data->full_name=$request->full_name;
        $data->email=$request->email;
        $data->password=md5($request->password);
        $data->phone=$request->phone;
        $data->address=$request->address;
        $data->photo = $imgPath;
        $data->save();

        if ($request->front == "customer"){
            return redirect ('/register')->with('success', 'Konto zostało utworzone.');
        }

        return redirect ('/admin/customers/create')->with('success', 'klient zostal dodany do bd');
    }
    public function show($id)
    {
        $data=Customer::find($id);
        return view ('customers.show', ['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Customer::find($id);
        return view ('customers.edit', ['data'=>$data]);

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
        $request->validate([
            'full_name'=>'required',
            'email' => 'required|email',
            //'password' =>'required',
            'phone' => 'required',
            'address' => 'required'
        ]);
        if($request->hasFile('photo')){
            $imgPath=$request->file('photo')->store('img');
        } else {
            $imgPath=$request->last_photo;
        }
        if($request->ref == 'frontprofile'){
            $data=Customer::find($id);
            $data->full_name=$request->full_name;
            $data->email=$request->email;
            if($request->password){
            $data->password=md5($request->password);
            }
            $data->phone=$request->phone;
            $data->address=$request->address;
            $data->photo=$imgPath;
            $data->save();
            return redirect ('/profile/'.Session('data')[0]->id)->with('success', 'dane klienta zostaly zmienione.');

        }


        $data=Customer::find($id);
        $data->full_name=$request->full_name;
        $data->email=$request->email;
        if($request->password){
            $data->password=md5($request->password);
        }
        $data->phone=$request->phone;
        $data->address=$request->address;
        $data->photo=$imgPath;
        $data->save();

        return redirect ('/admin/customers/'. $id .'/edit')->with('success', 'dane klienta zostaly zmienione.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('customers')->where('id', $id)->delete();

        return redirect ('/admin/customers/')->with('success', 'klient zostal usuniety z baz danych.');
    }

    function login(){
        return view ('loginCustomer');
    }
    function customer_login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = md5($request->password);

        $user_details = Customer::where(['email'=>$email, 'password'=>$password])->count();
        if ($user_details >0){
            $user_details = Customer::where(['email'=>$email, 'password'=>$password])->get();
            session(['customerLogin' => true, 'data' => $user_details]);
            return redirect ('/')->with('success', 'zostałeś zalogowany');
        } else {
            return redirect('login')->with('fail', 'nieprawidlowe dane');
        }

    }

    function register(){
        return view ('register');
    }
    function logout(){
        session()->forget(['customerLogin', 'data']);
        return redirect('login');
    }




    function profile($id) {
        $booking=Booking::all();
        $user=Customer::find($id);
        return view('profile', ['customer' => $user, 'bookings'=>$booking]);
    }



}
