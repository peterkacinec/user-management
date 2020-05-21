<?php

namespace KornerBI\UserManagement;

/**
 * Class SimpleTable
 * @package KornerBI\UserManagement
 */
class SimpleTable
{
    protected $data;
    protected $columns;
    protected $actions;
    protected $entityRoutePrefix;

    /**
     * SimpleTable constructor.
     * @param $entityRoutePrefix String define base url link for action button
     * @param $data array of data, that shows in table
     * @param $columns array of columns desc
     * @param $actions array of action buttons
     */
    public function __construct($columns = [], $data = [], $entityRoutePrefix = '', $actions = null)
    {
        $this->data = $data;
        $this->columns = $columns;

        if (is_null($actions)) {
            $this->entityRoutePrefix = $entityRoutePrefix;
            $this->actions = $this->setDefaultActions();
        } else {
            $this->actions = $actions;
        }
    }

    private function setDefaultActions() {
        return [
            [
                'label' => __('user_management::general.Detail'),
                'key' => 'detail',
                'class' => 'btn btn-primary btn-sm mr-1',
                'url' => [
                    'link' => $this->entityRoutePrefix,
                    'attribute' => 'id',
                ]
            ],
            [
                'label' => __('user_management::general.Delete'),
                'key' => 'delete',
                'class' => 'btn btn-danger btn-sm',
                'url' => [
                    'link' => $this->entityRoutePrefix,
                    'attribute' => 'id',
                ]
            ]
        ];
    }

    public function render()
    {
        return view('user_management::simple-table', ['config' => [
            'data' => $this->data,
            'columns' => $this->columns,
            'actions' => $this->actions
        ]]);
    }
}
