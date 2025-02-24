<?php
namespace http\Forms;
use core\Validator;
class ExpenseForm
{
    protected $errors = [];
    public function validate($amount,$category, $description, $date)
    {
        
        if (!Validator::amount($amount)) {
            $this->errors['amount'] = 'Please provide a valid amount.';
        }
        if (!Validator::string($category)) {
            $this->errors['category'] = 'Please provide a valid category.';
        }
        if (!Validator::string($description)) {
            $this->errors['description'] = 'Please provide a valid description.';
        }
        if (!Validator::date($date)) {
            $this->errors['date'] = 'Please provide a valid date.';
        }
       
        return empty($this->errors);
    }
    public function errors()
    {
        return $this->errors;
    }
    public function error($field, $message)
    {
        $this->errors[$field] = $message;
    }
}