<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vets = Vet::all();

        if($vets->count() > 0){
            return response()->Json([
                    'status' => 200,
                    'vets' => $vets

            ], 200);
        } else {
            
                return response()->Json([
                    'status' => 404,
                    'message' => 'No Records Found'

                 ], 404);

        }
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'cell_phone' => 'required',
            'address' => 'required',
            'state' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors'=> $validator->messages()
            ], 422);
        }else {
            $vet = Vet::create([
                'name' => $request->name,
                'email'  => $request->email,
                'cell_phone'  => $request->cell_phone,
                'address'  => $request->address,
                'state' => $request->state
            ]);

            if($vet){
                return response()->json([
                    'status' => 200,
                    'message' => 'Vet Create Successfully'
                ],200);
            }else{

                return response()->json([
                    'status' => 500,
                    'message' => 'Something Went Wrong!'
                ],500);

            }
        }
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
        $vet = Vet::find($id);
        if($vet){
            return response()->json([
                'status' => 200,
                'vet' => $vet
            ],200);

        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No such Vet Found!'
            ],404);

        }
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
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'cell_phone' => 'required',
            'address' => 'required',
            'state' => 'required'
            
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors'=> $validator->messages()
            ], 422);
        }else {
            $vet = Vet::find($id);
           
            if($vet){

                $vet->update([
                    'name' => $request->name,
                    'email'  => $request->email,
                    'cell_phone'  => $request->cell_phone,
                    'address'  => $request->address,
                    'state' => $request->state
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Vet Updated Successfully'
                ],200);
            }else{

                return response()->json([
                    'status' => 404,
                    'message' => 'No Such Vet Found!'
                ],404);

            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vet = Vet::find($id);
        if($vet){
            $vet->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Vet Deleted Sucessfully!'
            ],200);

        }else {

            return response()->json([
                'status' => 404,
                'message' => 'No Such Vet Found!'
            ],404);

        }
    }
}
