<?php

namespace App\Http\Controllers;

use App\GameTurn;
use \App\TurnOrder;
use Illuminate\Http\Request;

class TurnOrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $turnOrder = new TurnOrder();

        $turnOrder->gameturn_id = $request->gameturn_id;
        $turnOrder->user_id = Auth()->user()->id;
        $turnOrder->message = $request->message;

        $turnOrder->save();

        return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        error_log("id received is $id");
        $turnOrder = TurnOrder::find($id);
        if (isset($turnOrder)) {
            $turnOrder->message = $request->message;
            $turnOrder->save();

        } else{abort(404);}

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        TurnOrder::where('id', $id)->get()->each->delete(); //FIXME: strange... it seems to not recognize the id as primary key.

        return redirect()->back();

    }

}

?>