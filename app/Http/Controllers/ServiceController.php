<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Service::all();

        return view('services.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
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
            'title'=>'required',
            'desc' => 'required',
            'full_desc' =>'required',
        ]);

        if($request->hasFile('photo')) {
            $imgPath = $request->file('photo')->store('img');
        } else {
            $imgPath =null;
        }

        $data=new Service;
        $data->title=$request->title;
        $data->desc=$request->desc;
        $data->full_desc=$request->full_desc;
        $data->photo = $imgPath;
        $data->save();

        return redirect ('/admin/services/create')->with('success', 'usluga dodana');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=Service::find($id);
        return view ('services.show', ['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Service::find($id);
        return view ('services.edit', ['data'=>$data]);
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
            'title'=>'required',
            'desc' => 'required',
            'full_desc' =>'required',
        ]);
        if($request->hasFile('photo')){
            $imgPath=$request->file('photo')->store('img');
        } else {
            $imgPath=$request->last_photo;
        }



        $data=Service::find($id);
        $data->title=$request->title;
        $data->desc=$request->desc;
        $data->full_desc=$request->full_desc;
        $data->photo = $imgPath;
        $data->save();

        return redirect ('/admin/services/'. $id .'/edit')->with('success', 'usługa zmieniona');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('services')->where('id', $id)->delete();

        return redirect ('/admin/services/')->with('success', 'usluga usunieta.');
    }
}
