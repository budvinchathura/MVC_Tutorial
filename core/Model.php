<?php

class Model{
    protected $_db,  $_table, $_modelName, $_softDelete=false, $_columnNames=[];

    public function __construct($table)
    {
        $this->_db = DB::getInstance();
        $this->_table = $table;
        $this->_setTableColumns();
        $this->_modelName = str_replace(' ','',ucwords(strtolower(str_replace('_',' ',$this->_table))));

    }

    protected function _setTableColumns(){
        $columns = $this->getColumns();

    }

    public function getColumns(){
        return $this->_db->get_columns($this->_table);
    }

}