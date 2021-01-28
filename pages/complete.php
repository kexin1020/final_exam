<?php
require_once "datas.php";
?>
<?php

$action = $_POST["action"];
$title = "";
$id = $_GET["id"];
if($action === "entry"){
    isset($_POST["category"])? $category = $_POST["category"]: $category = "";
	isset($_POST["name"])? $name = $_POST["name"]: $name = "";
	isset($_POST["price"])? $price = $_POST["price"]: $price = 0;
	isset($_POST["detail"])? $detail = $_POST["detail"]: $detail = "";
	try{
		$pdo = $pdos;
		$sql = "insert into product(name, price, category, detail) values (:name, :price, :category, :detail)";
	    $data = [];
		$data[":name"] = $name;
		$data[":price"] = $price;
		$data[":category"] = $category;
		$data[":detail"] = $detail;
		$pstmts = $pdo->prepare($sql);
		$pstmts->execute($data);
	} catch (PDOException $e){
		echo $e->getMessage();
		die;
	} finally {
		unset($pstmt);
		unset($pdo);
	}
	$title = "新規商品の追加";
} else if ($action === "update") {
	isset($_POST["category"])? $category = $_POST["category"]: $category = "";
    isset($_POST["name"])? $name = $_POST["name"]: $name = "";
	isset($_POST["price"])? $price = $_POST["price"]: $price = 0;
	isset($_POST["detail"])? $detail = $_POST["detail"]: $detail = "";
	var_dump($id);
    try{
		$pdo = $pdos;
		$sql = "update product set name = :name, price = :price, category = :category, detail = :detail where id = :id";
		$data = [];
		$data[":id"] = $id;
		$data[":name"] = $name;
		$data[":price"] = $price;
		$data[":category"] = $category;
		$data[":detail"] = $detail;
		$pstmts = $pdo->prepare($sql);
		$pstmts->execute($data);
	} catch (PDOException $e){
		echo $e->getMessage();
		die;
	} finally {
		unset($pstmt);
		unset($pdo);
	}
	$title = "ID{$rec["id"]}の商品の更新";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品データベース</title>
	<link rel="stylesheet" href="../assets/css/style.css" />
</head>
<body>
<header>
	<h1>商品データベース</h1>
</header>
<main id="complete">
	<h2>商品の完了</h2>
	<p>処理を完了しました。</p>
	<p><a href="top.php">トップページに戻る</a></p>
</main>
<footer>
	<div id="copyright">&copy; 2021 The Applied Course of Web System Development.</div>
</footer>
</body>
</html>