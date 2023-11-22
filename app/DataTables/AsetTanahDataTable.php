<?php

namespace App\DataTables;

use App\Models\AsetTanah;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AsetTanahDataTable extends DataTable
{
    protected $jenis = 'tanah';
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('pilih', function ($row) {
                return '<input class="form-check-input" name="terpilih[]" type="checkbox" value="' . $row->id_aset_tanah . '">';
            })
            ->rawColumns(['pilih']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(AsetTanah $model): QueryBuilder
    {
        return $model->newQuery()
            ->select([
                'id_aset_tanah',
                'kode_aset',
                'nama',
                'letak_tanah',
                'status_aset.status_aset',
            ])
            ->leftJoin('status_aset', 'status_aset.id_status_aset', '=', 'aset_tanah.id_status_aset')
            ->where('status_aset.status_aset', 'Tersedia');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('asetTanahTable')
            ->columns($this->getColumns())
            ->minifiedAjax()
        //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('pilih')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->title('Pilih'),
            Column::make('id_aset_tanah')->title('ID'),
            Column::make('kode_aset')->title('Kode Aset'),
            Column::make('nama')->title('Nama Tanah'),
            Column::make('letak_tanah')->title('Lokasi Tanah'),
            Column::make('status_aset')->title('Status'),
            // Column::make('add your columns'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'AsetTanah_' . date('YmdHis');
    }
}
