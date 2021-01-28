<?php
require_once "datas.php";
?>
<?php
$action = $_REQUEST["action"];
$title = "";
if($action === "entry" or $action === "update"){
	isset($_POST["id"])? $id = $_POST["id"]: $id = 0;
	isset($_POST["category"])? $category = $_POST["category"]: $category = "";
	isset($_POST["name"])? $name = $_POST["name"]: $name = "";
	isset($_POST["price"])? $price = $_POST["price"]: $price = 0;
	isset($_POST["detail"])? $detail = $_POST["detail"]: $detail = "";
}else if($action === "delete"){
    isset($_GET["id"])? $id = $_GET["id"]: $id = 0;
    try{
        $pdo = $pdos;
        $sql = "select * from product where id = ?";
        $pstmts = $pdo->prepare($sql);
        $pstmts->bindValue(1, $id);
        $pstmts->execute();
        $records = $pstmts->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e){
    	echo $e->getMessage();
    	die;
    } finally {
    	unset($pstmt);
    	unset($pdo);
    }
}
session_start();
$_SESSION["rec"] = $rec;
if($action === "entry"){$title = "登録";}
if($action === "update"){$title = "更新";}
if($action === "delete"){$title = "削除";}
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
<main id="confirm">
	<h2>商品の確認</h2>
	<p>以下の情報で<?= $title ?>します。</p>
	<?php if($action === "update" or $action === "entry"){?>
	<table class="form">
		<tr>
			<th>商品ID</th>
			<td><?= $id ?></td>
		</tr>
		<tr>
			<th>カテゴリ</th>
			<td><?= $category ?></td>
		</tr>
		<tr>
			<th>商品名</th>
			<td><?= $name ?></td>
		</tr>
		<tr>
			<th>価格</th>
			<td><?= $price ?></td>
		</tr>
		<tr>
			<th>商品説明</th>
			<td><?= $detail ?></td>
		</tr>
		<tr class="buttons">
			<td colspan="2">
				<form name="inputs">
					<button formaction="complete.php" formmethod="post" name="action" value="<?= $action ?>"><?= $title ?>する</button>
				</form>
			</td>
		</tr>
	</table>
	<?php } else if($action === "delete"){?>
	<?php foreach($records as $rec){?>
	<table class="form">
		<tr>
			<th>商品ID</th>
			<td><?= $rec["id"] ?></td>
		</tr>
		<tr>
			<th>カテゴリ</th>
			<td><?= $rec["category"] ?></td>
		</tr>
		<tr>
			<th>商品名</th>
			<td><?= $rec["name"] ?></td>
		</tr>
		<tr>
			<th>価格</th>
			<td><?= $rec["price"] ?></td>
		</tr>
		<tr>
			<th>商品説明</th>
			<td><?= $rec["detail"] ?></td>
		</tr>
		<tr class="buttons">
			<td colspan="2">
				<form name="inputs">
					<button formaction="complete.php" formmethod="post" name="action" value="<?= $action ?>"><?= $title ?>する</button>
				</form>
			</td>
		</tr>
	</table>
	<?php }	?>
	<?php }	?>
</main>
<footer>
	<div id="copyright">&copy; 2021 The Applied Course of Web System Development.</div>
</footer>
</body>
</html>