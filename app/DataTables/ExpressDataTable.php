<?php

namespace App\DataTables;

use App\Models\City;
use App\Models\ReturnStatus;
use App\Models\Shipment;
use App\Models\ShipmentRate;
use App\Models\ShipmentStatus;
use App\Traits\DatatableTrait; 
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Livewire\Livewire;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExpressDataTable extends DataTable
{
    use DatatableTrait; 

    
    // public $filterData;
    private $is_from_admin;
    // private $user_id;
    private $shop_id;
    private $delegate_id;
    private $is_return;
    //$user_id , to show shipments for each user in dashboard
    //$delegate_id to show delegate shipments
    // public function __construct($filterData,$is_from_admin=false,$user_id=null,$delegate_id=null)
    public function __construct($is_from_admin=false,$shop_id=null,$delegate_id=null,$is_return = false)
    {
        // $this->filterData = $filterData;
        $this->is_from_admin = $is_from_admin;
        $this->shop_id = $shop_id;
        $this->delegate_id = $delegate_id;
        $this->is_return = $is_return;
    }


    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addIndexColumn()
        ->editColumn('checkbox', function ($query) {
            return '<input type="checkbox" class="chk_shipment" value="'.$query->id.'">';
        })
        ->editColumn('created_at', function ($query) {
            return $query->created_at->format('Y-m-d h:i A');
        })
        ->editColumn('consignee_city', function ($query) {
            return $query->city?->name ?? 'غير محدد';
        }) 
        ->editColumn('consignee_region', function ($query) {
            return $query->region?->name ?? 'غير محدد';
        })
        ->editColumn('shop_name', function ($query) {
            return $query->shop?->name ?? 'غير محدد';
        })
        ->editColumn('value_on_delivery', function($query) {
            // return '<input type="checkbox" ' . $this->html->attributes($query->id) . '/>';
            if(!$query->value_on_delivery)
            {
                return __('not_determined_yet');
            }
            else{
                return $query->value_on_delivery;
            }
        })
        ->editColumn('delegate_notes', function($query) {
            // return '<input type="checkbox" ' . $this->html->attributes($query->id) . '/>';
            if(!$query->delegate_notes)
            {
                // return __('There is no notes');
                return '';
            }else{
                return $query->delegate_notes;
            }
        })
        ->editColumn('customer_notes', function($query) {
            if(!$query->customer_notes)
            {
                // return __('There is no notes');
                return '';
            }else{
                return $query->customer_notes;
            }
        })
        ->editColumn('accepted_by_admin_at', function ($query) {
            if(!$query->accepted_by_admin_at){
                return __('not_determined_yet');
            }
            return $query->created_at->format('Y-m-d h:i A');
        })
        ->editColumn('order_price', function ($query) {
            if($query->is_returned){
                return $query->order_price . '(مرتجع)';
            }else 
            {
                return $query->order_price;
            }
        })
        ->addColumn('checkbox', function($query) { 
            return '<input type="checkbox" class="sub_chk" data-id="'. $query->id .'">';
        }) 
        ->addColumn('delegate_name', function($query) { 
            // return $query->delegate->name;
            return $query->delegate?->name;
        }) 
        ->editColumn('shipment_status_id', function ($query) 
        {
            return __($query->status->name);
        })
        ->editColumn('notes', function ($query) 
        {
            if ($query->customer_notes && $query->delegate_notes) 
            {
                return '<li>'.$query->customer_notes .'</li><br><li>'.$query->delegate_notes.'</li>';
            }
            elseif ($query->customer_notes && !$query->delegate_notes) 
            {
                return $query->customer_notes;
            }
            elseif (!$query->customer_notes && $query->delegate_notes) 
            {
                return $query->delegate_notes;
            }
            else 
            {
                // return 'لا يوجد';
                return '';
            }
        })
        ->addColumn('return_status', function ($query) 
        {
            return __(ReturnStatus::findOrFail($query->return_status_id)?->name);
        })
        ->addColumn('user_actions', function ($query) 
        {
            return view('components.user-actions',['query'=>$query]);
        })
        // ->addColumn('delegate_actions', function ($query) 
        // {
        //     return ' <a onclick="confirm(\'برجاء تأكيد العملية\') ? document.getElementById(\'cancel'. $query->id .'\').submit() : \'\';" class="btn btn-sm btn-secondary"> إلغاء</a>

        //     <form action="'. route('admin.shipments.cancel_assign_delegate', $query->id) .'" id="cancel'. $query->id .'" method="post">
        //     '. csrf_field() .'
        //     '. method_field("POST") .'
        //     </form>';
        // })

        ->addColumn('admin_actions', function ($query) 
        {
            return view('components.shipments-admin-actions',['query'=>$query]);;
        })
        ->addColumn('delegate_shipment_actions', function ($query) 
        { 
            return view('components.delegate-shipment-actions',['query'=>$query,'shipment_statuses' => ShipmentStatus::all()]);;
        })
        ->addColumn('return_shipment_actions', function ($query) 
        { 
            return view('components.return-shipment-actions',['query'=>$query,'return_statuses' => ReturnStatus::all()]);;
        })
        ->rawColumns(['actions',
                      'admin_actions',
                      'shipment_status_id',
                      'checkbox',
                      'notes',
                      'delegate_shipment_actions',
                      'return_shipment_actions'])
        ->setRowId('id')
        ->setRowClass(function ($query) 
        {
            if ((!$this->is_from_admin) && ($this->shop_id) && (!$this->delegate_id) && (!$this->is_return)) 
            {
                 // Example: Change row background color based on some condition
                if ($query->shipment_status_id == ShipmentStatus::UNDER_REVIEW) 
                {
                    return 'bg-under-review'; // Background color for status 1 (use Bootstrap classes or custom CSS)
                }
                elseif ($query->shipment_status_id == ShipmentStatus::DELIVERED)
                {
                    return 'bg-success'; // Background color for returned shipments
                }
                elseif (in_array($query->shipment_status_id, [ShipmentStatus::NO_RESPONSE,
                                                              ShipmentStatus::CANCELED,
                                                              ShipmentStatus::REJECTED_WITH_PAY,
                                                              ShipmentStatus::REJECTED_WITHOUT_PAY]))
                {
                    return 'bg-danger'; // Background color for returned shipments
                }
                elseif ($query->shipment_status_id == ShipmentStatus::POSTPONED)
                {
                    return 'bg-postpone'; // Background color for returned shipments
                }
                elseif ($query->shipment_status_id == ShipmentStatus::UNDER_REVIEW)
                {
                    return 'bg-danger'; // Background color for returned shipments
                }
                // elseif ($query->notes !== '')
                // {
                //     return 'bg-notes'; // Background color for returned shipments
                // }
                else 
                {
                    return '';
                }
            }
           
            return ''; // Default row
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Express $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Shipment $model): QueryBuilder
    {
        if($this->is_from_admin)
        {
            return $model->newQuery()->orderBy('shop_id','DESC')->where('is_deported',false)->latest();
        }

        if ($this->delegate_id) 
        {
            return $model->newQuery()->where('delegate_id',$this->delegate_id)->where('is_deported',false)->orderBy('id','DESC');
        }

        if ($this->is_return) 
        {
            return $model->newQuery()
                         ->where(function ($query) {
                            $query->whereIn('shipment_status_id', config('constants.RETURNED_STATUSES'))
                                  ->orWhere('is_returned', true);
                            })
                         ->where('is_deported',true)
                         ->where('return_status_id','<>',ReturnStatus::DELETED)
                         ->orderBy('id','DESC');
        }
 
        return $model->newQuery()->where('shop_id',$this->shop_id)->orderBy('id','DESC');

      
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('express-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->autoWidth(false)
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ])
                    
                    ;
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        if($this->is_from_admin)
        {
            $columns = [
                // $this->column('checkbox','<input type="checkbox" id="master">',false,false,false,false,'checkbox'),
                $this->column('checkbox', false, false, false, false),
                $this->column('id',__('order_number'),false,true,false,false),
                $this->column('shop_name',__('shop_name'),false,false,false,false),  
                $this->column('consignee_city',__('City'),false,false,false,false), 
                $this->column('consignee_region',__('consignee_region'),false,false,false,false),
                $this->column('consignee_phone', __('Phone'),false,true,false,false), 
                $this->column('order_price', __('Order price'),false,false,false,false),
                $this->column('value_on_delivery', __('Value on delivery'),false,false,false,false),
                $this->column('shipment_status_id', __('Action Status'),false,true,false,false),
                
                $this->column('customer_notes',__('Customer notes'),false,false,false,false),
                $this->column('delegate_notes', __('Delegate notes')),
                $this->column('created_at',__('Created.'),false,false,false,false),
                $this->column('accepted_by_admin_at',__('accepted_by_admin_at'),false,false,false,false), 
                $this->column('admin_actions',__('Actions'),false,false,false,false), 
            ];
        }
        elseif($this->delegate_id)
        {
            $columns = [ 
                $this->column('id',__('order_number'),false,true,false,false),
                $this->column('shop_name',__('shop_name'),false,false,false,false),
                $this->column('consignee_city',__('consignee_city'),false,false,false,false),
                $this->column('consignee_region',__('consignee_region'),false,false,false,false),
                $this->column('consignee_phone', __('Phone'),false,true,false,false),
                $this->column('order_price', __('Order price'),false,false,false,false),
                $this->column('value_on_delivery', __('Value on delivery'),false,false,false,false),
                $this->column('shipment_status_id', __('Action Status'),false,true,false,false), 
                $this->column('notes', __('Notes'),false,false,false,false),
                $this->column('delegate_shipment_actions', __('Actions')), 
            ];
        }
        elseif($this->is_return)
        {
            $columns = [ 
                $this->column('id',__('order_number'),false,true,false,false),
                $this->column('shop_name',__('shop_name'),false,false,false,false),
                $this->column('consignee_city',__('consignee_city'),false,false,false,false),
                $this->column('consignee_region',__('consignee_region'),false,false,false,false),
                $this->column('consignee_phone', __('Phone'),false,true,false,false),
                $this->column('order_price', __('Order price'),false,false,false,false),
                $this->column('value_on_delivery', __('Value on delivery'),false,false,false,false),
                $this->column('delegate_name', __('Delegate Name'),false,false,false,false),
                $this->column('shipment_status_id', __('Action Status'),false,true,false,false), 
                $this->column('return_status', __('Return Status'),false,false,false,false), 
                $this->column('created_at',__('Created.'),false,false,false,false),
                $this->column('notes', __('Notes'),false,false,false,false),
                $this->column('return_shipment_actions', __('Actions')), 
            ];
        }
        elseif ($this->shop_id)  //user datatable in admin dashboard
        {
            $columns = [
                // $this->column('checkbox','<input type="checkbox" id="master">',false,false,false,false,'checkbox'),
                $this->column('checkbox', false, false, false, false),
                $this->column('id',__('order_number'),false,true,false,false),
                // $this->column('DT_RowIndex','#',false,false,false,false), 
                $this->column('consignee_city',__('City'),false,false,false,false), 
                $this->column('consignee_region',__('consignee_region'),false,false,false,false),
                $this->column('consignee_phone', __('Phone'),false,true,false,false), 
                $this->column('order_price', __('Order price'),false,false,false,false),
                $this->column('value_on_delivery', __('Value on delivery'),false,false,false,false), 
                $this->column('shipment_status_id', __('Action Status'),false,true,false,false),
                    
                $this->column('customer_notes',__('Customer notes'),false,false,false,false),
                $this->column('delegate_notes', __('Delegate notes')),
                $this->column('created_at',__('Created.'),false,false,false,false),
                // $this->column('accepted_by_admin_at',__('accepted_by_admin_at'),false,false,false,false), 
                $this->column('user_actions',__('Actions'),false,false,false,false), 
        ];
    }
    // elseif (!$this->is_from_admin && !$this->delegate_id)  //user datatable
    else
    {
        $columns = [
            // $this->column('checkbox','<input type="checkbox" id="master">',false,false,false,false,'checkbox'),
            $this->column('checkbox', false, false, false, false),
            $this->column('id',__('order_number'),false,true,false,false),
            // $this->column('DT_RowIndex','#',false,false,false,false), 
            $this->column('consignee_city',__('City'),false,false,false,false), 
            $this->column('consignee_region',__('consignee_region'),false,false,false,false),
            $this->column('consignee_phone', __('Phone'),false,true,false,false), 
            $this->column('order_price', __('Order price'),false,false,false,false),
            $this->column('value_on_delivery', __('Value on delivery'),false,false,false,false), 
            $this->column('shipment_status_id', __('Action Status'),false,true,false,false), 
            $this->column('customer_notes',__('Customer notes'),false,false,false,false),
            $this->column('delegate_notes', __('Delegate notes')),
            $this->column('created_at',__('Created.'),false,false,false,false),
            $this->column('accepted_by_admin_at',__('accepted_by_admin_at'),false,false,false,false), 
            $this->column('user_actions', __('Actions'),false,false,false,false)
        ];
    }
    

    return $columns;
  
}

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Express_' . date('YmdHis');
    }
}
