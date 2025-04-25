<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$pets = Pet::all();
        
        $pets = Pet::with('client')->get();

        if($pets->count() > 0){
            return response()->Json([
                    'status' => 200,
                    'pets' => $pets

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
        
        
        $client = Client::find($request->client_id);

        if (!$client){
            return response()->json([
                'status' => 404,
                'message' => 'No such Client Found!'
            ],404);
        }else{
            $validator = Validator::make($request->all(),[
               'client_id'  => 'required',
               'name'  => 'required',
               'specie'  => 'required', 
               'breed'  => 'required', 
               'color'  => 'required', 
               'height' => 'required', 
               'weight' => 'required', 
               'gender' => 'required',
               'birth_date'  => 'required',
               'father'  => 'required',
               'mother'  => 'required',
               'observations'  => 'required',
            ]);
            if($validator->fails()){
                return response()->json([
                    'status' => 422,
                    'errors'=> $validator->messages()
                ], 422);
            }else{

                // Supondo que esteja usando algo como $request->birth_date
              $birthDate = Carbon::createFromFormat('d/m/Y', $request->birth_date)->
              format('Y-m-d');

                $pet = Pet::create([
               'client_id'  =>  $request->client_id,
               'name'  => $request->name,
               'specie'  => $request->specie, 
               'breed'  => $request->breed, 
               'color'  => $request->color, 
               'height' => $request->height, 
               'weight' => $request->weight, 
               'gender' => $request->gender,
               'birth_date'  => $birthDate, // data já formatada
               'father'  => $request->father,
               'mother'  => $request->mother,
               'observations'  => $request->observations
                ]);

                if($pet){
                    return response()->json([
                        'status' => 200,
                        'message' => 'Pet Create Successfully'
                    ],200);
                }else{
    
                    return response()->json([
                        'status' => 500,
                        'message' => 'Something Went Wrong!'
                    ],500);
    
                }

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
        $pet = Pet::find($id);
        if($pet){
            return response()->json([
                'status' => 200,
                'pet' => $pet
            ],200);

        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No such Pet Found!'
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
            

            'client_id'=> 'required',
            'name'=> 'required',
            'specie'=> 'required', 
            'breed'=> 'required', 
            'color'=> 'required', 
            'height'=> 'required', 
            'weight'=> 'required', 
            'gender'=> 'required',
            'birth_date'=> 'required',
            'father'=> 'required',
            'mother'=> 'required',
            'observations'=> 'required',
            
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors'=> $validator->messages()
            ], 422);
        } else {

            $client = Client::find($request->client_id);

            if (!$client){
                return response()->json([
                    'status' => 404,
                    'message' => 'No such Client Found!'
                ],404);
            } else {

                $pet = Pet::find($id);
    
                if($pet){

                       // Supondo que esteja usando algo como $request->birth_date
              $birthDate = Carbon::createFromFormat('d/m/Y', $request->birth_date)->
              format('Y-m-d');
    
                    $pet->update([
                        'client_id'  =>  $request->client_id,
                        'name'  => $request->name,
                        'specie'  => $request->specie, 
                        'breed'  => $request->breed, 
                        'color'  => $request->color, 
                        'height' => $request->height, 
                        'weight' => $request->weight, 
                        'gender' => $request->gender,
                        'birth_date'  => $birthDate, // data já formatada
                        'father'  => $request->father,
                        'mother'  => $request->mother,
                        'observations'  => $request->observations
                    ]);
    
                    return response()->json([
                        'status' => 200,
                        'message' => 'Pet Updated Successfully'
                    ],200);
                }else{

                    return response()->json([
                        'status' => 404,
                        'message' => 'No Such Pet Found!'
                    ],404);
    
                }
    
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
        $pet = Pet::find($id);
        if($pet){
            $pet->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Pet Deleted Sucessfully!'
            ],200);

        }else {

            return response()->json([
                'status' => 404,
                'message' => 'No Such Pet Found!'
            ],404);

        }
    }
}
