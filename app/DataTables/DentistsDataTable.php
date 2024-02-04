<?php

namespace App\DataTables;

use App\Models\Dentist;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DentistsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $dataTable = (new EloquentDataTable($query))
            ->addColumn('action', 'dentists.action')
            ->setRowId('id')
            ->addIndexColumn();

        $dataTable->addColumn('checker', function (Dentist $model) {
            return view('dashboard.dentist._table_column_check', get_defined_vars());
        });


        return $dataTable;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Dentist $model): QueryBuilder
    {
        return $model->newQuery()->groupBy(['dentists.id']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('dentists_table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
            //->dom('Bfrtip')
                    ->buttons([])
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->parameters([
                        'language' => [
                            'url' => url('https://cdn.datatables.net/plug-ins/1.13.6/i18n/fa.json'),
                        ],
                        // other configs
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('checker')
                  ->title('<div class="form-check form-check-sm form-check-custom form-check-solid me-3"><input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#user_table .form-check-input" /></div>')
                  ->width(30)
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('text-center')
                  ->responsivePriority(-1),
            Column::computed('DT_RowIndex')
                  ->title('ردیف')
                  ->addClass('text-center')
                  ->attributes(['class' => 'text-gray-400 fw-bold fs-6']),
            Column::make('dr_number')
                  ->title('شماره نظام پزشکی')
                  ->addClass('text-center')
                  ->attributes(['class' => 'text-gray-400 fw-bold fs-6']),
            Column::make('first_name')
                  ->title('نام')
                  ->addClass('text-center')
                  ->attributes(['class' => 'text-gray-400 fw-bold fs-6']),
            Column::make('last_name')
                  ->title('نام خانوادگی')
                  ->addClass('text-center')
                  ->attributes(['class' => 'text-gray-400 fw-bold fs-6']),
            Column::make('percent')
                  ->title('درصد سهم')
                  ->addClass('text-center')
                  ->attributes(['class' => 'text-gray-400 fw-bold fs-6']),
            Column::make('birth_date')
                  ->title('تاریخ تولد')
                  ->addClass('text-center')
                  ->attributes(['class' => 'text-gray-400 fw-bold fs-6']),
            Column::make('home_address')
                  ->title('آدرس منزل')
                  ->addClass('text-center')
                  ->attributes(['class' => 'text-gray-400 fw-bold fs-6'])
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Dentists_' . date('YmdHis');
    }
}
