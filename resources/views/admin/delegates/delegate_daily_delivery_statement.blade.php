<!DOCTYPE html>
<html lang="ar" dir="rtl">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>كشف استلام الطلبات</title>

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
                        <h3 class="title">كشف تسليم</h3>
                        <h3 class="title">يومي</h3>
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
                  <th colspan="2" class="text-center">{{ $currentDayInArabic }}</th>
                  <th colspan="3" class="text-center">{{ $delegate_name }}</th>
                  <th colspan="3" class="text-center">{{ $currentDateInArabic }}</th> 
                </tr>
             
                <tr>
                    <th>الرقم</th>
                    <th>المدينة</th>
                    <th>المنطقة</th>
                    <th>المتجر</th>
                    <th>التحصيل</th>
                    <th>حالة الطلب</th>
                    <th>هاتف الزبون</th>
                    <th>ملاحظات جانبية</th>
                </tr>
                @if($shipments->isNotEmpty())
                @foreach ($shipments as $shipment)
                    <tr> 
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $shipment->city_to->name }}</td>
                        <td>{{ $shipment->region->name }}</td>
                        <td>{{ $shipment->shop->name }}</td> 
                        <td>
                            {{ $shipment->order_price }} {!! $shipment->is_returned ? '<br> (مرتجع)' : '' !!} 
                        </td>  
                        <td></td>
                        <td>
                            {{ $shipment->consignee_phone }}
                            <br>
                            {{ $shipment->consignee_phone_2 ? ', '.$shipment->consignee_phone_2 : '' }}
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

              <h4 class="mr-50">المجموع الكلي :</h4>
              <h4 class="mr-50"> العمولة :</h4>
              <h4 class="mr-50">المجموع النهائي :</h4>
          
              
		</div>
	</body>
</html>