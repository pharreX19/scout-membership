<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
            ->setRowAttr([
                'align'=>'center'
            ])

            ->addColumn('action', function($row){
                $btn = '<a href="#" data-toggle="modal" data-info="'.$row->role_id.','.$row->is_approved.','.$row->id.'"data-target="#userUpdateModal" class="fa fa-edit fa-lg"></a>&nbsp;
                <a href="#" data-toggle="modal" data-info="'.$row->id.'"data-target="#deleteModal" class="fa fa-trash fa-lg"></a>';
                return $btn;
            })
            ->addColumn('role_id', function($row){
                return $row->role->name;
            });
    ;}

    /**
     * Get query source of dataTable.
     *
     * @param \Document $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
                    ->orderBy(0)
                    ->pageLength(10)
                    ->buttons(
                        Button::make('copy'),
                        Button::make('csv'),
                        Button::make('print'),
                        //Button::make('view'),
                        //Button::make('reload')
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
            Column::make('email'),
            Column::make('role_id'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::make('is_approved'),
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
        return 'Documents_' . date('YmdHis');
    }
}



