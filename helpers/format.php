<?php

class Format{
    public function formatDate($date)
    {
        return date('F j, Y g:i a', strtotime($date));
    }

    // format doan text ngan de duoc tieu de chuan sell
    public function textShorten($text, $Limit = 400){
        $text = $text. "";
        $text = substr($text, 0, $Limit);
        $text = substr($text, 0 ,strrpos($text, ' '));
        $text = $text. ".......";
        return $text;
    }
    
    // kiem tra form ...
    public  function validation($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // kiem tra ten cua server
    public function title(){
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path, '.php');

        if ($title == 'index') {
        $title = 'home';
        } elseif ($title == 'contact') {
            $title = 'contact';
        }
        return $title = ucfirst($title);
    }

    public function product_price($priceFloat) {
        $symbol = 'đ';
        $symbol_thousand = '.';
        $decimal_place = 0;
        $price = number_format($priceFloat, $decimal_place, '', $symbol_thousand);
        return $price.$symbol;
        }
}
?>