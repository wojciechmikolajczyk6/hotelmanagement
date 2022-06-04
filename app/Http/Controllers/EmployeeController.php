<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Employee::all();
        return view ('employee.index', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departements=Department::all();

        return view ('employee.create', ['departements'=>$departements]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data=new Employee;

        $imgPath=$request->file('photo')->store('img');

        $data->full_name=$request->full_name;
        $data->department_id=$request->department_id;
        $data->photo=$imgPath;
        $data->password=md5($request->password);
        $data->username=$request->username;

        $data->salary=$request->salary;
        $data->save();

        return redirect ('/admin/employee/create')->with('success', 'pracownik dodany do BD');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data=Employee::find($id);
        return view ('employee.show', ['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments=Department::all();
        $data=Employee::find($id);
        return view ('employee.edit', ['data'=>$data, 'departments'=>$departments]);

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
            'department_id' => 'required',
            'password' =>'required',
            'salary' => 'required'
        ]);


        $data=Employee::find($id);

        if($request->hasFile('photo')){
            $imgPath=$request->file('photo')->store('img');
        } else {
            $imgPath=$request->last_photo;
        }


        $data->full_name=$request->full_name;
        $data->department_id=$request->department_id;
        $data->photo=$imgPath;
        $data->password=md5($request->password);
        $data->salary=$request->salary;
        $data->save();

        return redirect ('/admin/employee/'. $id .'/edit')->with('success', 'dane pracownika zmienione.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('employees')->where('id', $id)->delete();

        return redirect ('/admin/employee/')->with('success', 'pracownik zostal usuniety.');
    }


    function login(){
        return view('loginEmployee');

    }
//Login validation
    function validate_login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $admin=Employee::where(['username'=>$request->username, 'password'=> md5($request->password)])
            ->count();
        if($admin>0){
            $employeeData=Employee::where(['username'=>$request->username, 'password'=> md5($request->password)])->get();
            session(['employeeData'=>$employeeData]);

            if ($request->has('rememberme')){
                Cookie::queue('employeeuser', $request->username, 1440);
                Cookie::queue('employeepassword', $request->password, 1440);

            }


            return redirect('/admin');
        } else {
            return redirect('/employee/login')->with('message', 'invalid username or password!');
        }

    }
}
