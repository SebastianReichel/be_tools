<?php
/*
	Redaxo-Addon Backend-Tools
	Updateprozeduren
	v1.9.0
	by Falko M�ller @ 2018-2024
*/

/** RexStan: Vars vom Check ausschlie�en */
/** @var rex_addon $this */


//Variablen deklarieren
$mypage = $this->getProperty('package');
$error = "";


//Datenbank-Spalten anlegen, sofern noch nicht verf�gbar
rex_sql_table::get(rex::getTable('article_slice'))
	->ensureColumn(new rex_sql_column('bet_slicetimer', 'text'))
    ->alter();
?>