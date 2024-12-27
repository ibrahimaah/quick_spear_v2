<!DOCTYPE html>
<html lang="ar" dir="rtl">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>كشف مرتجعات بتاريخ {{ \Carbon\Carbon::now()->format('d/m/Y') }}</title>


		<!-- Favicon -->
		<link rel="icon" href="./images/favicon.png" type="image/x-icon" />

		<!-- Invoice styling -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
        <style>
            
            * { font-family: DejaVu Sans, sans-serif; }
            body {
                direction: rtl; /* Right-to-left direction */
                text-align: right; /* Text alignment */
            }
            .title{
                text-align: center !important;
                /* display: inline-block; */
            }
            td, th {
                border: 1px solid #dddddd;
                text-align: right;
                padding: 8px;
            }
            #invoice-table {
                width: 100%;
                border-collapse: collapse;
            }
            .text-center{
                text-align: center !important;  
            }
            .text-right{
                text-align: right !important;  
            }
            .text-left{
                text-align: left !important;  
            }
       
            td
            {
                text-align: center !important
            }
            
            .header-table{
                width:100%;
                border: none !important;
                margin-bottom: 30px !important;
            }
            .header-table td {
                border: none !important
            }
            .footer-table{
                margin-top:30px !important;
                width:100%;
                border: none !important; 
            }
            .footer-table td {
                border: none !important
            }
            .mr-50{
                margin-right:  50px !important
            }
        </style> 
	</head>

	<body> 
		<table class="header-table">
            <tr>
                <td class="text-center">
                    <div>
                        <h3 class="title">(الرمح السريع)</h3>
                    </div>
                </td>
                <td>
                    <div>
                        <h3 class="title">كشف مرتجعات</h3> 
                        <h3 class="title">بتاريخ {{ \Carbon\Carbon::now()->format('d/m/Y') }}</h3> 
                    </div>
                </td>
                <td class="text-center">
                    <div>
                        <h3 class="title">Quick spear for</h3>
                        <h3 class="title">delivery services</h3>
                    </div>
                </td>
            </tr>
        </table>
		<div class="invoice-box">
			<table id="invoice-table"> 
             
                <tr>
                    <th>رقم الطلب</th>
                    <th>المتجر</th>
                    <th>المدينة</th>
                    <th>المنطقة</th>
                    <th>رقم الهاتف</th>
                    <th>سعر الطلب</th>
                    <th>القيمة عند التسليم</th>
                    <th>اسم المندوب</th>
                    <th>حالة الطلب</th> 
                    <th>تاريخ إنشاء الشحنة</th>
                    <th>ملاحظات جانبية</th>
                </tr>
                @if($shipments->isNotEmpty())
                @foreach ($shipments as $shipment)
                    <tr> 
                        <td>{{ $shipment->id }}</td>
                        <td>{{ $shipment->shop->name }}</td> 
                        <td>{{ $shipment->city_to->name }}</td>
                        <td>{{ $shipment->region->name }}</td>
                        <td>
                            {{ $shipment->consignee_phone }}
                            <br>
                            {{ $shipment->consignee_phone_2 ? ', '.$shipment->consignee_phone_2 : '' }}
                        </td>
                        
                        <td>
                            {{ $shipment->order_price }} {!! $shipment->is_returned ? '<br> (مرتجع)' : '' !!} 
                        </td>  
                        <td>
                            {{ $shipment->value_on_delivery }}
                        </td> 
                        <td>
                            {{ $shipment->delegate->name }}
                        </td>
                        <td>
                            {{ __($shipment->status->name) }}
                        </td>
                        <td>
                            {{ $shipment->created_at->format('Y-m-d h:i A') }}
                        </td>
                        <td class="text-right">
                             {{ $shipment->notes }} 
                        </td>
                        
                    </tr>
                @endforeach 
                @else   
                    <div class="alert alert-warning text-center">There is no shipments</div>
                @endif
              </table>
 
          
              
		</div>
	</body>
</html>