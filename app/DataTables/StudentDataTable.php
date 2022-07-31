<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StudentDataTable extends DataTable
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
            ->addColumn('action', function (Role $role) {
                return view('components.datatable_actions', ['id' => $role->id, 'path' => 'admin.roles']);
            })
            ->editColumn('name', function ($row) {
                $name = $row->name;
                // $useEmail = $row->email;
                $logoCharacter = $row->name[0];
                return '<div class="media flex-nowrap align-items-center" style="white-space: nowrap;">
                    <div class="avatar avatar-sm mr-8pt">
                        <span class="avatar-title rounded-circle">' . $logoCharacter . '</span>
                    </div>
                    <div class="media-body">
                        <div class="d-flex flex-column">
                            <p class="mb-0"><strong class="js-lists-values-employee-name">' . $name . '</strong></p>
                        </div>
                    </div>
                </div>';
            })
            ->addIndexColumn()

            // })
            // ->editColumn('status', function ($row) {
            //     $class = ($row->status == 'ACTIVE') ? 'badge-primary' : 'badge-danger';
            //     return '<span class="badge badge-pill ' . $class . ' px-3 py-2">' . ucfirst(strtolower($row->status)) . '</span>';
            // })
            // ->addIndexColumn()
            // ->filterColumn('roles.display_name', function ($query, $role) {
            //     $role ? $query->where('roles.role', $role) : '';
            // })
            // ->filterColumn('status', function ($query, $status) {
            //     $status ? $query->where('admins.status', $status) : '';
            // })
            ->rawColumns(['name']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
    {
        return $model->newQuery()
            ->with('permissions');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('adminrolesdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-6'B><'col-sm-6 text-right'l>>rt<'row'<'col-sm-6'p><'col-sm-6 text-right'i>>")
            ->orderBy(2, 'asc')
            ->buttons($this->generateButtons())
            ->parameters([
                "pagingType" => "simple_numbers",
                "language" => [
                    'paginate' => [
                        'previous' => '<span aria-hidden="true" class="material-icons">chevron_left</span><span>Prev</span>',
                        'next' => 'NEXT<span aria-hidden="true" class="material-icons">chevron_right</span>',
                    ],
                    'info' => '_START_ <span class="text-50">of _TOTAL_ <em class="material-icons ml-1">arrow_forward</em></span>',
                    'infoFiltered' => '',
                    "infoEmpty" => "<span class='text-50'>No records available</span>",
                ],
                // "aLengthMenu" => [[1, 10, 25, 50, -1], [1, 10, 25, "All"]],
                'initComplete' => "function () {
                    let oTable = $('#adminrolesdatatable-table').DataTable(),
                        page_element = {
                            admin_status: $('#admin-status'),
                            admin_user_search: $('#admin-user-search'),
                            admin_role:  $('#admin-role')
                        },
                    admin_status = page_element.admin_status.is(':checked') ? 'ACTIVE' : 'BLOCKED';

                    // global search
                    page_element.admin_user_search.on('keyup', function() {
                        let keyword = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        oTable.search(keyword).draw() ;
                    });

                    // admin role dropdown filter event
                    page_element.admin_role.on('change', function() {
                        let admin_role = $(this).val();
                        oTable.column(2).search( admin_role ? admin_role : '', true, false )
                        .draw();
                    });

                    // admin status checkbox filter event
                    page_element.admin_status.on('change', function() {
                        let admin_status = $(this).is(':checked') ? 'ACTIVE' : 'BLOCKED';
                        $(this).parent().siblings('label').text(admin_status);
                        oTable.column(3).search( admin_status ? admin_status : '', true, false )
                        .draw();
                    });

                    // admin-status search by default
                    oTable.column(3).search( admin_status ? admin_status : '', true, false ).draw();
               }",
                'responsive' => 'true',
                'drawCallback' => "function () {
                    $('.dataTables_paginate > .pagination').addClass('justify-content-start pagination-xsm m-0');
                }",
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')
                ->title('#')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false),
            Column::make('name'),
            Column::make('display_name'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
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
        return 'AdminRoles_' . date('YmdHis');
    }

    /**
     * Generate buttons
     *
     * @author Nishal <nishal@webandcrafts.com>
     *
     * @return array
     */
    protected function generateButtons(): array
    {
        $buttons = [
            Button::make('create'),
            // Button::make('export'),
            Button::make('print'),
            Button::make('reset'),
        ];

        /** @var \App\Models\Admins */
        // $user = auth()->user();
        // if ($user->can('create.admins')) {
        //     array_unshift($buttons, Button::make('create'));
        // }

        return $buttons;
    }

}
