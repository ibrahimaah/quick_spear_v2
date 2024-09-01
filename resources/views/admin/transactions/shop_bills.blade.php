@extends('admin.layouts.app')

@section('title', 'عرض كل طلبات الدفع')

@section('content')

<div class="row">
	<div class="col-sm-12">
	    <div class="card">
	      <div class="card-header">
	        <div class="d-flex justify-content-between">
				<h5>طلبات الدفع</h5>
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
	                <th>تاريخ الفاتورة</th>
	              </tr>
	            </thead>
	              <tbody>
	              	@foreach($shop_bills as $billNumber => $bills)
						<tr>
							<td>{{ $loop->iteration++ }}</td>
							<td>{{ $billNumber }}</td> 
							<td> 
								{{ get_bill_date_from_bill_number($billNumber) }}
							</td> 
						</tr>
		            @endforeach
	          	  </tbody>
	          </table>
	        </div>
	      </div>
          @else  
            <div class="alert alert-warning">لا يوجد فواتير لهذا المتجر</div>
          @endif
	    </div>
	</div>
</div>
@endsection