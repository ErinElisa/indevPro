<?php

use App\Models\Flower;

if (! function_exists('rupiah_split')) {
    function rupiah_split($val) {
        return '<span class="d-flex gap-2 justify-content-between">
        <span>Rp</span>
        <span>'.number_format($val, 0, ',', '.').'</span>
      </span>';
    }
}


function nomor($num){
  return number_format($num, 0, ',', '.');
}


function getFlower($fid){
  return Flower::where('id', $fid)->first();
}

function padLeft($string){
  $desiredLength = 2;
  $paddingCharacter = "0";
  return str_pad($string, $desiredLength, $paddingCharacter, STR_PAD_LEFT); // Output: 00000Hello
}


function textBeauty($text){
  $sign = ['-', '_'];
  return ucwords(str_replace($sign, ' ', $text));
}