<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Pet;
use App\Models\Vet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           //$pets = Pet::all();
        
           // $consultations = Consultation::with('vet')->get();

           $consultations = Consultation::with(['vet', 'pet', 'procedures'])->get();

           if($consultations->count() > 0){
               return response()->Json([
                       'status' => 200,
                       'consultations' => $consultations
   
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
        $pet = Pet::find($request->pet_id);
        $vet = Vet::find($request->vet_id);

        if (!$pet){
            return response()->json([
                'status' => 404,
                'message' => 'No such Pet Found!'
            ],404);
        }


        if (!$vet){
            return response()->json([
                'status' => 404,
                'message' => 'No such Vet Found!'
            ],404);
        }

        $validator = Validator::make($request->all(),[
            'vet_id'  => 'required',
            'pet_id'  => 'required',
            'the_date'  => 'required|date', 
            'total_cost'  => 'required|numeric',
            'procedures'  => 'required|array|min:1', // o array deve ter pelo menos 1 item
            'procedures.*'=> 'exists:procedures,id'  // valida se cada ID existe na tabela procedures
         ]);

         if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors'=> $validator->messages()
            ], 422);
        }else{

             // Cria a consulta
                $consultation = Consultation::create([
                    'pet_id'     => $request->pet_id,
                    'vet_id'     => $request->vet_id,
                    'the_date'   => $request->the_date,
                    'total_cost' => $request->total_cost,
                ]);

                    // Associa os procedimentos à consulta (tabela pivot)
                    $consultation->procedures()->attach($request->procedures);
                
                    if($consultation){
                        return response()->json([
                            'status' => 200,
                            'message' => 'Consultation Create Successfully'
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
        $consultation = Consultation::with(['vet', 'pet', 'procedures'])->find($id);

       // $pet = Pet::find($id);
        if($consultation){
            return response()->json([
                'status' => 200,
                'consultation' => $consultation
            ],200);

        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No such Pet Found!'
            ],404);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $consultation = Consultation::find($id);
        if($consultation){
            $consultation->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Consultation Deleted Sucessfully!'
            ],200);

        }else {

            return response()->json([
                'status' => 404,
                'message' => 'No Such Pet Found!'
            ],404);

        }
    }
}
