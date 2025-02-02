@if($query->is_under_review())

    <div class="d-flex gap-2">
        <a onclick="confirm('برجاء تأكيد العملية') ? document.getElementById('accept_shipment{{ $query->id }}').submit() : '';" class="btn btn-sm btn-primary">تم المراجعة</a>

        <form action="{{ route('admin.shipments.accept_shipment',['shipment'=>$query->id])}}" id="accept_shipment{{ $query->id }}" method="post">
            @csrf 
        </form>

        <a onclick="confirm('برجاء تأكيد العملية') ? document.getElementById('delete_shipment{{ $query->id }}').submit() : '';" class="btn btn-sm btn-danger">رفض</a>

        <form action="{{ route('admin.shipments.destroy',['shipment'=>$query->id])}}" id="delete_shipment{{ $query->id }}" method="post">
            @csrf
            @method('DELETE')
        </form>
    </div>
    

@else 
    <div>
        <a href="{{ route('admin.shipments.edit',['shipment'=>$query->id])}}" 
        class="btn btn-sm btn-warning" target="_blank">
        <span>تعديل</span><i class="bi bi-pencil"></i> 
        </a>

        
        <a href="{{ route('admin.shipments.show',['shipment'=>$query->id])}}" 
        class="btn btn-sm btn-primary" target="_blank">
        <span>معلومات</span> <i class="bi bi-eye"></i> 
        </a>
        

        
        <a onclick="confirm('برجاء تأكيد العملية') ? document.getElementById('delete_shipment{{ $query->id }}').submit() : '';" class="btn btn-sm btn-danger"> <i class="bi bi-trash"></i></a>

        <form action="{{ route('admin.shipments.destroy',['shipment'=>$query->id])}}" id="delete_shipment{{ $query->id }}" method="post">
            @csrf
            @method('DELETE')
        </form>
        
    </div>
@endif