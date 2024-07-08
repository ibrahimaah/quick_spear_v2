

<div class="d-flex justify-content-between gap-1">
    <div>
        <a  onclick="confirm('برجاء تأكيد العملية') ? document.getElementById('cancel{{ $query->id }}').submit() : '';"
            class="btn btn-sm btn-secondary">إلغاء</a>

        <form action="{{ route('admin.shipments.cancel_assign_delegate', $query->id) }}" 
              id="cancel{{ $query->id }}"
              method="POST">
            @csrf
            @method('POST')
        </form>
    </div>

    


    <div>
        <a href="{{ route('admin.shipments.edit',['shipment'=>$query->id])}}" class="btn btn-sm btn-warning">
            <i class="bi bi-pencil"></i>
        </a>
    </div>


    <div>
        <a href="{{ route('admin.shipments.show',['shipment'=>$query->id])}}" class="btn btn-sm btn-primary">
            <i class="bi bi-eye"></i>
        </a>
    </div>

    <div>
        <select class="form-select form-select-lg shipment-status-select">
            <option>اختر حالة الشحنة</option>
            @foreach ($shipment_statuses as $shipment_status)
            <option value="{{ $shipment_status->id }}">{{ __($shipment_status->name) }}</option> 
            @endforeach
          </select>
    </div>



    {{-- <div>
        <a onclick="confirm('برجاء تأكيد العملية') ? document.getElementById('delete_shipment{{ $query->id }}').submit() : '';"
            class="btn btn-sm btn-danger"> <i class="bi bi-trash"></i></a>

        <form action="{{ route('admin.shipments.destroy',['shipment'=>$query->id])}}"
            id="delete_shipment{{ $query->id }}" method="post">
            @csrf
            @method('DELETE')
        </form>
    </div> --}}

</div>

 

