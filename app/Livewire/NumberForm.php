<?php

namespace App\Livewire;

use Livewire\Component;
use App\Helpers\Convert; // Make sure to use your actual Convert helper's namespace

class NumberForm extends Component
{
    public $inputValue = '';
    public $result = null;

    
    public function submit()
    {

        $this->result = null;
        // Dynamically set the validation rules
        $this->validate([
            'inputValue' => $this->getDynamicRule(),
        ]);

        $convert = new Convert($this->inputValue);  
        if (Convert::isRoman($this->inputValue)) {
            $this->result = $convert->toInteger();
        } else {
            $this->result = $convert->toRomans();
        }

    }

    protected function getDynamicRule()
    {
        // Check if inputValue is numeric and an integer
        if (is_numeric($this->inputValue) && intval($this->inputValue) == $this->inputValue) {
            // It's an integer, apply the max value rule
            return ['integer', 'max:100000'];
        }

        // Not an integer, apply the regex rule
        return ['regex:/^(\d+|M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3}))$/i'];
    }

    public function render()
    {
        return view('livewire.number-form',['result' => $this->result]);
    }
}