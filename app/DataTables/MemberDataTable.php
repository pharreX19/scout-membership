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
            ->addColumn('school_id', function($row){
                return $row->school->name;
            })
            ->addColumn('rank_id',function($row){
                return $row->rank->name;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Member $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Member $model)
    {
        return $model->newQuery();
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
                    ->setTableAttribute('class','table table-striped table-bordered')
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
            Column::make('first_name'),
            Column::make('last_name'),
            Column::make('id_number'),
            Column::make('contact'),
            Column::make('email'),
            Column::make('school_id'),
            Column::make('rank_id'),
            Column::make('joined_date')
            // Column::computed('action')
            //         ->addClass('column-title no-link last')
            //         ->exportable(false)
            //         ->printable(false)
            //         ->width(100)
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
