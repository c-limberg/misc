<?php

$set = array(1,2,3,4,5,6,7,8,9);

$grid = array(
    array(0,0,0,0,0,0,0,0,0),
    array(0,0,0,0,0,0,0,0,0),
    array(0,0,0,0,0,0,0,0,0),
    array(0,0,0,0,0,0,0,0,0),
    array(0,0,0,0,0,0,0,0,0),
    array(0,0,0,0,0,0,0,0,0),
    array(0,0,0,0,0,0,0,0,0),
    array(0,0,0,0,0,0,0,0,0),
    array(0,0,0,0,0,0,0,0,0),
);

function setField(&$arr, $x, $y, $val){
    if($val<1||$val>9) print("Invalid input");

    $arr[$y][$x] = $val;
}

function isInRow($arr, $x, $num){
    if(in_array($num,$arr[$x])) return true;

    return false;
}

function isInCol($arr, $y, $num){
    foreach($arr as $val)
        if($val[$y]==$num) return true;

        return false;
}

function isInGrid($arr, $x, $y, $num){
    $r = $x - $x%3;
    $c = $y - $y%3;
    for($i = $r;$i<$r+3;$i++) {
        for ($j = $c; $j < $c + 3; $j++)
            if ($arr[$i][$j] == $num)
                return true;
    }
    return false;
}

function isInX($arr, $x, $y, $num){
        for($i=0;$i<9;$i++){
            for($j=0;$j<9;$j++){
                if($x==$y&&$i==$j||$x+$y==8&&$i+$j==8) {
                    if ($arr[$i][$j] == $num) return true;
                }
            }
        }
    return false;
}

function validMove($arr, $x, $y, $num){
    return !(isInRow($arr,$x,$num)||isInCol($arr,$y,$num)||isInGrid($arr,$x,$y,$num));
}

function validMoveX($arr, $x, $y, $num){
    return !(isInRow($arr,$x,$num)||isInCol($arr,$y,$num)||isInGrid($arr,$x,$y,$num)||isInX($arr, $x, $y, $num));
}

function solve(&$arr){
    for($row=0;$row<9;$row++) {
        for ($col = 0; $col < 9; $col++) {
            if ($arr[$row][$col] == 0) {
                for ($num = 1; $num <= 9; $num++) {
                    if (validMove($arr, $row, $col, $num)) {
                        $arr[$row][$col] = $num;
                        if (solve($arr))
                            return true;
                        else
                            $arr[$row][$col] = 0;
                    }
                }
                return false;
            }
        }
    }
    return true;
}

function solveX(&$arr){
    for($row=0;$row<9;$row++) {
        for ($col = 0; $col < 9; $col++) {
            if ($arr[$row][$col] == 0) {
                for ($num = 1; $num <= 9; $num++) {
                    if (validMoveX($arr, $row, $col, $num)) {
                        $arr[$row][$col] = $num;
                        if (solveX($arr))
                            return true;
                        else
                            $arr[$row][$col] = 0;
                    }
                }
                return false;
            }
        }
    }
    return true;
}

function show($arr){
    foreach($arr as $index=>$row) {
        foreach ($row as $ind => $num) {
            print($num . " ");
            if ($ind == 8)
                print("\n");
            else if ($ind == 2 || $ind == 5)
                print("\t");
        }
        if ($index==2||$index==5)
            print("\n");
        }
    print("\n");
}

show($grid);
setField($grid,0,0,8);
setField($grid,0,2,4);
setField($grid,0,3,1);
setField($grid,0,6,6);
setField($grid,1,2,1);
setField($grid,1,7,5);
setField($grid,2,4,5);
setField($grid,2,6,9);
setField($grid,3,1,3);
setField($grid,3,3,5);
setField($grid,3,6,7);
setField($grid,4,2,2);
setField($grid,5,3,7);
setField($grid,5,6,1);
setField($grid,6,1,6);
setField($grid,6,3,2);
setField($grid,7,0,5);
setField($grid,7,3,3);
setField($grid,7,4,4);
setField($grid,7,8,7);
setField($grid,8,0,2);
setField($grid,8,6,5);

show($grid);
solveX($grid);
show($grid);
