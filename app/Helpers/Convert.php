<?php 
namespace App\Helpers;

class Convert
{

    protected $integerOrRomans;

    
    public function __construct($integerOrRomans)
    {
        $this->integerOrRomans = $integerOrRomans;
    }

    public function toRomans(): string
    {
        $integer = $this->integerOrRomans;
        $result = '';
        $lookup = [
            'C̅' => 100000,
            'M̅' => 10000, 
            'V̅' => 5000, 
            'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
            'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
            'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
        ];
        foreach ($lookup as $roman => $value) {
            $matches = intval($integer / $value);
            $result .= str_repeat($roman, $matches);
            $integer %= $value;
        }
        return $result;
    }


    public function toInteger() : int
    {
        $romans = $this->integerOrRomans;
        $result = 0;
        $lookup = array(
            'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
            'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
            'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
        );
        foreach ($lookup as $roman => $value) {
            while (strpos($romans, $roman) === 0) {
                $result += $value;
                $romans = substr($romans, strlen($roman));
            }
        }
        return $result;
    }

    public static function isRoman($string) : bool
    {
        return preg_match('/^M*(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/', $string);
    }
    
}