<?php
//���� ����������� � ���� ������

$server = 'localhost';
$username = 'root';
$password = 'ithcnmyfyjce';
$db_name = 'web_test';
error_reporting(0);
//������� ����������� � �������
$connect_srv = mysql_connect ($server,$username,$password);
$use_table = mysql_select_db ($db_name); //������� ������ ������������ ���� ������

mysql_query("SET NAMES utf8"); //������������� ���� ������ � ��������� UTF8

?>