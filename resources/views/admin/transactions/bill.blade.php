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
       

        

        </style> 
	</head>

	<body>

        @php 
            use App\Models\ShipmentStatus;
            $not_important_statuses = [ShipmentStatus::POSTPONED,
                                       ShipmentStatus::CANCELED,
                                       ShipmentStatus::UNDER_DELIVERY,
                                       ShipmentStatus::UNDER_REVIEW];
        @endphp 

		<h3 class="title"> فاتورة رقم <span>{{ $bill_number }}</span> </h3>
		
		
		<div class="invoice-box">
			<table id="invoice-table">
                <tr> 
                  <th colspan="4"><span>اسم الصفحة/المتجر : </span><span id="shop_name">
                    {{ $shop->name }}
                 </span></th>
                  <th colspan="3">اليوم :
                    <span>{{ $bill_date_day }}</span>
                  </th>
                </tr>
                <tr>
                    <th colspan="4">اسم العميل :
                        <span>{{ $client_name }}</span>
                    </th>
                    <th colspan="3">التاريخ :
                        <span>{{ $bill_date }}</span>
                    </th>
                </tr>
                <tr>
                    <th>الرقم</th>
                    <th>العنوان</th>
                    <th>رقم الزبون</th>
                    <th>السعر</th>
                    <th>خصم التوصيل</th>
                    <th>حالة الشحنة</th>
                    <th>الملاحظات</th>
                </tr>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->city->name }}</td>
                        <td>{{ $order->consignee_phone }}</td> 
                        <td>{{ $order->value_on_delivery }}</td> 
                        <td>{{ !in_array($order->shipment_status_id,$not_important_statuses) ? $order->customer_delivery_price : '0.00' }}</td> 
                        <td>{{ __($order->status->name) }}</td> 
                        <td>{{ $order->delegate_notes }}</td> 
                    </tr>
                @endforeach
              
                <tr>
                    <th colspan="4">المجموع الكلي : <span>{{ $total_value_on_delivery }}</span>
                    </th>
                </tr>
                <tr>
                    <th colspan="4">مجموع أجور التوصيل : <span>{{ $total_customer_delivery_price }}</span>
                    </th> 
                </tr>
                <tr>
                    <th colspan="4">له : <span>{{ $total_due_to_customer_amount }}</span>
                    </th>
                </tr>
                <tr>
                    <th colspan="4">عليه : <span>{{ $total_due_from_customer_amount }}</span>
                    </th> 
                </tr>
              </table>
              
		</div>
	</body>
</html>