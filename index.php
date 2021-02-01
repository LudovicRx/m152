<?php
// Projet    :   FaceBook
// Auteur    :   Ludovic Roux
// Desc.     :   Page d'accueil
// Version   :   1.0, 01.02.21, LR, version initiale
define("MAX_IMG_SIZE", 30000000);

require_once(__DIR__ . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "app.inc.php");

if (filter_input(INPUT_POST, NAME_SUBMIT_POST, FILTER_SANITIZE_STRING)) {
	$commentaire = filter_input(INPUT_POST, NAME_INPUT_COMMENTAIRE, FILTER_SANITIZE_STRING);

	if (insertPost($commentaire)) {
		$idPost = getLastPost();
		if ($idPost) {
			$images = $_FILES[NAME_INPUT_FILE];
			for ($i = 0; $i < count($images['name']); $i++) {
				if (!verifyNameExists($images['name'][$i]) && $images['size'][$i] <= MAX_IMG_SIZE) {
					if (insertMedia($images['type'][$i], $images['name'][$i], $idPost)) {
						$name = basename($images["name"][$i]);
						move_uploaded_file($images['tmp_name'][$i], IMAGE_PATH . $name);
					}
				}
			}
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Facebook</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/facebook.css" rel="stylesheet">
</head>

<body>

	<div class="wrapper">
		<div class="box">
			<div class="row row-offcanvas row-offcanvas-left">

				<!-- main right col -->
				<div class="column col-md-12 col-sm-12" id="main">

					<?php include_once(VIEW_PATH . "topNav.inc.php") ?>

					<div class="padding">
						<div class="full col-sm-9">

							<!-- content -->
							<div class="row">

								<!-- main col left -->
								<div class="col-sm-5">

									<div class="panel panel-default">
										<div class="panel-thumbnail"><img src="assets/img/bg_5.jpg" class="img-responsive"></div>
										<div class="panel-body">
											<p class="lead">Nom du blog</p>
											<p>45 Followers, 13 Posts</p>

											<p>
												<img src="assets/img/uFp_tsTJboUY7kue5XAsGAs28.png" height="28px" width="28px">
											</p>
										</div>
									</div>


									<div class="panel panel-default">
										<div class="panel-heading"><a href="#" class="pull-right">View all</a>
											<h4>Bootstrap Examples</h4>
										</div>
										<div class="panel-body">
											<div class="list-group">
												<a href="http://usebootstrap.com/theme/facebook" class="list-group-item">Modal / Dialog</a>
												<a href="http://usebootstrap.com/theme/facebook" class="list-group-item">Datetime Examples</a>
												<a href="http://usebootstrap.com/theme/facebook" class="list-group-item">Data Grids</a>
											</div>
										</div>
									</div>

									<div class="well">
										<form class="form-horizontal" role="form">
											<h4>What's New</h4>
											<div class="form-group" style="padding:14px;">
												<textarea class="form-control" placeholder="Update your status"></textarea>
											</div>
											<button class="btn btn-primary pull-right" type="button">Post</button>
											<ul class="list-inline">
												<li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li>
												<li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li>
												<li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li>
											</ul>
										</form>
									</div>

									<div class="panel panel-default">
										<div class="panel-heading"><a href="#" class="pull-right">View all</a>
											<h4>More Templates</h4>
										</div>
										<div class="panel-body">
											<img src="assets/img/150x150.gif" class="img-circle pull-right"> <a href="#">Free @Bootply</a>
											<div class="clearfix"></div>
											There a load of new free Bootstrap 3
											ready templates at Bootply. All of these templates are free and don't
											require extensive customization to the Bootstrap baseline.
											<hr>
											<ul class="list-unstyled">
												<li><a href="http://usebootstrap.com/theme/facebook">Dashboard</a></li>
												<li><a href="http://usebootstrap.com/theme/facebook">Darkside</a></li>
												<li><a href="http://usebootstrap.com/theme/facebook">Greenfield</a></li>
											</ul>
										</div>
									</div>

									<div class="panel panel-default">
										<div class="panel-heading">
											<h4>What Is Bootstrap?</h4>
										</div>
										<div class="panel-body">
											Bootstrap is front end frameworkto
											build custom web applications that are fast, responsive &amp; intuitive.
											It consist of CSS and HTML for typography, forms, buttons, tables,
											grids, and navigation along with custom-built jQuery plug-ins and
											support for responsive layouts. With dozens of reusable components for
											navigation, pagination, labels, alerts etc.. </div>
									</div>



								</div>

								<!-- main col right -->
								<div class="col-sm-7">
									<div class="well">
										<h2>Welcome</h2>
									</div>

									<div class="panel panel-default">
										<div class="panel-thumbnail"><img src="assets/img/bg_4.jpg" class="img-responsive"></div>
										<div class="panel-body">
											<p class="lead">Social Good</p>
											<p>1,200 Followers, 83 Posts</p>

											<p>
												<img src="assets/img/photo.jpg" height="28px" width="28px">
												<img src="assets/img/photo.png" height="28px" width="28px">
												<img src="assets/img/photo_002.jpg" height="28px" width="28px">
											</p>
										</div>
									</div>

								</div>
							</div>
							<!--/row-->

							<div class="row">

							</div>

							<div class="row" id="footer">

							</div>

							<?php include_once(VIEW_PATH . "footer.inc.php") ?>


						</div><!-- /col-9 -->
					</div><!-- /padding -->
				</div>
				<!-- /main -->

			</div>
		</div>
	</div>
	<?php include_once(VIEW_PATH . "js.inc.php") ?>


</body>

</html>