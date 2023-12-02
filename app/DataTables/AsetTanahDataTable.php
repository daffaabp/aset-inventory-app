<?php

namespace App\DataTables;

use App\Models\AsetTanah;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AsetTanahDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                $editUrl = route('tanah.edit', $row->id_aset_tanah);
                $deleteUrl = route('tanah.destroy', $row->id_aset_tanah);

                return view('aset.tanah.index', compact('editUrl', 'deleteUrl'));
            })
            ->addColumn('status_aset', function ($row) {
                return $row->statusAset->status_aset;
            })
            ->addColumn('tanggal_inventarisir', function ($row) {
                return Carbon::parse($row->tanggal_inventarisir)->isoFormat('D MMMM Y');
            })
            ->addColumn('tanggal_sertifikat', function ($row) {
                return Carbon::parse($row->tanggal_sertifikat)->isoFormat('D MMMM Y');
            })
            ->addColumn('harga', function ($row) {
                return formatRupiah($row->harga, true);
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(AsetTanah $model): QueryBuilder
    {
        return $model->newQuery()->with('statusAset');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Blfrtip')
            ->orderBy(1);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            'id_aset_tanah' => ['visible' => false],
            'status_aset' => ['title' => 'Status Tanah'],
            'kode_aset' => ['title' => 'Kode'],
            'nama' => ['title' => 'Nama'],
            'tanggal_inventarisir' => ['title' => 'Tanggal Inventarisir'],
            'luas' => ['title' => 'Luas (m^2)'],
            'letak_tanah' => ['title' => 'Letak Tanah'],
            'hak' => ['title' => 'Hak'],
            'tanggal_sertifikat' => ['title' => 'Tgl. Sertifikat'],
            'no_sertifikat' => ['title' => 'No. Sertifikat'],
            'penggunaan' => ['title' => 'Penggunaan'],
            'harga' => ['title' => 'Harga'],
            'keterangan' => ['title' => 'Keterangan'],
            'action' => ['title' => 'Aksi', 'orderable' => false, 'searchable' => false],
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
