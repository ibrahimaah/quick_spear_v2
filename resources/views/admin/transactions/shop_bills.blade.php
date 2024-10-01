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
		 {{-- @php dd($shop_bills); @endphp  --}}
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
	              	@foreach($shop_bills as $shop_bill)
					
					  	 

						<tr>
							<td>{{ ++$loop->iteration }}</td>
							<td>{{ $shop_bill->bill_number }}</td>  
							<td> {{ Carbon::parse($shop_bill->bill_date)->format('Y-m-d') }}</td> 
							<td>{{ __($shop_bill->billStatus->name) }}</td>
							<td>
								 
								<div class="d-flex gap-3">
									<a href="{{ route('admin.prepare_bill',['bill_number' => $shop_bill->bill_number]) }}"
										class="btn btn-primary btn-sm d-block"
										target="_blank">عرض الفاتورة</a>
									
									@if(!is_bill_status_payment_made($shop_bill->bill_number))
									<div>
										<form action="{{ route('admin.pay_bill') }}" method="POST">
											@csrf 
											<input type="hidden" name="bill_number" value="{{ $shop_bill->bill_number }}" required />
											<input type="submit" class="btn btn-success btn-sm" value="تحديد الحالة كمدفوعة"/>
										</form>
									</div>
									@else
									<a onclick="confirm('برجاء تأكيد العملية') ? document.getElementById('delete_bill{{ $shop_bill->bill_number }}').submit() : '';" class="btn btn-sm btn-danger"> <i class="bi bi-trash"></i></a>

									<form action="{{ route('admin.bills.destroy',['bill_number'=>$shop_bill->bill_number])}}" id="delete_bill{{ $shop_bill->bill_number }}" method="post">
										@csrf 
									</form>
									@endif
								</div> 
								
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