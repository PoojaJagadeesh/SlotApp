<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Validator; 
use App\Models\Slot;
use App\Models\Parkslot;
use Carbon\Carbon;


class SlotController extends Controller
{
    //
    public function slotCreate(Request $request)
    {
        $validator = Validator::make($request->all(),[ 
            'customer_name'=>'required',
            'vehicle_number'=>'required',
            
            'license' => 'required|mimes:pdf|max:2048',
      ]);   

      if($validator->fails()) {          
           
          return response()->json(['error'=>$validator->errors()], 401);                        
       }  
       $parkslot=DB::table('parkslots')->where('availability', '1')->first();
       $input=$request->all();
       $file=$request->file('license');
       $uploadFolder='licenses';
       $image_uploaded_path = $file->store($uploadFolder, 'public');
     
      
      if ($input) {
        $input['license']=$image_uploaded_path;
        $input['parkslot_id']=$parkslot->id;

         
          $slot=Slot::create($input);
          Parkslot::where('id', $parkslot->id)
    
      ->update(['availability' => '0']);

          return response()->json([
            "success" => true,
            "message" => "Slot created",
            "data" => $slot
            ]);

       // return response($data, Response::HTTP_CREATED);
    }
}
public function getSlot(){
    return Slot::all();
}

public function exitSlot(Request $request,Slot $slot)
{
    
    $start = Carbon::parse($slot->booking_start);
$end = Carbon::now();
$interval =Carbon::now()->diffInMinutes($start,false);
$fees=env('MIN_FEE');
if(env('MIN_TIME_MINUTES')<=$interval){
   
    $additional=($interval-env('MIN_TIME_MINUTES'))/60;
    if($additional>0){
        $fees+=($additional*env('EXTRA_FEE_MIN'));
    }
   
}

 DB::table('slots')
              ->where('id',$request->id)
              ->update(['fee' => $fees,'booking_end'=>$end]);
              $slot=Slot::find($request->id);
   
    return response()->json([
        "success" => true,
        "message" => "Slot exited",
        "data" => $slot
        ]);
}



}
