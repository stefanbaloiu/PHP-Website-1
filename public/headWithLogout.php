<?php
require 'databaseLogin.php';

$stmt = $pdo->prepare('SELECT * FROM category');

$stmt->execute();

$cat=$stmt->fetchAll();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>ibuy Auctions</title>
		<link rel="stylesheet" href="ibuy.css" />
	</head>

	<body>
		<header>
			<h1><span class="i">i</span><span class="b">b</span><span class="u">u</span><span class="y">y</span></h1>

			<form action="#">
				<input type="text" name="search" placeholder="Search for anything" />
				<input type="submit" name="submit" value="Search" />
			</form>
		</header>

		<nav>
			<ul>
			<?php
				for($i=0;$i<count($cat);$i++){
				?>
				<li><a class="categoryLink" href="categories.php?id=<?php echo $cat[$i]['id'] ?>"><?php echo $cat[$i]['name'] ?></a></li>
				<?php
				}
				?>
				<li><a class="categoryLink" href="logout.php">Logout</a></li>
			</ul>
		</nav>

		<img src="banners/1.jpg" alt="Banner" />

		<main>