<div class="d-flex justify-content-between gap-1">
    <div>
        <a href="{{ route('admin.shipments.show',['shipment'=>$query->id])}}" class="btn btn-sm btn-primary" target="_blank">
            <i class="bi bi-eye"></i>
        </a>
    </div>

    <div>
        <a  onclick="confirm('برجاء تأكيد العملية') ? document.getElementById('delete{{ $query->id }}').submit() : '';"
            class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>

        <form action="{{ route('admin.delete_return',['shipment' => $query->id]) }}" 
              id="delete{{ $query->id }}"
              method="POST">
            @csrf
            @method('POST')
        </form>
    </div>

    @php
        $deletedStatusId = App\Models\ReturnStatus::DELETED;
    @endphp

    <div>
        <select class="form-select form-select-lg" id="return-status-select">
                <option value="" disabled selected>اختر حالة المرتجع</option> 
            @foreach ($return_statuses as $return_status)
                @continue($return_status->id == $deletedStatusId)
                <option value="{{ $return_status->id }}">{{ __($return_status->name) }}</option> 
            @endforeach
        </select>
    </div> 

</div>

 

