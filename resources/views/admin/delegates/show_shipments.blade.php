@extends('admin.layouts.app')
@section('title', 'شحنات مندوب')
@section('content')

 
<div class="row">
    <div class="col-sm-12">
        <div class="card pt-3">
            <div class="card-header py-0">
                <div class="d-flex justify-content-between">
                    <h5>
                        @if($delegate)
                        <div class="d-flex">
                            <div>
                                <span>الشحنات الخاصة بالمندوب</span><span class="text-success"> {{ $delegate->name }}</span>
                            </div>
                            <div>
                                <span>&nbsp;({{ $numOfShipments }})</span>
                            </div>
                        </div>
                        @else 
                        <span>الشحنات</span>
                        @endif
                    </h5>
                    <a href="{{ url()->previous() }}" class="btn btn-danger d-block">رجوع</a>
                </div>
                @if($delegate)
                    <div class="d-flex gap-2">
                        <div class="mt-4">
                            <form action="{{ route('admin.delegates.delegate_daily_delivery_statement',['delegate' => $delegate->id]) }}" method="POST">
                                @csrf 
                                @method('POST')
                                <button type="submit" id="delivery_1st_btn" class="btn btn-primary"> 
                                    كشف تسليم مندوب
                                </button>
                            </form>     
                        </div>
                        <div class="mt-4">
                            <form action="{{ route('admin.delegates.delegate_final_delivery_statement',['delegate' => $delegate->id]) }}" method="POST">
                                @csrf 
                                @method('POST')
                                <button type="submit" id="delivery_2nd_btn" class="btn btn-primary"> 
                                    كشف تسليم نهائي
                                </button>
                            </form>     
                        </div>  

                        @if($delegate)
                            <div class="text-center">
                                <form action="{{ route('admin.delegates.deport',['delegate' => $delegate->id]) }}" method="post" id="deport-form">
                                    @csrf 
                                    <input class="btn btn-success my-4" id="deported-btn" type="submit" value="ترحيل الكشف">
                                </form>
                            </div>
                        @endif

                    </div> 
                @endif
            </div>
            
         
            
            <div class="card-body datatable-container pt-0" id="myTabContent">
                {{ $dataTable->table() }}
            </div>
           
        </div>
    </div>
</div>

@endsection

@push('scripts')
{{ $dataTable->scripts() }}

<script>
   
    $(document).ready(function()
    {
        
        $('#deport-form').submit(function(event){
            if(!confirm("هل أنت متأكد أنك تريد ترحيل الكشف؟")){
                event.preventDefault();
            }
        });

         const waiting_msg = 'جاري المعالجة'
         const err_msg = 'حدث خطأ في المعالجة'

        const update_1st_btn_state = delegate_id => 
        {
            var url_1 = "{{ route('admin.delegates.get_initial_delivery_1st_btn_state', ['delegate' => 'STATUS_PLACEHOLDER']) }}";
            url_1 = url_1.replace('STATUS_PLACEHOLDER', delegate_id);

            $.ajax({
                url: url_1,
                method: "GET",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                beforeSend: function() { 
                    showOverlayWithMessage(waiting_msg);
                    $('#delivery_1st_btn').prop('disabled', true);
                },
                complete: function() {  
                    hideOverlay();
                    // $('#express-table').prop('disabled', false);
                },
                success: function(response) {
                    if (response.code == 1) {    
                            $('#delivery_1st_btn').prop('disabled', !response.data);
                    } else if (response.code == 0) {
                        console.log(response.msg);
                    }
                },
                error: function() {
                    console.log('An error occurred')
                }
            });
        }

        const update_2nd_btn_state = delegate_id => 
        {
            var url_2 = "{{ route('admin.delegates.get_initial_delivery_2nd_btn_state', ['delegate' => 'STATUS_PLACEHOLDER']) }}";
            url_2 = url_2.replace('STATUS_PLACEHOLDER', delegate_id);

            $.ajax({
                url: url_2,
                method: "GET",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                beforeSend: function() { 
                    showOverlayWithMessage(waiting_msg);
                    $('#delivery_2nd_btn').prop('disabled', true);
                    $('#deported-btn').prop('disabled', true);
                },
                complete: function() {  
                    hideOverlay();
                    // $('#express-table').prop('disabled', false);
                },
                success: function(response) {
                    if (response.code == 1) {    
                            $('#delivery_2nd_btn').prop('disabled', !response.data);
                            $('#deported-btn').prop('disabled', !response.data);
                    } else if (response.code == 0) {
                        console.log(response.msg);
                    }
                },
                error: function() {
                    console.log('An error occurred')
                }
            });
        }

        var delegate_id = {{ $delegate->id }}
        
        update_1st_btn_state(delegate_id)
        update_2nd_btn_state(delegate_id)
        
        $('#express-table').on('change', '.shipment-status-select', function() { 
                var dataTable = $('#express-table').DataTable();
                var columnName = 'id'; // Replace 'columnName' with the actual name of your column
                var columnIndex = dataTable.column(columnName + ':name').index();
                var shipmentId = $(this).closest('tr').find('td:eq('+columnIndex+')').text().trim();

                var shipment_status_id = $("option:selected", this).val();
                var shipment_id = shipmentId

                if (shipment_status_id) {
                    var url = "{{ route('admin.update_shipment_status', ['status' => 'STATUS_PLACEHOLDER','shipment'=> 'SHIPMENT_PLACEHOLDER']) }}";
                    url = url.replace('STATUS_PLACEHOLDER', shipment_status_id);
                    url = url.replace('SHIPMENT_PLACEHOLDER', shipment_id);
                    console.log(url);
                    
                    $.ajax({
                        url: url,
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        beforeSend: function() { 
                            showOverlayWithMessage(waiting_msg);
                            // $('#express-table').prop('disabled', true);
                        },
                        complete: function() {  
                            hideOverlay();
                            // $('#express-table').prop('disabled', false);
                        },
                        success: function(response) {
                            if (response.code == 1) {    
                                update_1st_btn_state(delegate_id)
                                update_2nd_btn_state(delegate_id)
                                dataTable.ajax.reload(null, false); 
                                
                            } else if (response.code == 0) {
                                console.log(response.msg);
                            }
                        },
                        error: function() {
                            console.log('An error occurred')
                        }
                    });
                }
            });
    });
</script>
@endpush