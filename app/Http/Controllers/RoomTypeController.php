<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\RoomType;
use Illuminate\Support\Facades\DB;
use App\Models\Roomimage;
use Illuminate\Support\Facades\Storage;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=RoomType::all();
        return view ('rooms.index', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('rooms.create');
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
            'title' => 'required',
            'details' => 'required',
            'price' => 'required'
        ]);

        $data=new RoomType;
        $data->title=$request->title;
        $data->details=$request->details;
        $data->price=$request->price;
        $data->save();

        foreach($request->file('images') as $image){
            $imgPath=$image->store('img');
            $imageData= new Roomimage;
            $imageData->room_type_id=$data->id;
            $imageData->image_path=$imgPath;
            $imageData->image_alt=$request->title;
            $imageData->save();
        }


        return redirect ('/admin/rooms/create')->with('success', 'pokoj dodany do BD');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=RoomType::find($id);
        return view ('rooms.show', ['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=RoomType::find($id);
        return view ('rooms.edit', ['data'=>$data]);

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
        $data=RoomType::find($id);
        $data->title=$request->title;
        $data->details=$request->details;
        $data->price=$request->price;
        $data->save();

        if($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {
                $imgPath = $image->store('img');
                $imageData = new Roomimage;
                $imageData->room_type_id = $data->id;
                $imageData->image_path = $imgPath;
                $imageData->image_alt = $request->title;
                $imageData->save();
            }
        }

        return redirect ('/admin/rooms/'. $id .'/edit')->with('success', 'dane pokoju zmienione.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('room_types')->where('id', $id)->delete();

        return redirect ('/admin/rooms/')->with('success', 'pokoj zostal usuniety.');
    }
    public function delete_image($img_id)
    {
        $data=Roomimage::where('id', $img_id)->first();
        Storage::delete($data->image_path);
        Roomimage::where('id', $img_id)->delete();
        return response()->json(['bool'=>true]);

    }
}
