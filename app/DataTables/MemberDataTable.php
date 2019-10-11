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
                        &nbsp;<a href="#" data-info="'.$row->id.'" data-target="#deleteModal" data-toggle="modal" class="fa fa-trash fa-lg"></a>';
                return $btn;
            })
            ->addColumn('atoll_id', function($row){
                return $row->atoll->name;
            })
            ->addColumn('island_id', function($row){
                return $row->island->name;
            })
            ->addColumn('school_id', function($row){
                return $row->school->name;
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
            Column::make('birth_date'),
            Column::make('contact'),
            Column::make('email'),
            Column::make('atoll_id'),
            Column::make('island_id'),
            Column::make('school_id'),
            Column::make('joined_date'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(20)
                  ->addClass('text-center'),
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

