<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ExpressDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDelegateRequest;
use App\Http\Requests\UpdateDelegateRequest;
use App\Models\City;
use App\Models\Delegate;
use App\Models\Shipment;
use App\Models\ShipmentStatus;
use App\Services\DelegateService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PDF;
use Illuminate\Support\Str;

class DelegateController extends Controller
{

    public function __construct(private DelegateService $delegateService)
    {
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.delegates.index', ['delegates' => Delegate::orderBy('created_at','desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(session()->all());
        Log::info(session()->all());
        return view('admin.delegates.create',['cities'=>City::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDelegateRequest $request)
    {
        $validated = $request->validated();
        
        $res_store = $this->delegateService->store($validated);

        if ($res_store['code'] == 1) 
        {
            // return redirect()->route('admin.delegates.index')->with("success", "تم اضافة البيانات بنجاح");
            return redirect()->back()->with("success", "تم اضافة البيانات بنجاح");
        }
        else
        {
            return redirect()->route('admin.delegates.index')->with("error",$res_store['msg']);
            return redirect()->back()->with("error",$res_store['msg']);
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
    public function edit(Delegate $delegate)
    {
        return view('admin.delegates.edit', ['delegate' => $delegate ,'cities'=>City::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDelegateRequest $request,Delegate $delegate)
    {
        $validated = $request->validated();
        
        $res_update = $this->delegateService->update($validated,$delegate);

        if ($res_update['code'] == 1) 
        {
            // return redirect()->route('admin.delegates.index')->with("success", "تم حفظ البيانات بنجاح");
            return redirect()->back()->with("success", "تم حفظ البيانات بنجاح");
        }
        else
        {
            // return redirect()->route('admin.delegates.index')->with("error",$res_update['msg']);
            return redirect()->back()->with("error",$res_update['msg']);
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delegate $delegate)
    {
        $delegate->delete();
        // return redirect()->route('admin.delegates.index')->with("success","تم حذف البيانات بنجاح");
        return redirect()->back()->with("success","تم حذف البيانات بنجاح");
    }

    public function get_shipments(Delegate $delegate)
    {
        $dataTable = new ExpressDataTable(false,null,$delegate->id);
        return $dataTable->render('admin.delegates.show_shipments',compact(['delegate']));
    }

    public function get_delegates_by_city_id(City $city)
    {
        $res_get_delegates_by_city_id = (new DelegateService())->get_delegates_by_city_id($city->id);
        if ($res_get_delegates_by_city_id['code'] == 1) 
        {
            $delegates = $res_get_delegates_by_city_id['data'];
            return response()->json(['code' => 1 , 'data' => $delegates]);
        }
        else 
        {
            return response()->json(['code' => 0 , 'msg' => $res_get_delegates_by_city_id['msg']]);
            
        }
    }


    public function get_delegates_by_shipments_ids(Request $request)
    {
        $shipments_ids = $request->input('shipments_ids');
        $res_get_delegates_by_shipments_ids = (new DelegateService())->get_delegates_by_shipments_ids($shipments_ids);
        if ($res_get_delegates_by_shipments_ids['code'] == 1) 
        {
            $delegates = $res_get_delegates_by_shipments_ids['data'];
            return response()->json(['code' => 1 , 'data' => $delegates]);
        }
        else 
        {
            return response()->json(['code' => 0 , 'msg' => $res_get_delegates_by_shipments_ids['msg']]);
            
        }
        
    }


    public function get_delegates_by_city_name($name)
    {
        $res_get_delegates_by_city_name = (new DelegateService())->get_delegates_by_city_name($name);
        if ($res_get_delegates_by_city_name['code'] == 1) 
        {
            $delegates = $res_get_delegates_by_city_name['data'];
            return response()->json(['code' => 1 , 'data' => $delegates]);
        }
        else 
        {
            dd($res_get_delegates_by_city_name['msg']);
        }
    }

 

    // public function delegate_daily_delivery_statement(Delegate $delegate)
    // {
    //     try 
    //     {
    //         $delegate_name = $delegate->name;
    //         $now = Carbon::now(); 
    //         $currentDayInArabic = $now->translatedFormat('l');
    //         $currentDateInArabic = convertToArabicNumerals($now->format('Y/m/d')); 

    //         $shipments = Shipment::where([
    //             ['delegate_id', $delegate->id],
    //             ['is_deported', false]
    //         ])
    //         ->whereIn('shipment_status_id', [
    //             ShipmentStatus::UNDER_DELIVERY,
    //             ShipmentStatus::POSTPONED
    //         ])
    //         ->get();
        
            
    //         $pdf = PDF::loadView('admin.delegates.delegate_daily_delivery_statement',compact('currentDayInArabic',
    //                                                                                         'currentDateInArabic',
    //                                                                                         'shipments',
    //                                                                                         'delegate_name'));

    //         $pdf_file_name = 'delegate_daily_statement_'.$now->format('Y-m-d').'_'.floor(time()-999999999);
        
    //         return response()->streamDownload(function() use ($pdf) {
    //             echo $pdf->output();
    //         }, $pdf_file_name.'.pdf', [
    //             'Content-Type' => 'application/pdf',
    //             'Content-Disposition' => 'inline; filename="'.$pdf_file_name.'.pdf"'
    //         ]); 
    //     }
    //     catch(Exception $ex)
    //     {
    //         dd($ex->getMessage());
    //     }
    // }

    // public function delegate_final_delivery_statement(Delegate $delegate)
    // {
    //     try 
    //     {
    //         $res_get_total_summation = $this->delegateService->get_total_summation($delegate);
    //         $res_get_total_delegate_commission = $this->delegateService->get_total_delegate_commission($delegate);

    //         if ($res_get_total_summation['code'] == 0) 
    //         {
    //             // return back()->with('error',$res_get_total_summation['msg']);
    //             dd($res_get_total_summation['msg']);
    //         }

    //         if ($res_get_total_delegate_commission['code'] == 0) 
    //         {
    //             // return back()->with('error',$res_get_total_delegate_commission['msg']);
    //             dd($res_get_total_delegate_commission['msg']);
    //         }

    //         $now = Carbon::now();

    //         $delegate_name = $delegate->name;
    //         $currentDayInArabic = $now->translatedFormat('l');
    //         $currentDateInArabic = convertToArabicNumerals($now->format('Y/m/d'));  
    //         $total_summation = $res_get_total_summation['data'];
    //         $total_delegate_commission = $res_get_total_delegate_commission['data'];
    //         $shipments = Shipment::where([
    //             ['delegate_id', $delegate->id],
    //             ['is_deported', false]
    //         ])->get();

    //         $pdf = PDF::loadView('admin.delegates.delegate_final_delivery_statement',compact('delegate_name', 
    //                                                                                         'currentDayInArabic', 
    //                                                                                         'currentDateInArabic', 
    //                                                                                         'total_summation', 
    //                                                                                         'total_delegate_commission', 
    //                                                                                         'shipments'));

    //         $pdf_file_name = 'delegate_final_statement_'.$now->format('Y-m-d').'_'.floor(time()-999999999);
    //         // return $pdf->stream('invoice.pdf');
    //         return response()->streamDownload(function() use ($pdf) {
    //             echo $pdf->output();
    //         }, $pdf_file_name.'.pdf', [
    //             'Content-Type' => 'application/pdf',
    //             'Content-Disposition' => 'inline; filename="'.$pdf_file_name.'.pdf"'
    //         ]); 
    //     }
    //     catch(Exception $ex)
    //     {
    //         dd($ex->getMessage());
    //     }
    // }

    private function generateDelegatePDF($view, $data, $delegate)
    {
        $now = Carbon::now();
        $delegate_name = $delegate->name;
        $currentDayInArabic = $now->translatedFormat('l');
        $currentDateInArabic = convertToArabicNumerals($now->format('Y/m/d'));
        
        // Prepare data for the PDF view
        $data = array_merge($data, [
            'delegate_name' => $delegate_name,
            'currentDayInArabic' => $currentDayInArabic,
            'currentDateInArabic' => $currentDateInArabic,
        ]);

        // Generate the PDF
        $pdf = PDF::loadView($view, $data);

        $pdf_file_name = str_replace('admin.delegates.delegate_', '', $view) . '_' . $now->format('Y-m-d') . '_' . floor(time() - 999999999);

        return response()->streamDownload(function() use ($pdf) {
            echo $pdf->output();
        }, $pdf_file_name . '.pdf', [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $pdf_file_name . '.pdf"'
        ]);
    }

    public function delegate_daily_delivery_statement(Delegate $delegate)
    {
        try 
        {
            $shipments = Shipment::where([
                ['delegate_id', $delegate->id],
                ['is_deported', false]
            ])
            ->whereIn('shipment_status_id', [
                ShipmentStatus::UNDER_DELIVERY,
                ShipmentStatus::POSTPONED
            ])
            ->get();

            return $this->generateDelegatePDF('admin.delegates.delegate_daily_delivery_statement', ['shipments' => $shipments], $delegate);
        }
        catch(Exception $ex)
        {
            dd($ex->getMessage());
        }
    }

    public function delegate_final_delivery_statement(Delegate $delegate)
    {
        try 
        {
            $res_get_total_summation = $this->delegateService->get_total_summation($delegate);
            $res_get_total_delegate_commission = $this->delegateService->get_total_delegate_commission($delegate);

            if ($res_get_total_summation['code'] == 0) 
            {
                dd($res_get_total_summation['msg']);
            }

            if ($res_get_total_delegate_commission['code'] == 0) 
            {
                dd($res_get_total_delegate_commission['msg']);
            }

            $total_summation = $res_get_total_summation['data'];
            $total_delegate_commission = $res_get_total_delegate_commission['data'];
            $shipments = Shipment::where([
                ['delegate_id', $delegate->id],
                ['is_deported', false]
            ])->get();

            return $this->generateDelegatePDF('admin.delegates.delegate_final_delivery_statement', [
                'total_summation' => $total_summation,
                'total_delegate_commission' => $total_delegate_commission,
                'shipments' => $shipments
            ], $delegate);
        }
        catch(Exception $ex)
        {
            dd($ex->getMessage());
        }
    }


    public function get_initial_delivery_1st_btn_state(Delegate $delegate)
    {
        $res_chk_all_delegate_shipments_has_status = $this->delegateService->chk_all_delegate_shipments_has_status($delegate,[ShipmentStatus::UNDER_DELIVERY,ShipmentStatus::POSTPONED]);

        if ($res_chk_all_delegate_shipments_has_status['code'] == 1) 
        {
            return response()->json(['code' => 1, 'data' => $res_chk_all_delegate_shipments_has_status['data'] ]);
        }
        else 
        {
            return response()->json(['code' => 0, 'msg' => $res_chk_all_delegate_shipments_has_status['msg']]);
        }
    }

    public function get_initial_delivery_2nd_btn_state(Delegate $delegate)
    {
        $res_chk_all_delegate_shipments_not_has_status = $this->delegateService->chk_all_delegate_shipments_not_has_status($delegate,[ShipmentStatus::UNDER_DELIVERY,ShipmentStatus::UNDER_REVIEW]);
        
        if ($res_chk_all_delegate_shipments_not_has_status['code'] == 1) 
        {
            return response()->json(['code' => 1,'data' => $res_chk_all_delegate_shipments_not_has_status['data']]);
        }
        else 
        {
            return response()->json(['code' => 0, 'msg' => $res_chk_all_delegate_shipments_not_has_status['msg']]);
        }
    }

    public function deport(Delegate $delegate)
    {
        $res_deport = $this->delegateService->deport($delegate);
        if ($res_deport['code'] == 1) 
        {
            return back()->with('success','تمت العملية بنجاح');
        }
        else 
        {
            dd($res_deport['msg']);
            return back()->with('error',$res_deport['msg']);
        }
    }
}
