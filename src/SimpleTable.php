<?php

namespace KornerBI\UserManagement;

/**
 * Class SimpleTable
 * @package KornerBI\UserManagement
 */
class SimpleTable
{
    /**
     * @var
     */
    protected $columns;
    protected $data;

    /**
     * SimpleTable constructor.
     * @param $columns
     * @param $data
     */
    public function __construct($columns, $data)
    {
        $this->render($columns, $data);
    }

    public function render($columns, $data)
    {
        return view('simple-table', [
            'data' => $data,
            'columns' => $columns
        ]);
    }
}
