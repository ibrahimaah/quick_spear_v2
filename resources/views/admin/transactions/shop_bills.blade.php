@extends('admin.layouts.app')

@section('title', 'عرض كل طلبات الدفع')

@section('content')

@php 
	use Carbon\Carbon;
@endphp 
<div class="row">
	<div class="col-sm-12">
	    <div class="card">
	      <div class="card-header">
	        <div class="d-flex justify-content-between">
				<h5>طلبات الدفع للمتجر <a href="{{ route('admin.users.show',['user' => $shop->user->id]) }}" class="text-success" target="_blank">{{ $shop->name }}</a></h5>
				<a href="{{ url()->previous() }}" class="btn btn-danger d-block">رجوع</a>
			</div>
	      </div>

		  @if($shop_bills->isNotEmpty())
	      <div class="card-body">
	        <div class="table-responsive">
	          <table class="display" id="basic-1">
	            <thead>
	              <tr>
	                <th>#</th>
	                <th>رقم الفاتورة</th>
	                {{-- <th>قيمة الفاتورة</th> --}}
	                <th>تاريخ الفاتورة</th>
	                <th>حالة الفاتورة</th>
	                <th>العميات</th>
	              </tr>
	            </thead>
	              <tbody>
	              	@foreach($shop_bills as $billNumber => $bills)
					
					  	@php 
							$bill_date = Carbon::parse(get_bill_date_from_bill_number($billNumber));
								// Get the current date
							$currentDate = Carbon::now()->startOfDay(); // Use startOfDay to ignore time
						@endphp 

						<tr  class="<?=is_bill_status_payment_made($billNumber) ? 'bg-success' : ''?>">
							<td>{{ $loop->iteration++ }}</td>
							<td>{{ $billNumber }}</td> 
							{{-- <td>
								@php 
									$total_bill_value = 0;
									foreach($bills as $bill):
										$total_bill_value+=$bill->value_on_delivery;
									endforeach
								  
								@endphp 
								{{  $total_bill_value  }}
							</td> --}}
							<td> 
								{{ get_bill_date_from_bill_number($billNumber) }}
							</td> 
							<td>
								@if($currentDate->equalTo($bill_date->startOfDay()))
									{{ "قيد التجهيز" }}
								@else 
									{{ get_bill_status_name_by_bill_number($billNumber) }}
								@endif 
								
							</td>
							<td>
								
								@if(!$currentDate->equalTo($bill_date->startOfDay()))
									<div class="d-flex gap-3">
										<a href="{{ route('admin.prepare_bill',['bill_number' => $billNumber]) }}"
											class="btn btn-primary btn-sm d-block"
											target="_blank">عرض الفاتورة</a>
										
										@if(!is_bill_status_payment_made($billNumber))
										<div>
											<form action="{{ route('admin.pay_bill') }}" method="POST">
												@csrf 
												<input type="hidden" name="bill_number" value="{{ $billNumber }}" required />
												<input type="submit" class="btn btn-success btn-sm" value="تحديد الحالة كمدفوعة"/>
											</form>
										</div>
										@endif
									</div>
								@endif
								
							</td>
						</tr>
		            @endforeach
	          	  </tbody>
	          </table>
	        </div>
	      </div>
          @else  
            <div class="alert alert-warning text-center fw-bold text-secondary">لا يوجد فواتير لهذا المتجر</div>
          @endif
	    </div>
	</div>
</div>
@endsection