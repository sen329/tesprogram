<?php

namespace App\Http\Controllers;

use App\Models\Guestlist;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use DB;

class GuestlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $guestlist=Guestlist::all();
        return response()->json($guestlist, 200);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            Guestlist::create(
                $request->all()
);

            return response()->json('OK',200);
        } 
        catch(Exception $ex){
            return response($ex);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guestlist  $guestlist
     * @return \Illuminate\Http\Response
     */
    public function show(Guestlist $guestlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guestlist  $guestlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Guestlist $guestlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guestlist  $guestlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $guestlist = [
            "name"=>$request->name,
            "address"=>$request->address,
            "married"=>$request->married,
            "gender"=>$request->gender
        ];
        // dd($guestlist);
        try
        {
            Guestlist::findOrFail($id)->update($guestlist);
            return response()->json($guestlist,200);
        }
        catch(Exception $ex)
        {
            return response($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guestlist  $guestlist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Guestlist::where('id',$id)->delete();
        return response()->json('OK',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * 
     * @return \Illuminate\Http\Response
     */

    public function addColumn(Request $request){
        $newColumnType = $request->columntype;
        $newColumnName = $request->columnname;

        try{
            Schema::table('guestlists', function (Blueprint $table) use ($newColumnType, $newColumnName){
                $table->$newColumnType($newColumnName)->default(0);
        });
        }

        catch(Exception $ex){
            return response()->json($ex);
        }
    }

    public function getColumns(){

        $columnlist = Schema::getColumnListing('guestlists');

        $list = json_encode($columnlist, JSON_FORCE_OBJECT);

        return response()->json($list);

        
        
    }


}
