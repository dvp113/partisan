<?php

namespace App\Http\Controllers;

use App\Challenge;
//use App\Nodes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function PHPSTORM_META\type;
use Yajra\DataTables\Facades\DataTables;

class ChallengeController extends Controller
{
    /**
     * Instantiate a new ChallengeController instance.
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //@TODO rename page view
        return view('challenge.index');
    }

    public function getData()
    {
        return DataTables::of(Challenge::query())
            ->addColumn('action', function ($element) {
                return '<btn id="edit_'.$element->id.'" class="btn btn-xs btn-primary"   onClick="edit(this)"><i class="far fa-edit"></i> Edit</btn>
                        <btn id="delete_'.$element->id.'" class="btn btn-xs btn-danger" onClick="remove(this)"><i class="fas fa-trash"></i> Remove</btn>';
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Challenge $model)
    {
        //Validate data

        $data = $request->all();

        $new_record = Challenge::create($data);
        return $new_record? "success" : "failed: internal error";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Challenge  $model
     * @return \Illuminate\Http\Response
     */
    public function show(Challenge $model)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Challenge  $model
     * @return \Illuminate\Http\Response
     */
    public function edit(Challenge $model)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Challenge  $model
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Challenge $model)
    {
        $key = 'id';

        $data = $request->all();
        if (!array_key_exists($key, $data)){
            echo "fail: Key '$key' not found";
        }
        else{
            $id = $data['id'];
            unset($data['id']);

            //Update data
            $result = Challenge::find($id)->update($data);
            return $result? "success" : "fail";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  number id
     * @return "success" || "fail"
     */
    public function destroy($id)
    {
        if (!is_null($id) && is_numeric($id)){
            $deleted_rows = Challenge::find($id)->delete();
            return $deleted_rows? "success" : "fail";
        }
        return "fail";
    }
}
