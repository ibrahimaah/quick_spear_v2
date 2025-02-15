@extends('admin.layouts.app')
@section('title', 'المندوبين')
@section('content')


@php 
 use App\Models\Statement;
@endphp 
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex justify-content-between">
					<h5>المندوبين</h5>
					<a href="{{ url()->previous() }}" class="btn btn-danger d-block">رجوع</a>
				</div>
			</div>
			
			

			<div class="card-body">
				<div class="table-responsive">
					<table class="display" id="basic-1">
						<thead>
							<tr>
								<th>#</th>
								<th>الاسم</th>
								<th>رقم الهاتف</th>
								{{-- <th>المدينة</th> --}}
								<th>العمليات</th>
							</tr>
						</thead>
						<tbody>
							@foreach($delegates as $delegate)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $delegate->name }}</td>
								<td>{{ $delegate->phone }}</td>
								<td>
									<a class="btn btn-primary"
										href="{{ route('admin.delegates.edit', $delegate->id) }}"><i
											class="fa fa-edit"></i></a>
 
									
									<a class="btn btn-danger" href="javascript:void(0)"  onclick="return confirm('Are you sure of deleting this delegate ?') ? document.getElementById('delete-delegate-{{ $delegate->id }}').submit() : '';"><i class="fa fa-trash"></i></a>
									<form action="{{ route('admin.delegates.destroy', $delegate->id) }}" method="post" class="d-none"
										id="delete-delegate-{{ $delegate->id }}">
										@csrf
										@method('delete')
									</form> 

									@if ($delegate->shipments->where('is_deported',false)->isNotEmpty())
									<a class="btn btn-primary"
										href="{{ route('admin.delegates.get_shipments', ['delegate'=>$delegate->id]) }}">
										عرض الشحنات
									</a>
									@endif

									@if (Statement::where('delegate_id', $delegate->id)->exists())
									<a class="btn btn-secondary"
									   href="{{ route('admin.delegates.get_statements', ['delegate'=>$delegate->id]) }}">
										 الكشوفات
									</a>
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection