<?php

namespace App\DataTables;

use App\Member;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MemberDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)

            ->addColumn('action', function($row){
                $btn = '<a href="/members/'.$row->id.'/edit" class="fa fa-edit fa-lg"></a>
                        &nbsp;<a href="#" data-info="'.$row.'" data-target="#memberProfileModal" data-toggle="modal" class="fa fa-eye fa-lg"></a>
                        &nbsp;<a href="#" data-info="'.$row->id.'" data-target="#deleteModal" data-toggle="modal" class="fa fa-trash fa-lg"></a>';
                return $btn;
            })
            ->addColumn('school_id', function($row){
                return $row->school->name;
            })
            ->addColumn('checkmark', function($row){
                return '<div class="icheckbox_flat-green" style="position: relative;">
                <input type="checkbox" class="flat" name="table_records" style="position: absolute; opacity: 0;">
                <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                </div>';
             })
            ->rawColumns(['checkmark'],true);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \Member $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Member $model)
    {
        // return $model->newQuery();
        $query = $model->newQuery()->select('id','first_name', 'last_name','id_number','school_id','joined_date');

        if(auth()->user()->role_id != 1){
            $query->where('school_id','=',auth()->user()->school_id);
        }
        return $query->where('is_approved','=','0');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    //->setTableId('datatable-buttons')
                    ->setTableAttribute('class','table table-striped jambo_table bulk_action')//'table table-striped table-bordered')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lBfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('copy'),
                        Button::make('csv'),
                        Button::make('print'),
                        // Button::make('reset'),
                        // Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('checkmark')
                    ->exportable(false)
                    ->printable(false)
                    ->width(100),
            Column::make('first_name')
                    ->addClass('column-title'),
            Column::make('last_name')
                    ->addClass('column-title'),
            Column::make('id_number')
                    ->addClass('column-title'),
            // Column::make('contact'),
            // Column::make('email'),
            Column::make('school_id')
                    ->addClass('column-title'),
            Column::make('joined_date')
                    ->addClass('column-title'),
            Column::computed('action')
                    ->addClass('column-title no-link last')
                    ->exportable(false)
                    ->printable(false)
                    ->width(100)
                    // ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Member_' . date('YmdHis');
    }
}



// <thead>
//                           <tr class="headings">
//                             <th>
//                               <input type="checkbox" id="check-all" class="flat">
//                             </th>
//                             <th class="column-title">Invoice </th>
//                             <th class="column-title">Invoice Date </th>
//                             <th class="column-title">Order </th>
//                             <th class="column-title">Bill to Name </th>
//                             <th class="column-title">Status </th>
//                             <th class="column-title">Amount </th>
//                             <th class="column-title no-link last"><span class="nobr">Action</span>
//                             </th>
//                             <th class="bulk-actions" colspan="7">
//                               <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
//                             </th>
//                           </tr>
//                         </thead>
