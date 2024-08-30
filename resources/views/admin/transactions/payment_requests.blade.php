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
		                <td>{{ $loop->iteration }}</td>
		                <td>{{ $shop->name }}</td> 
		                <td>
                            @if($shop->bills->isNotEmpty())
                                <a href="{{ route('admin.payments.view_shop_bills',['shop' => $shop->id]) }}" 
                                    class="btn btn-primary">
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