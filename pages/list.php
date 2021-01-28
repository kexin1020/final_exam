<?php
require_once "datas.php";

try{
    $pdo = $pdos;
    $sql = "select * from product";
    $pstmts = $pdo->prepare($sql);
    $pstmts->execute();
    $records = $pstmts->fetchAll(PDO::FETCH_ASSOC);
}catch (PDOException $e){
	echo $e->getMessage();
	die;
} finally {
	unset($pstmt);
	unset($pdo);
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
<main id="list">
	<h2>商品一覧</h2>
	<table class="list">
		<tr>
			<th>商品ID</th>
			<th>カテゴリ</th>
			<th>商品名</th>
			<th>価格</th>
			<th></th>
		</tr>
		<?php foreach($records as $rec){?>
		<tr>
			<td><?= $rec["id"] ?></td>
			<td><?= $rec["category"] ?></td>
			<td><?= $rec["name"] ?></td>
			<td>&yen;<?= $rec["price"] ?></td>
			<td class="buttons">
				<form name="inputs">
					<input type="hidden" name="id" value="" />
					<button formaction="update.php?id=<?= $rec["id"] ?>" formmethod="post" name="action" value="update">更新</button>
					<button formaction="confirm.php?id=<?= $rec["id"] ?>" formmethod="post" name="action" value="delete">削除</button>
				</form>
			</td>
		</tr>
	    <?php }	?>
	</table>
</main>
<footer>
	<div id="copyright">&copy; 2021 The Applied Course of Web System Development.</div>
</footer>
</body>
</html>