<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\RoomType;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=RoomType::all();
        return view ('room.index', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roomtypes=RoomType::all();

        return view ('room.create', ['roomtypes'=>$roomtypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=new Room;
        $data->room_type_id=$request->room_type_id;
        $data->title=$request->title;
        $data->save();

        return redirect ('/admin/room/create')->with('success', 'pokoj dodany do BD');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roomtypes=RoomType::all();
        $data=Room::find($id);
        return view ('room.show', ['data'=>$data, 'roomtypes'=>$roomtypes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roomtypes=RoomType::all();
        $data=Room::find($id);
        return view ('room.edit', ['data'=>$data, 'roomtypes'=>$roomtypes]);

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
        $data=Room::find($id);
        $data->room_type_id=$request->room_type_id;
        $data->title=$request->title;
        $data->save();

        return redirect ('/admin/room/'. $id .'/edit')->with('success', 'dane pokoju zmienione.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('rooms')->where('id', $id)->delete();

        return redirect ('/admin/room/')->with('success', 'pokoj zostal usuniety.');
    }
}
