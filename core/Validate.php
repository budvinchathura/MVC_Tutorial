<?php

class Validate
{
    private $_passed = false, $_errors = [], $_db = null;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function check($source, $items = [])
    {
        $this->_erros = [];
        foreach ($items as $item => $rules) {
            $item = sanitize($item);
            $display = $rules['display'];
            foreach ($rules as $rule => $ruleValue) {
                $value = sanitize(trim($source[$item]));

                if ($rule === 'required' && empty($value)) {
                    $this->addError(["{$display} is required", $item]);
                } else if (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $ruleValue) {
                                $this->addError(["{$display} must be minimum of {$ruleValue} characters.", $item]);
                            }
                            break;

                        case 'max':
                            if (strlen($value) > $ruleValue) {
                                $this->addError(["{$display} must be maximum of {$ruleValue} characters.", $item]);
                            }
                            break;

                        case 'matches':
                            if ($value != $source[$ruleValue]) {
                                $matchDisplay = $items[$ruleValue]['display'];
                                $this->addError(["{$matchDisplay} and {$display} must match.", $item]);
                            }
                            break;

                        case 'unique':
                            $check = $this->_db->query("SELECT {$item} FROM {$ruleValue} WHERE {$item} = ?", [$value]);
                            if ($check->count()) {
                                $this->addError(["{$display} already exists. Please choose another {$display}", $item]);
                            }
                            break;

                        case 'uniqueUpdate':
                            $t = explode(',', $ruleValue);
                            $table = $t[0];
                            $id = $t[1];
                            $query = $this->_db->query("SELECT * FROM {$table} WHERE id != ? AND {$item} =?", [$id, $value]);

                            if ($query->count()) {
                                $this->addError(["{$display} already exists. PLease choose another {$display}.", $item]);
                            }

                            break;

                        case 'isNumeric':
                            if (!is_numeric($value)) {
                                $this->addError(["{$display} has to be a number. Please use a numeric value", $item]);
                            }
                            break;

                        case 'validEmail':
                            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                $this->addError(["{$display} must be a valid email address.", $item]);
                            }
                            break;
                    }
                }
            }
        }
        if(empty($this->_errors)){
            $this->_passed=true;
            return $this;
        }
    }



    public function addError($error)
    {
        $this->_errors[] = $error;

        if (empty($this->_errors)) {
            $this->_passed = true;
        } else {
            $this->_passed = false;
        }
    }

    public function errors()
    {
        return $this->_errors;
    }

    public function passed()
    {
        return $this->_passed;
    }

    public function displayErrors()
    {
        $html = '<ul>';

        foreach ($this->_errors as $error) {
            if (is_array($error)) {
                $html .= '<li>' . $error[0] . '</li>';
            } else {
                $html .= '<li>' . $error . '</li>';
                // $html .= '<script>jQuery("document").ready(function(){jQuery("input[name=tcol1]
            }
        }
        $html .= '</ul>';
        return $html;
    }
}
