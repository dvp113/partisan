<?php
/**
 * Created by PhpStorm.
 * User: cpu10369
 * Date: 03/05/2019
 * Time: 11:07
 */
namespace App\Helpers;

class RenderTable {
    const HIDDEN_COLUMNS = ['created_at', 'updated_at', 'deleted_at'];
    const CREATE_MODAL_HIDDEN_COLUMNS = ['id'];
    protected $Columns = [];
    public function __construct(Array $columns)
    {
        echo 'chay nha';
        $this->Columns = $columns;
    }

    public function setColumn(Array $columns)
    {
        $this->Columns = $columns;
    }

    public function getShowColumn()
    {
        $arr_result = [];
        foreach ($this->Columns as $key => $value){
            if (!in_array($key, self::HIDDEN_COLUMNS)){
                $arr_result[$key] = $value;
            }
        }
        return $arr_result;
    }

    public function getModelFillable()
    {
        $fillable_arr =  $this->getArrayKeyCreate();

        $string_result = "['".implode("', '",$fillable_arr)."']";       // => ['a', 'b', 'c']

        return $string_result;
    }

    /*
     * render DataTable Column for View
     * format: HTML
     *
     */
    public function renderDataTableColumnHTML()
    {
        var_dump($this->Columns);
        if (!count($this->Columns)){
            echo "Not set columns to render";
            return false;
        }

        $begin_tag = '<th>';
        $end_tag = '</th>';
        $break_line = "\n";

        $html_result= '';
        foreach ($this->Columns as $key => $value){
            if (!in_array($key, self::HIDDEN_COLUMNS)){
                $html_result .= $begin_tag. $key .$end_tag.$break_line;
            }
        }
        $html_result.= $begin_tag. "action" .$end_tag.$break_line;
        return $html_result;
    }

    /*
     * get array key of columns
     * result format: Array
     *
     */
    public function getArrayKeyEdit()
    {
        return array_keys($this->getShowColumn());
    }

    public function getArrayKeyCreate()
    {
        return array_keys($this->getShowColumnCreateModal());
    }

    //@TODO tao modal create
    public function renderCreateModalHTML()
    {
        $input_form = "<div class=\"form-group\">
                         <label for=\"{{label}}\">{{label}}</label>
                         <input type=\"{{type}}\" class=\"form-control\" id=\"create_input_{{label}}\">
                       </div>";
        $break_line = "\n";

        $form_result = "";
        $columns = $this->getShowColumnCreateModal();
        foreach ($columns as $name => $type) {
            $input_type = 'text';

            if ($type == "bigint" OR $type == "integer"){
                $input_type = 'number';
            }elseif ($type == "string"){
                $input_type = 'text';
            }elseif ($type == "datetime"){
                $input_type = 'datetime-local';
            }

            $one_form = str_replace(
                [
                    '{{label}}','{{type}}'
                ],
                [
                    $name, $input_type
                ],
                $input_form
            );
            $form_result = $form_result.$one_form.$break_line;
        }

        return $form_result;
    }

    protected function getShowColumnCreateModal()
    {
        $arr_result = [];
        foreach ($this->Columns as $key => $value){
            if (!in_array($key, self::HIDDEN_COLUMNS) && !in_array($key, self::CREATE_MODAL_HIDDEN_COLUMNS)){
                $arr_result[$key] = $value;
            }
        }
        return $arr_result;
    }
    public function renderEditModalHTML()
    {
        $disable_input_columns = ['id'];
        $input_form = "<div class=\"form-group\">
                         <label for=\"{{label}}\">{{label}}</label>
                         <input type=\"{{type}}\" class=\"form-control\" id=\"edit_input_{{label}}\" {{otherAttr}}>
                       </div>";
        $break_line = "\n";

        $form_result = "";
        $columns = $this->getShowColumn();
        foreach ($columns as $name => $type) {
            $input_type = 'text';
            $other_attr = '';

            if ( in_array($name,$disable_input_columns)){
                $other_attr = $other_attr.' disabled';
            }

            if ($type == "bigint" OR $type == "integer"){
                $input_type = 'number';
            }elseif ($type == "string"){
                $input_type = 'text';
            }elseif ($type == "datetime"){
                $input_type = 'datetime-local';
            }

            $one_form = str_replace(
                [
                    '{{label}}',
                    '{{type}}',
                    '{{otherAttr}}',
                ],
                [
                    $name,
                    $input_type,
                    $other_attr,
                ],
                $input_form
            );
            $form_result = $form_result.$one_form.$break_line;
        }

        return $form_result;
    }

    /*
     * render DataTable Js for View
     * format: Javascript
     *
     */
    public function renderDataTableColumnJS()
    {
        var_dump($this->Columns);
        if (!count($this->Columns)){
            echo "Not set columns to render";
            return false;
        }

        $break_line = "\n";

        $js_result= '';
        foreach ($this->Columns as $key => $value){
            if (!in_array($key, self::HIDDEN_COLUMNS)){
                $js_result .= "{ data: '$key', name: '$key' },".$break_line;
            }
        }
        $js_result.="{data: 'action', name: 'action', orderable: false, searchable: false}".$break_line;

        return $js_result;
    }
}