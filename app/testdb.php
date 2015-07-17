<?php
$c = mysql_connect('localhost', 'rpgcorne_fluser', 'RootyTootyGetUrFruity!');
mysql_select_db('rpgcorne_flourish');

if ($c)
{
  echo 'connected';
} else {
  echo 'ERROR';
}
