@extends('admin.layouts.app')
@section('title', 'الكشوفات')
@section('content')

 
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5>
                    
                        <span>الكشوفات الخاصة بالمندوب</span><span class="text-success"> {{ $delegate->name }}</span>
                     
                    </h5>
					<div class="d-flex justify-content-between gap-1">

						<div>
							<a class="btn btn-danger btn-sm" 
								href="javascript:void(0)" 
								onclick="confirm('هل أنت متأكد من عملية الحذف؟') ? document.getElementById('del{{ $delegate->id }}').submit() : '' ;">
								<i class="fa fa-trash"></i>
								حذف جميع الكشوفات
							</a>
							<form action="{{ route('admin.delegate.statements.destroy', ['delegate' => $delegate->id]) }}" 
									method="post" 
									id="del{{ $delegate->id }}" 
									style="display: none;">
								@csrf 
							</form>
						</div>
						
                    	<div>
							<a href="{{ url()->previous() }}" class="btn btn-danger btn-sm d-block">رجوع</a>
						</div>
					
						
					</div>
                </div>
			</div>
			
			

			<div class="card-body">
				<div class="table-responsive">
					<table class="display" id="basic-1">
						<thead>
							<tr>
								<th>#</th>
								<th>تاريخ الكشف</th>
								<th>العمليات</th> 
							</tr>
						</thead>
						<tbody>
							@foreach($statements as $statement)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $statement->created_at->format('Y-m-d') }}</td>
                                        <td>
											<a class="btn btn-sm btn-success" href="{{ asset('storage/' . $statement->pdf_path) }}"><i class="fa fa-eye"></i></a>
											<a class="btn btn-danger btn-sm" 
											   href="javascript:void(0)" 
											   onclick="confirm('هل أنت متأكد من عملية الحذف؟') ? document.getElementById('del{{ $statement->id }}').submit() : '' ;">
											   <i class="fa fa-trash"></i>
											</a>
											<form action="{{ route('admin.statements.destroy', ['statement' => $statement->id]) }}" 
												  method="post" 
												  id="del{{ $statement->id }}" 
												  style="display: none;">
												@csrf 
											</form>
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