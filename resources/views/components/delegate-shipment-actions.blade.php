

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
        <a href="{{ route('admin.shipments.edit',['shipment'=>$query->id])}}" class="btn btn-sm btn-warning" target="_blank">
            <i class="bi bi-pencil"></i>
        </a>
    </div>


    <div>
        <a href="{{ route('admin.shipments.show',['shipment'=>$query->id])}}" class="btn btn-sm btn-primary" target="_blank">
            <i class="bi bi-eye"></i>
        </a>
    </div>

    @php
        $completedStatusId = App\Models\ShipmentStatus::DELIVERED;
    @endphp

    <div>
        <select class="form-select form-select-lg shipment-status-select">
            <option>اختر حالة الشحنة</option>
            <option value="{{ $completedStatusId }}">{{ __(App\Models\ShipmentStatus::find($completedStatusId)->name) }}</option>
            @foreach ($shipment_statuses as $shipment_status)
                @continue($shipment_status->id == $completedStatusId || $shipment_status->id == App\Models\ShipmentStatus::UNDER_REVIEW)
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

 

