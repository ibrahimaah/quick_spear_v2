<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\DeliveryPrice;
use App\Models\Region;
use App\Services\DeliveryPriceService;
use App\Services\RegionService;
use Illuminate\Http\Request;

class DeliveryPriceController extends Controller
{
 
    public function __construct(private DeliveryPriceService $deliveryPriceService,private RegionService $regionService){}
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
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'shop_id' => 'required',
    //         'cities' => 'required',
    //         'regions' => 'nullable',
    //         'price' => 'required|numeric|gt:0'
    //     ]);
          
    //     /*
    //         في حال اختار محافظة ... يمكن تحديد مناطق
    //         في حال اختيار اكثر من محافظة عندئذ لا يمكن اختيار مناطق     
    //     */
    //     $locations_ids = $request->has('regions') ? $validated['regions'] : $validated['cities']; 
    //     $data=[];
    //     $i=0;
    //     foreach($locations_ids as $location_id)
    //     {
    //         $data[$i] = [
    //             'shop_id' => $validated['shop_id'],
    //             'location_type' => 'App\Models'.$request->has('regions') ? '\Region' : '\City',
    //             'location_id' => $location_id,
    //             'price' => $validated['price'],
    //         ];

    //         $i++;
    //     }
  
        
    //     $res_store = $this->deliveryPriceService->store($data);
        
    //     if ($res_store['code'] == 1) 
    //     {
    //         return back()->with('success','تم حفظ البيانات بنجاح');
    //     }else 
    //     {
    //         return back()->with('error',$res_store['msg']);
    //     }
    // }
 
    public function store(Request $request)
    {
        $validated = $request->validate([
            'shop_id' => 'required',
            'cities' => 'required',
            'regions' => 'nullable',
            'price' => 'required|numeric|gt:0',
        ]);

        /*
            في حال اختار محافظة ... يمكن تحديد مناطق
            في حال اختيار اكثر من محافظة عندئذ لا يمكن اختيار مناطق 
        */

        $locationType = $request->has('regions') ? \App\Models\Region::class : \App\Models\City::class;
        $locations    = $validated['regions'] ?? $validated['cities'];

        $data = array_map(function ($locationId) use ($validated, $locationType) {
            return [
                'shop_id' => $validated['shop_id'],
                'location_type' => $locationType,
                'location_id' => $locationId,
                'price' => $validated['price'],
            ];
        }, $locations); 
        
        $resStore = $this->deliveryPriceService->store($data);

        return back()->with(
            $resStore['code'] === 1 ? 'success' : 'error',
            $resStore['code'] === 1 ? 'تم حفظ البيانات بنجاح' : $resStore['msg']
        )->with('is_active_delivery_price_tab', true);
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
        $validated = $request->validate([
            'price' => 'required|numeric|gt:0',
        ]);

        $res_update = $this->deliveryPriceService->update($validated['price'],$id);
        if ($res_update['code'] == 1) 
        {
            return back()->with('success','تم تعديل السعر بنجاح')->with('is_active_delivery_price_tab', true);
        }
        else 
        {
            return back('error',$res_update['msg'])->with('is_active_delivery_price_tab', true);
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
        $res_destroy = $this->deliveryPriceService->destroy($id);
        if ($res_destroy['code'] == 1) 
        {
            return redirect()->back()->with("success","تم حذف البيانات بنجاح")->with('is_active_delivery_price_tab', true);
        }
        else 
        {
            return redirect()->back()->with("error",$res_destroy['msg'])->with('is_active_delivery_price_tab', true);
        }
    }


    public function get_regions_by_city_id($city_id)
    {
        
        $res_get_regions_by_city_id = $this->regionService->get_regions_by_city_id($city_id);
        if ($res_get_regions_by_city_id['code'] == 1) 
        {
            return response()->json(['code' => 1 , 'data' => $res_get_regions_by_city_id['data']]);
        }
        else 
        {
            return response()->json(['code' => 0 , 'msg' => $res_get_regions_by_city_id['msg']]);
        }
    }
}
