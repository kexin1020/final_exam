<?php
require_once "datas.php";
?>
<?php
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
<main id="update">
	<h2>商品の更新</h2>
	<p class="note">商品名と価格は<em>必須入力</em>です。</p>
	<?php foreach($records as $rec){?>
	<form class="update">
		<table class="form">
			<tr>
				<th>商品ID</th>
				<td>
					<?= $rec["id"] ?>
					<input type="hidden" name="id" value="<?= $rec["id"] ?>">
				</td>
			</tr>
			<tr>
				<th>カテゴリ</th>
				<td>
					<select name="category">
						<option value="財布・小物入れ" <?php if($rec["category"] === "財布・小物入れ"){ echo "selected"; } ?>>財布・小物入れ</option>
						<option value="食卓用" <?php if($rec["category"] === "食卓用"){ echo "selected"; } ?>>食卓用</option>
						<option value="その他" <?php if($rec["category"] === "その他"){ echo "selected"; } ?>>その他</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>商品名</th>
				<td><input type="text" name="name" value="<?= $rec["name"] ?>"></td>
			</tr>
			<tr>
				<th>価格</th>
				<td><input type="number" name="price" value="<?= $rec["price"] ?>">円</td>
			</tr>
			<tr>
				<th>商品説明</th>
				<td><textarea name="detail" id="" cols="30" rows="3"><?= $rec["detail"] ?></textarea></td>
			</tr>
			<tr class="buttons">
				<td colspan="2">
					<button formaction="confirm.php" formmethod="post" name="action" value="update">確認画面へ</button>
				</td>
			</tr>
		</table>
	</form>
	<?php }	?>
</main>
<footer>
	<div id="copyright">&copy; 2021 The Applied Course of Web System Development.</div>
</footer>
</body>
</html>