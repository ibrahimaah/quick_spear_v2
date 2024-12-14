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
	        <div class="row justify-content-between align-items-center">
				<div class="col-sm-4">
					<h5>طلبات الدفع</h5>
				</div>

				{{-- <p class="h5 mb-0 text-secondary">
					<span>عدد الفواتير الغير مدفوعة :</span> 
					<span class="fw-bold">{{ $num_of_unpaid_bills }}</span>
				</p> --}}

				<div class="col-sm-4">
					<div class="card h-100 text-center shadow">
					  <div class="card-body"> 
						<div class="display-4 text-success mb-2">
							<i class="bi bi-file-earmark-text"></i>
						  </div>
						<h2 class="card-title mb-3">{{ $num_of_unpaid_bills }}</h2>
						<p class="card-text text-muted">عدد الفواتير الغير مدفوعة </p>
					  </div>
					</div>
				  </div>

				<div class="col-sm-4 d-flex justify-content-end">
					<a href="{{ url()->previous() }}" class="btn btn-danger d-block w-50">رجوع</a>
				</div>
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