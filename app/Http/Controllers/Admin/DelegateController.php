<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ExpressDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDelegateRequest;
use App\Http\Requests\UpdateDelegateRequest;
use App\Models\City;
use App\Models\Delegate;
use App\Models\ShipmentStatus;
use App\Services\DelegateService;
use Carbon\Carbon;
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
            return redirect()->route('admin.delegates.index')->with("success", "تم اضافة البيانات بنجاح");
        }
        else
        {
            return redirect()->route('admin.delegates.index')->with("error",$res_store['msg']);
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
        // dd($validated);
        $res_update = $this->delegateService->update($validated,$delegate);

        if ($res_update['code'] == 1) 
        {
            return redirect()->route('admin.delegates.index')->with("success", "تم حفظ البيانات بنجاح");
        }
        else
        {
            return redirect()->route('admin.delegates.index')->with("error",$res_update['msg']);
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
        return redirect()->route('admin.delegates.index')->with("success","تم حذف البيانات بنجاح");
    }

    public function get_shipments(Delegate $delegate)
    {
        $dataTable = new ExpressDataTable(false,null,$delegate->id); 
        $is_disable_1st_btn = true;
        
        foreach($delegate->shipments as $shipment)
        {
            if($shipment->shipment_status_id != ShipmentStatus::UNDER_DELIVERY)
            {
                $is_disable_1st_btn = true;
                break;
            }
            else 
            {
                $is_disable_1st_btn = false;
            }
        }

        // $is_disable_1st_btn = false;
        $is_disable_2st_btn = false;
        return $dataTable->render('admin.delegates.show_shipments',['delegate' => $delegate,'is_disable_1st_btn'=>$is_disable_1st_btn,'is_disable_2st_btn'=>$is_disable_2st_btn]);
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
            dd($res_get_delegates_by_city_id['msg']);
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


    // Convert Arabic numerals if needed
    function convertToArabicNumerals($number) {
        $westernArabic = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $easternArabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        return str_replace($westernArabic, $easternArabic, $number);
    }

    public function delegate_daily_delivery_statement(Delegate $delegate)
    {
        
        // Set the locale to Arabic
        Carbon::setLocale('ar');
        // Get the current date
        $now = Carbon::now();

        // Get the current day in Arabic
        $currentDayInArabic = $now->translatedFormat('l');
        $currentDate = $now->format('Y/m/d');
        $currentDateInArabic = $this->convertToArabicNumerals($currentDate);
        Carbon::setLocale('en');
        
        $statement_data = [];
        $statement_data['current_day'] = $currentDayInArabic;
        $statement_data['current_date'] = $currentDateInArabic; 

   
        $pdf = PDF::loadView('admin.delegates.delegate_daily_delivery_statement',['statement' => $statement_data,
                                                                                  'delegate' => $delegate]);

        $pdf_file_name = 'delegate_daily_statement_'.$now->format('Y-m-d').'_'.floor(time()-999999999);
        // return $pdf->stream('invoice.pdf');
        return response()->streamDownload(function() use ($pdf) {
            echo $pdf->output();
        }, $pdf_file_name.'.pdf', [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$pdf_file_name.'.pdf"'
        ]);
        // return view('admin.delegates.delegate_daily_delivery_statement');
    }

    public function delegate_final_delivery_statement(Delegate $delegate)
    {
        
        // Set the locale to Arabic
        Carbon::setLocale('ar');
        // Get the current date
        $now = Carbon::now();

        // Get the current day in Arabic
        $currentDayInArabic = $now->translatedFormat('l');
        $currentDate = $now->format('Y/m/d');
        $currentDateInArabic = $this->convertToArabicNumerals($currentDate);
        Carbon::setLocale('en');
        
        $statement_data = [];
        $statement_data['current_day'] = $currentDayInArabic;
        $statement_data['current_date'] = $currentDateInArabic; 

   
        $pdf = PDF::loadView('admin.delegates.delegate_final_delivery_statement',['statement' => $statement_data,
                                                                                  'delegate' => $delegate]);

        $pdf_file_name = 'delegate_final_statement_'.$now->format('Y-m-d').'_'.floor(time()-999999999);
        // return $pdf->stream('invoice.pdf');
        return response()->streamDownload(function() use ($pdf) {
            echo $pdf->output();
        }, $pdf_file_name.'.pdf', [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$pdf_file_name.'.pdf"'
        ]);
        // return view('admin.delegates.delegate_daily_delivery_statement');
    }
}
