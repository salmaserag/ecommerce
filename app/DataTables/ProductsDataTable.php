<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addColumn('action', function ($model) {
                $html = '<div class="d-flex inline-flex">';
                $html .= '<a class="btn btn-sm btn-primary me-2" href="' . route('products.edit', ['product' => $model->id]) . '">
                          <i class="bi bi-pencil"></i>
                      </a>';
                $html .= '<form action="' . route('products.destroy', ['product' => $model->id]) . '" method="POST" style="display:inline-block;">
                          ' . csrf_field() . '
                          ' . method_field('DELETE') . '
                          <button class="btn btn-sm btn-danger" type="submit">
                              <i class="bi bi-trash"></i>
                          </button>
                      </form>';
                $html .= '</div>';

                return $html;
            })

            ->editColumn('name', function ($model) {

                $html = '<a href=' . route('products.show', ['product' => $model->id]) . '>' .  $model->name . '</a>';
                return $html;
            })


            // ->editColumn('photo', function ($model) {

            //     $html = '<img src="' . ($model->photo ? asset('storage') . '/' . $model->photo : '') . '" 
            //     alt="Profile" class="rounded-circle">';
            //     return $html;
            // })

            ->addColumn('code', function ($model) {
                return $model->code;
            })


            ->addColumn('price', function ($model) {
                return $model->price;
            })

            ->addColumn('quantity', function ($model) {
                return $model->quantity;
            })

            ->addColumn('created_by', function ($model) {
                return $model->createdBy ? $model->createdBy->name : 'N\A';
            })

            ->addColumn('updated_by', function ($model) {
                return $model->updatedBy ? $model->updatedBy->name : 'N\A';
            })

            ->editColumn('created_at', function ($model) {
                return $model->created_at->format('Y-m-d H:i:s');
            })

            ->editColumn('updated_at', function ($model) {
                return $model->created_at->format('Y-m-d H:i:s');
            })


            ->rawColumns(['action', 'name' , 'photo'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('products-table')
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
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->addClass('text-center'),
            // Column::make('photo')->addClass('text-center'),
            Column::make('code')->addClass('text-center'),
            Column::make('name')->addClass('text-center'),
            Column::make('price')->addClass('text-center'),
            Column::make('quantity')->addClass('text-center'),
            Column::make('created_by')->addClass('text-center'),
            Column::make('updated_by')->addClass('text-center'),
            Column::make('created_at')->addClass('text-center'),
            Column::make('updated_at')->addClass('text-center'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Products_' . date('YmdHis');
    }
}
