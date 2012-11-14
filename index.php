<?php

function get_brackets_rgxp($br)
{
    $rgxp = '';
    foreach ($br as $b)
    {
      $rgxp .= ($rgxp ? '|' : '')
            .preg_quote($b[0])
            .'[^'.str_replace(array('[',']'),array('\[','\]'),implode($br)).']*'
            .preg_quote($b[1]);
    }
    return '~('.$rgxp.')~Usix';
}

function is_correct_brackets_count($str, $br = array('()', '{}', '<>', '[]'))
{
    $str = '('.$str.')';
    $rgxp = get_brackets_rgxp($br);
    while(preg_match($rgxp, $str, $regs)) $str = preg_replace($rgxp, '', $str);
    return !strlen($str);
}

//---------------------------------------------------------------------


$str = ' 1 + ( 2 * ( 5+6 ) + [ 5*6 - { 2/3 * < 4-8 > } ] )';

echo 'Is correct: '.(is_correct_brackets_count($str) ? 'True' : 'False');

