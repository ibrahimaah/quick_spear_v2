<?php

use App\Models\BillStatus;
use App\Models\BillTracking;
use App\Models\DeliveryPrice;
use App\Services\DeliveryPriceService;
use Illuminate\Support\Facades\Config;

use Carbon\Carbon;

if(!function_exists('get_bill_date_from_bill_number'))
{
    function get_bill_date_from_bill_number($bill_number)
    { 
        $bill_date_string = substr($bill_number, -8);
        return Carbon::createFromFormat('Ymd', $bill_date_string)->format('Y-m-d');
    }
}

if(!function_exists('get_shop_id_from_bill_number'))
{
    function get_shop_id_from_bill_number($bill_number)
    { 
        if (preg_match('/BILL-(\d+)-\d{8}/', $bill_number, $matches)) 
        {
            $shop_id = $matches[1];
            return $shop_id;
        } 
        else 
        {
            return null;
        }

    }
}


if(!function_exists('get_date_from_bill_number'))
{
    function get_date_from_bill_number($bill_number)
    { 
        try 
        {
           // Extract the date part (last 8 characters)
            $dateString = substr($bill_number, -8);

            // Create a Carbon instance from the extracted date
            $date = Carbon::createFromFormat('Ymd', $dateString);

            // Format the date as year/month/day
            $formattedDate = $date->format('Y/m/d');

            return $formattedDate;
            
        }
        catch(Exception $ex)
        {
            dd($ex->getMessage());
        }
    }
}


if(!function_exists('get_arabic_day_from_bill_number'))
{
    function get_arabic_day_from_bill_number($bill_number)
    { 
        try 
        {
            $bill_tracking = BillTracking::where('bill_number',$bill_number)->first();
            // $dateString = substr($bill_number, -8);

            // // Create a Carbon instance from the extracted date
            // $date = Carbon::createFromFormat('Ymd', $dateString);
            $date = Carbon::parse($bill_tracking->bill_date);
            // Set the locale to Arabic
            $date->locale('ar');

            // Get the day of the week in Arabic
            $arabicDay = $date->translatedFormat('l');

            return $arabicDay;
        }
        catch(Exception $ex)
        {
            dd($ex->getMessage());
        }
    }
}


if(!function_exists('is_bill_status_under_review'))
{
    function is_bill_status_under_review($bill_number)
    { 
        try 
        {
            return BillTracking::where('bill_number',$bill_number)->where('bill_status',BillStatus::UNDER_REVIEW)->exists();
        }
        catch(Exception $ex)
        {
            dd($ex->getMessage());
        }
    }
}

if(!function_exists('is_bill_status_payment_made'))
{
    function is_bill_status_payment_made($bill_number)
    { 
        try 
        {
            return BillTracking::where('bill_number',$bill_number)->where('bill_status_id',BillStatus::Payment_Made)->exists();
        }
        catch(Exception $ex)
        {
            dd($ex->getMessage());
        }
    }
}
//get_bill_status_name_by_bill_number
if(!function_exists('get_bill_status_name_by_bill_number'))
{
    function get_bill_status_name_by_bill_number($bill_number)
    { 
        try 
        {
            $bill_status_id =  BillTracking::where('bill_number',$bill_number)->value('bill_status_id');
            if ($bill_status_id == BillStatus::UNDER_REVIEW) {
                return "قيد المراجعة";
            }elseif($bill_status_id == BillStatus::Payment_Made){
                return "تم الدفع";
            }elseif($bill_status_id == BillStatus::CANCELED){
                return "ملغية";
            }
            else{
                return "غير محددة";
            }
        }
        catch(Exception $ex)
        {
            dd($ex->getMessage());
        }
    }
}



// if(!function_exists('get_delivery_price'))
// {
//     function get_delivery_price($bill_id)
//     { 
//         try 
//         {
//             $res_get_delivery_price = (new DeliveryPriceService())->getDeliveryPrice($bill_id);
//             if ($res_get_delivery_price['code'] == 1) 
//             {
//                 $delivery_price = $res_get_delivery_price['data'];
//                 return $delivery_price;
//             }
//             else 
//             {
//                 dd($res_get_delivery_price['msg']);
//             }
//         }
//         catch(Exception $ex)
//         {
//             dd($ex->getMessage());
//         }
//     }
// }





function get_default_lang(){
    return   Config::get('app.locale');
}


function uploadImage($folder, $image)
{
    //$image->store( $folder);
    $filename = $image->hashName();
    $path2 = public_path("images/".$folder);
    $image->move($path2,$filename);
    $path = 'images/' . $folder . '/' . $filename;
    return $path;
}

function sendmessage( $token, $title , $body)
{

    $token = $token;
    $from = "AAAAgBjiSMI:APA91bFvSGmrnykYugq8s4QX7Co49ypJJK1u7_maf-P0gJFl5BUuThFd9ZlIoQ9EH0tZvaYUKVJ5weOAFp5cwMeIenf1MH35jRBzR_nYufOuCFveUUvUHxk57Xoo9chwY2ZmNrsJSZtu";
    $msg = array
            (
            'body'     => $body,
            'title'    => $title,
            'receiver' => 'erw',
            'icon'     => "https://salon-eljoker.com/images/joker.jpg",/*Default Icon*/
            'vibrate'	=> 1,
            'sound'		=> "http://commondatastorage.googleapis.com/codeskulptor-demos/DDR_assets/Kangaroo_MusiQue_-_The_Neverwritten_Role_Playing_Game.mp3",
            );

    $fields = array
            (
                'to'        => $token,
                'notification'  => $msg
            );

    $headers = array
            (
                'Authorization: key=' . $from,
                'Content-Type: application/json'
            );
    //#Send Reponse To FireBase Server
    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
    $result = curl_exec($ch );
    curl_close( $ch );
    return $result;
}


/* 

// Get status message
$statusMessage = getStatusInfo($status_number);

// Get status ID
$statusId = getStatusInfo($status_number, 'id');

*/

function getStatusInfo($status_number, $info='msg')
{
    $statusConfig = config('constants.STATUS_NUMBER');

    switch ($status_number) {
        case $statusConfig['UNDER_REVIEW']:
            return $info === 'msg' ? __('under_review') : 'under_review';
        case $statusConfig['UNDER_DELIVERY']:
            return $info === 'msg' ? __('under_delivery') : 'under_delivery';
        case $statusConfig['DELIVERED']:
            return $info === 'msg' ? __('delivered') : 'delivered';
        case $statusConfig['REJECTED_WITHOUT_PAY']:
            return $info === 'msg' ? __('rejected_without_pay') : 'rejected_without_pay';
        case $statusConfig['REJECTED_WITH_PAY']:
            return $info === 'msg' ? __('rejected_with_pay') : 'rejected_with_pay';
        case $statusConfig['POSTPONED']:
            return $info === 'msg' ? __('postponed') : 'postponed';
        case $statusConfig['NO_RESPONSE']:
            return $info === 'msg' ? __('no_response') : 'no_response';
        // case $statusConfig['RETURNED']:
        //     return $info === 'msg' ? __('returned') : 'returned';
        default:
            return $info === 'msg' ? __('unknown_status') : 'unknown_status';
    }
}

