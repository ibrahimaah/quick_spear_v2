@extends('admin.layouts.app')
@section('title', 'المرتجعات')
@section('content')

 
<div class="row mt-5">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5>
                        <span>المرتجعات</span>
                    </h5>
                    <a href="{{ url()->previous() }}" class="btn btn-danger d-block">رجوع</a>
                </div> 
            </div>
            
            <div class="card-body datatable-container" id="myTabContent">
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

         const waiting_msg = 'جاري المعالجة'
         const err_msg = 'حدث خطأ في المعالجة'

       
  
        
        $('#express-table').on('change', '#return-status-select', function() { 
                var dataTable = $('#express-table').DataTable();
                var columnName = 'id'; // Replace 'columnName' with the actual name of your column
                var columnIndex = dataTable.column(columnName + ':name').index();
                var returnId = $(this).closest('tr').find('td:eq('+columnIndex+')').text().trim();

                var return_status_id = $("option:selected", this).val();
                var return_id = returnId

                if (return_status_id) {
                    var url = "{{ route('admin.update_shipment_return_status', ['status' => 'STATUS_PLACEHOLDER','shipment'=> 'SHIPMENT_PLACEHOLDER']) }}";
                    url = url.replace('STATUS_PLACEHOLDER', return_status_id);
                    url = url.replace('SHIPMENT_PLACEHOLDER', return_id);
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