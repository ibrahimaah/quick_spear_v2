<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
  <title>الفاتورة الخاصة بالشحنة #{{ $shipment->id }}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    @media print {
        button {
            display: none; /* Hide the button during print */
        }  
    }

  </style>
</head>
<body>
 
<div class="container w-50 mt-5 border border-3 border-dark">
  <div class="row p-4"> 
    <div class="col-sm-6 border-start border-3 border-dark">
        <div class="row align-items-center">
            <div class="col-sm-6 fw-bold">
                التاريخ :
            </div>
            <div class="col-sm-6">
                {{ $shipment->created_at->format('Y-m-d') }}
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-sm-6 fw-bold">
                اسم المرسل :
            </div>
            <div class="col-sm-6">
                {{ $shipment->shop->name }}
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-sm-6 fw-bold">
                قيمة الطرد
            </div>
            <div class="col-sm-6">
                {{ $shipment->value_on_delivery }}
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-sm-6 fw-bold">
                ملاحظات :
            </div>
            <div class="col-sm-6">
                @php 
                    
                    if ($shipment->customer_notes && $shipment->delegate_notes) 
                    {
                        echo '<li>'.$shipment->customer_notes .'</li><li>'.$shipment->delegate_notes.'</li>';
                    }
                    elseif ($shipment->customer_notes && !$shipment->delegate_notes) 
                    {
                        echo $shipment->customer_notes;
                    }
                    elseif (!$shipment->customer_notes && $shipment->delegate_notes) 
                    {
                        echo $shipment->delegate_notes;
                    }
                    else 
                    {
                        echo 'لا يوجد';
                    }
                @endphp 
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="row align-items-center">
            <div class="col-sm-6 fw-bold">
                اسم المرسل إليه :
            </div>
            <div class="col-sm-6">
                {{ $shipment->consignee_name }}
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-sm-6 fw-bold">
               عنوان المرسل إليه :
            </div>
            <div class="col-sm-6">
                {{ $shipment->city->name }}
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-sm-6 fw-bold">
                المنطقة :
            </div>
            <div class="col-sm-6">
                {{ $shipment->region->name }}
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-sm-6 fw-bold">
                رقم الهاتف :
            </div>
            <div class="col-sm-6">
                 {{ $shipment->consignee_phone }}
            </div>
        </div>
        @if($shipment->consignee_phone_2)
        <div class="row align-items-center">
            <div class="col-sm-6 fw-bold">
                رقم الهاتف البديل :
            </div>
            <div class="col-sm-6">
                 {{ $shipment->consignee_phone_2 }}
            </div>
        </div>
        @endif 
    </div>
  </div>
  <div class="row pb-2">
    <div class="col-sm-6 text-center">
        <small>
            أتعهد أنا المرسل أنني مسؤول مسؤولية تامة عن محتويات الطلب المرسل مع <small>
                Quick Spear For Delivery Services
            </small>
        </small>
    </div>
    <div class="col-sm-6 text-center">
        <small>
            للاستفسار أو الشكاوي تخص التوصيل
        </small>
        <small>
            0798711008
        </small>
    </div>
  </div>
</div>


<!-- Print Button -->
<div class="text-center mt-4">
    <button class="btn btn-primary" onclick="printPage()">طباعة</button>
</div>

<!-- Move script tag to the bottom -->
<script>
  function printPage() {
    window.print();
  }
</script>

</body>
</html>