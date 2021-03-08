<?php
// Projet    :   FaceBook
// Auteur    :   Ludovic Roux
// Desc.     :   Page d'accueil
// Version   :   1.0, 01.02.21, LR, version initiale

require_once(__DIR__ . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "app.inc.php");

$result = getPostsWithMedias(getPosts());

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

									<?= showPosts($result) ?>

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

	<!-- Button trigger modal -->
	<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
		Launch demo modal
	</button> -->

	<!-- Modal -->
	<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div> -->

</body>
<!-- <script>
	$('#myModal').on('shown.bs.modal', function() {
		$('#myInput').trigger('focus')
	})
</script> -->

</html>