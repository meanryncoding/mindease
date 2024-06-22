<?php
echo $this->Html->script('qr-code-styling-1-5-0.min.js');
echo $this->Html->css('animate.min');
echo $this->Html->css('jquery.calmosaic.css');
echo $this->Html->script('moment.min.js');
echo $this->Html->script('jquery.calmosaic.min.js');
echo $this->Html->script('https://cdn.jsdelivr.net/npm/apexcharts');
echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js');
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Morphext/2.4.4/morphext.css" integrity="sha256-iwSnUqgAndMlZnwFWAAzto9R/6Un2RBguZEITMb0Olk=" crossorigin="anonymous" />
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<!--Header-->
<div class="row text-body-secondary">
	<div class="col-10">
		<h1 class="my-0 page_title"><?php echo $title; ?></h1>
		<h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
	</div>
	<div class="col-2 text-end">

		<div class="dropdown mx-3 mt-2">
			<a class="btn p-0 border-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				<i class="fa-solid fa-bars text-primary"></i>
			</a>
			<ul class="dropdown-menu">
				<li><a class="dropdown-item" href="#">Action</a></li>
				<li><a class="dropdown-item" href="#">Another action</a></li>
				<li><a class="dropdown-item" href="#">Something else here</a></li>
			</ul>
		</div>

	</div>
</div>
<div class="line mb-4"></div>

<div class="row">
	<div class="col-md-9 border-end">
		<div class="row py-3">
			<div class="col-8 fs-5 fw-medium text-body-secondary">
				Container Statistics
			</div>
			<div class="col-4 text-end">
				<button type="button" class="btn btn-xs btn-outline-warning me-2">View All</button>
				<button type="button" class="btn btn-xs btn-primary">Manage Container</button>

			</div>
		</div>
		<div class="row px-2 mb-4">
			<div class="col-md-3 border rounded-start pt-3 pb-3 bg-body-tertiary">
				<span class="fs-3"><?php echo $total_user; ?> <i class="fa-solid fa-caret-up text-primary"></i></span><br />
				Total Registered Users
			</div>
			<div class="col-md-3 border pt-3 pb-3 bg-body-tertiary">
				<span class="fs-3"><?php echo $total_contact; ?> <i class="fa-solid fa-caret-up text-primary"></i></span><br />
				Total Contacts
			</div>
			<div class="col-md-3 border pt-3 pb-3 bg-body-tertiary">
				<span class="fs-3"><?php echo $total_auditlog; ?> <i class="fa-solid fa-caret-up text-primary"></i></span><br />
				Total Logged Audit
			</div>
			<div class="col-md-3 border rounded-end pt-3 pb-3 bg-body-tertiary">
				<span class="fs-3"><?php echo $total_todo; ?> <i class="fa-solid fa-caret-up text-primary"></i></span><br />
				Total To Do Task
			</div>
		</div>



		<div class="row py-3">
			<div class="col-8 fs-5 fw-medium text-body-secondary">
				Platform Event
			</div>
			<div class="col-4 text-end">
				<button type="button" class="btn btn-xs btn-outline-warning me-2">View All</button>
				<button type="button" class="btn btn-xs btn-primary">Platform</button>

			</div>
		</div>
		<div id="heatmap-4" class="d-none d-sm-block"></div>
		<script>
			var data = [{
				count: 2,
				date: "2024-01-23"
			}, {
				count: 5,
				date: "2024-02-23"
			}];

			$("#heatmap-4").calmosaic(data, {
				//title: "Cuba",
				months: 12,
				lastMonth: 12,
				tooltips: {
					show: true
				},
				legend: {
					show: true,
					align: "right",
					minLabel: "Less",
					maxLabel: "More"
				},
				labels: {
					months: true,
					custom: {
						monthLabels: "MMM" //"MMM 'YY"
					}
				},
			});
		</script>

		<div class="row py-3">
			<div class="col-8 fs-5 fw-medium text-body-secondary">
				Re-CRUD
			</div>
			<div class="col-4 text-end">
				<button type="button" class="btn btn-xs btn-outline-warning me-2"><i class="fa-brands fa-github"></i> Github</button>

			</div>
		</div>
		<div class="card mb-3 bg-body-tertiary">
			<div class="card-body">
				<?= $system_abbr; ?> is a framework that enables the developer to generate comprehensive Create Read Update Delete Search and Report CRUD components using the <?= $system_abbr; ?> generator. The integrated important features in the CRUD operation enable the code automation for generating web application functions such as <span id="js-rotating">create, retrieve, update, delete, search, report, authentication, configurations, contact management, FAQ management</span> and comprehensive form helper features. All you need to do is to set your database, then <?= $system_abbr; ?> them!

				<script src="https://cdnjs.cloudflare.com/ajax/libs/Morphext/2.4.4/morphext.min.js" integrity="sha256-qG3zvg7/f5CZHwV8IeaQfBY5Hm+M0KR3PMk9lAHp39s=" crossorigin="anonymous"></script>
				<script>
					$("#js-rotating").Morphext({
						animation: "fadeInDown",
						complete: function() {
							console.log("This is called after a phrase is animated in! Current phrase index: " + this.index);
						}
					});
				</script>
				<br><br>
				<style>
					.fa-stack {
						font-size: 3em;
					}

					i {
						vertical-align: middle;
					}
				</style>
				<div class="row" align="center">
					<div class="col-md-4">
						<span class="fa-stack" style="vertical-align: top;">
							<i class="far fa-circle fa-stack-2x"></i>
							<i class="fab fa-connectdevelop fa-stack-1x"></i>
						</span>
						<br>RE-CRUD<br>
						Integrated &amp; Multi-features
					</div>
					<div class="col-md-4">
						<span class="fa-stack" style="vertical-align: top;">
							<i class="far fa-circle fa-stack-2x"></i>
							<i class="fas fa-unlock-alt fa-stack-1x"></i>
						</span>
						<br>AUTH READY<br>
						Authentication &amp; Authorization
					</div>
					<div class="col-md-4">
						<span class="fa-stack" style="vertical-align: top;">
							<i class="far fa-circle fa-stack-2x"></i>
							<i class="fas fa-print fa-stack-1x"></i>
						</span>
						<br>ENHANCEMENT<br>
						Form Features Enrichment
					</div>
				</div>
			</div>
		</div>

		<div class="row py-3">
			<div class="col-12 fs-5 fw-medium text-body-secondary">
				Functions
			</div>
		</div>

		<div class="row">
			<div class="col">
				<?php echo $this->Html->link(
					'<div class="col kotak kotak-blue">
			<div class="icon"><i class="fa fa-cog fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Menu</div>
			</div>',
					array('controller' => 'dashboards', 'action' => '#'),
					array('escape' => false)
				); ?>

				<?php echo $this->Html->link(
					'<div class="col kotak kotak-green">
			<div class="icon"><i class="fab fa-staylinked fa-3x"></i></div>
			<div class="nota">Menu</div>
			</div>',
					array('controller' => 'dashboards', 'action' => '#'),
					array('escape' => false)
				); ?>

				<?php echo $this->Html->link(
					'<div class="col kotak kotak-yellow">
			<div class="icon"><i class="far fa-envelope fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Menu</div>
			</div>',
					array('controller' => 'dashboards', 'action' => '#'),
					array('escape' => false)
				); ?>

				<?php echo $this->Html->link(
					'<div class="col kotak kotak-orange">
			<div class="icon"><i class="fas fa-users fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Menu</div>
			</div>',
					array('controller' => 'dashboards', 'action' => '#'),
					array('escape' => false)
				); ?>

				<?php echo $this->Html->link(
					'<div class="col kotak kotak-red">
			<div class="icon"><i class="far fa-user fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Menu</div>
			</div>',
					array('controller' => 'dashboards', 'action' => '#'),
					array('escape' => false)
				); ?>

				<?php echo $this->Html->link(
					'<div class="col kotak kotak-purple">
			<div class="icon"><i class="fa fa-id-badge fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Menu</div>
			</div>',
					array('controller' => 'dashboards', 'action' => '#'),
					array('escape' => false)
				); ?>

				<?php echo $this->Html->link(
					'<div class="col kotak kotak-darkblue">
			<div class="icon"><i class="far fa-keyboard fa-3x"></i></div>
			<div class="nota">Menu</div>
			</div>',
					array('controller' => 'dashboards', 'action' => '#'),
					array('escape' => false)
				); ?>

				<?php echo $this->Html->link(
					'<div class="col kotak kotak-brown">
			<div class="icon"><i class="fas fa-diagnoses fa-3x"></i></div>
			<div class="nota">Menu</div>
			</div>',
					array('controller' => 'dashboards', 'action' => '#'),
					array('escape' => false)
				); ?>

				<?php echo $this->Html->link(
					'<div class="col kotak kotak-emerald">
			<div class="icon"><i class="fab fa-connectdevelop fa-3x"></i></div>
			<div class="nota">Menu</div>
			</div>',
					array('controller' => 'dashboards', 'action' => '#'),
					array('escape' => false)
				); ?>

				<?php echo $this->Html->link(
					'<div class="col kotak kotak-grey">
			<div class="icon"><i class="fa fa-cube fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Menu</div>
			</div>',
					array('controller' => 'dashboards', 'action' => '#'),
					array('escape' => false)
				); ?>

				<?php echo $this->Html->link(
					'<div class="col kotak kotak-pink">
			<div class="icon"><i class="far fa-bookmark fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Menu</div>
			</div>',
					array('controller' => 'dashboards', 'action' => '#'),
					array('escape' => false)
				); ?>

				<?php echo $this->Html->link(
					'<div class="col kotak kotak-amber">
			<div class="icon"><i class="far fa-building fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Menu</div>
			</div>',
					array('controller' => 'dashboards', 'action' => '#'),
					array('escape' => false)
				); ?>

				<?php echo $this->Html->link(
					'<div class="col kotak kotak-lightred">
			<div class="icon"><i class="fa fa-bullhorn fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Menu</div>
			</div>',
					array('controller' => 'dashboards', 'action' => '#'),
					array('escape' => false)
				); ?>

				<?php echo $this->Html->link(
					'<div class="col kotak kotak-lightpurple">
			<div class="icon"><i class="fas fa-ad fa-3x"></i></div>
			<div class="nota">Menu</div>
			</div>',
					array('controller' => 'dashboards', 'action' => '#'),
					array('escape' => false)
				); ?>

				<?php echo $this->Html->link(
					'<div class="col kotak kotak-red">
			<div class="icon"><i class="far fa-comment-alt fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Menu</div>
			</div>',
					array('controller' => 'dashboards', 'action' => '#'),
					array('escape' => false)
				); ?>

			</div>
		</div>



	</div>
	<div class="col-md-3">

		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body text-body-secondary">
				<div class="card-title mb-0">Search</div>
				<div class="tricolor_line mb-3"></div>

			</div>
		</div>

		<div class="card gradient-border mb-3">
			<div class="card-body">
				<div class="card-title mb-0">Search</div>
				<div class="tricolor_line mb-3"></div>

			</div>
		</div>

		<div class="card bg-gold-full fs-5 fw-bold px-3 py-2 mb-3 rounded-0">
			Hello, <?php echo $this->Identity->get('fullname');
					?>,
			<?php
			date_default_timezone_set("Asia/Kuala_Lumpur");
			$h = date('G');

			if ($h >= 5 && $h <= 11) {
				echo "Good morning";
			} else if ($h >= 12 && $h <= 15) {
				echo "Good afternoon";
			} else {
				echo "Good evening";
			}
			?>.
		</div>




		<div class="row py-3">
			<div class="col-8 fs-5 fw-medium text-body-secondary">
				<i class="fa-solid fa-code-commit fa-rotate-90 text-primary"></i> Activity
			</div>
			<div class="col-4 text-end">
				<div class="dropdown">
					<button class="btn btn-xs btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
						Dropdown
					</button>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="#">Action</a></li>
						<li><a class="dropdown-item" href="#">Another action</a></li>
						<li><a class="dropdown-item" href="#">Something else here</a></li>
					</ul>
				</div>

			</div>
		</div>



		<div class="card bg-body-tertiary mb-3">
			<div class="card-body">
				This is some text within a card body.
			</div>
		</div>

		<div class="card text-bg-info">
			<div class="card-body">
				This is some text within a card body.
			</div>
		</div>

		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body text-body-secondary">
				<div class="card-title mb-0">Scan</div>
				<div class="tricolor_line mb-3"></div>

			</div>
		</div>

		<div class="row py-2 pt-5">
			<div class="col-8 fs-5 fw-medium text-body-secondary">
				<i class="fa-solid fa-qrcode text-primary"></i> Scan
			</div>
			<div class="col-4 text-end">
				<button type="button" class="btn btn-primary btn-xs">Small</button>
			</div>
		</div>

		<div class="card border-0">
			<div class="card-body">
				<div id="qr" align="center"></div>
				<script type="text/javascript">
					const qrCode = new QRCodeStyling({
						width: 130,
						height: 130,
						margin: 0,
						//type: "svg",
						data: "<?php echo $this->request->getUri(); ?>",
						dotsOptions: {
							//color: "#4267b2",
							type: "dots"
						},
						cornersSquareOptions: {
							type: "dots",
							color: "#007bff",
						},
						cornersDotOptions: {
							type: "dots"
						},
						backgroundOptions: {
							//color: "#ffffff",
						},
						imageOptions: {
							crossOrigin: "anonymous",
							margin: 20
						}
					});

					qrCode.append(document.getElementById("qr"));
					//qrCode.download({ name: "qr", extension: "png" });
				</script>
			</div>
		</div>

		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body text-body-secondary">
				<div class="card-title mb-0">Useful Links</div>
				<div class="tricolor_line mb-3"></div>
				<div class="table-responsive">
					<table class="table table-sm table-borderless mb-4 table_transparent table-hover">
						<tr>
							<td><i class="far fa-bookmark" style="color: var(--bs-blue);"></i> <?php echo $this->Html->link('Re-CRUD repository', 'https://github.com/Asyraf-wa', ['target' => '_blank', 'class' => 'reference']); ?></td>
						</tr>
						<tr>
							<td><i class="far fa-bookmark" style="color: var(--bs-indigo);"></i> <?php echo $this->Html->link('Code The Pixel - Re-CRUD tutorial', 'https://codethepixel.com', ['target' => '_blank', 'class' => 'reference']); ?></td>
						</tr>
						<tr>
							<td><i class="far fa-bookmark" style="color: var(--bs-purple);"></i> <?php echo $this->Html->link('GetBootstrap - Theme components', 'https://getbootstrap.com', ['target' => '_blank', 'class' => 'reference']); ?></td>
						</tr>
						<tr>
							<td><i class="far fa-bookmark" style="color: var(--bs-pink);"></i> <?php echo $this->Html->link('Font Awesome Icon - Icon collection', 'https://fontawesome.com', ['target' => '_blank', 'class' => 'reference']); ?></td>
						</tr>
						<tr>
							<td><i class="far fa-bookmark" style="color: var(--bs-red);"></i> <?php echo $this->Html->link('Feather Icon - Icon collection', 'https://feathericons.com', ['target' => '_blank', 'class' => 'reference']); ?></td>
						</tr>
						<tr>
							<td><i class="far fa-bookmark" style="color: var(--bs-orange);"></i> <?php echo $this->Html->link('Github - Codes repository', 'https://github.com', ['target' => '_blank', 'class' => 'reference']); ?></td>
						</tr>
						<tr>
							<td><i class="far fa-bookmark" style="color: var(--bs-yellow);"></i> <?php echo $this->Html->link('Composer - Dependecy manager', 'https://getcomposer.org/', ['target' => '_blank', 'class' => 'reference']); ?></td>
						</tr>
						<tr>
							<td><i class="far fa-bookmark" style="color: var(--bs-green);"></i> <?php echo $this->Html->link('ChartJS - Flexible charting library', 'https://www.chartjs.org/', ['target' => '_blank', 'class' => 'reference']); ?></td>
						</tr>
						<tr>
							<td><i class="far fa-bookmark" style="color: var(--bs-teal);"></i> <?php echo $this->Html->link('DataTables', 'https://datatables.net/', ['target' => '_blank', 'class' => 'reference']); ?></td>
						</tr>
						<tr>
							<td><i class="far fa-bookmark" style="color: var(--bs-cyan);"></i> <?php echo $this->Html->link('Google Fonts - Font library', 'https://fonts.google.com/', ['target' => '_blank', 'class' => 'reference']); ?></td>
						</tr>
						<tr>
							<td><i class="far fa-bookmark" style="color: var(--bs-warning);"></i> <?php echo $this->Html->link('Optimizilla - Image optimizer', 'https://imagecompressor.com/', ['target' => '_blank', 'class' => 'reference']); ?></td>
						</tr>
						<tr>
							<td><i class="far fa-bookmark" style="color: var(--bs-danger);"></i> <?php echo $this->Html->link('PHP - Official PHP references', 'https://www.php.net/manual/en/', ['target' => '_blank', 'class' => 'reference']); ?></td>
						</tr>
						<tr>
							<td><i class="far fa-bookmark"></i> <?php echo $this->Html->link('CakePHP', 'https://cakephp.org/', ['target' => '_blank', 'class' => 'reference']); ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>

	</div>
</div>