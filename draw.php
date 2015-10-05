<?php

class draw {
   public static function table($rows){
       $data = "";

     for($i = 0; $i < $rows; $i++) {
         $data .= "<tr data-row='$i'>";

         for($y = 0; $y < $rows; $y++) {
             $data .= "<td data-col='$y'>" .  self::drawRandomCell() . "</td>";
         }
         $data .= "</tr>";
     }

     return $data;
   }

    private function drawRandomCell(){
        $cells = [
            '<span class="1">ò</span>',
            '<span class="2">õ</span>',
            '<span class="3">ô</span>',
            '<span class="4">ö</span>',
            '<span class="5">ó</span>'
        ];

        $index = rand(0, count($cells) - 1);

        return $cells[$index];
    }
} 