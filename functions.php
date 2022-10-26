<?php
function getAllResults()
{
	global $pdo;
	$sql = 'select count(id) as total from election';
	$handle = $pdo->prepare($sql);
	$handle->execute();
	$count = $handle->fetch(PDO::FETCH_ASSOC);
	return $count['total'];
}
 
function getResultByName($name)
{
	global $pdo;
	$sql = 'select count(id) as total from election where condidate_name = :name ';
	$handle = $pdo->prepare($sql);
	$param = ['name' => $name];
	$handle->execute($param);
	$count = $handle->fetch(PDO::FETCH_ASSOC);
	return $count['total'];
}
 
function getSingleCondidateData($condidateName){
	global $pdo;
	$getAllCount = getAllResults();
	$getCondCount = getResultByName($condidateName);
	$calculate = $getCondCount/$getAllCount * 100;
	return number_format($calculate,2,)."%";
}
 
function ifIPIsExist($ip){
	global $pdo;
	$sql = 'select * from election where user_ip = :ip ';
	$handle = $pdo->prepare($sql);
	$param = ['ip' => $ip];
	$handle->execute($param);
   
	return ($handle->rowCount() > 0) ?? TRUE;
}
?>    