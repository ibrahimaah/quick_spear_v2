@extends('admin.layouts.app')

@section('title', 'عرض كل طلبات الدفع')

@section('content')
@php 
	use App\Models\BillStatus;
@endphp 
<div class="row">
	<div class="col-sm-12">
	    <div class="card">
	      <div class="card-header">
	        <div class="d-flex justify-content-between">
				<h5>طلبات الدفع</h5>
				<h5 class="mb-0 text-secondary">
					<span>المجموع :</span> 
					<span class="fw-bold">{{ $total_due_to_customer_amount }}</span>
				</h5>
				<a href="{{ url()->previous() }}" class="btn btn-danger d-block">رجوع</a>
			</div>
	      </div>

          @if($shops->isNotEmpty())
	      <div class="card-body">
	        <div class="table-responsive">
	          <table class="display" id="basic-1">
	            <thead>
	              <tr>
	                <th>#</th>
	                <th>اسم المتجر</th>
	                <th>العمليات</th>
	              </tr>
	            </thead>
	              <tbody>
	              	@foreach($shops as $shop)
						<tr>
							<td>{{ $loop->iteration++ }}</td>
							<td>{{ $shop->name }}</td> 
							<td>
								@if($shop->billsTracking->where('bill_status_id' , BillStatus::UNDER_REVIEW)->isNotEmpty())
									<a href="{{ route('admin.payments.view_shop_bills',['shop' => $shop->id,'bill_status_id' => BillStatus::UNDER_REVIEW]) }}" 
										class="btn btn-primary" target="_blank">
										عرض الفواتير
									</a>
								@else 
									لا يوجد فواتير
								@endif 
							</td> 
						</tr>
		            @endforeach
	          	  </tbody>
	          </table>
	        </div>
	      </div>
          @else  
            <div class="alert alert-warning">لا يوجد متاجر</div>
          @endif
	    </div>
	</div>
</div>
@endsection