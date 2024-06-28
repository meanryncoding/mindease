<?php
echo $this->Html->script('qr-code-styling-1-5-0.min.js');
echo $this->Html->css('animate.min');
echo $this->Html->css('jquery.CalendarHeatmap');
echo $this->Html->script('moment.min.js');
echo $this->Html->script('jquery.CalendarHeatmap.min.js');
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
				<li><?= $this->Html->link(__('<i class="fa-solid fa-arrow-right-from-bracket"></i> Logout'), ['controller' => 'users', 'action' => 'logout'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
			</ul>
		</div>

	</div>
</div>
<div class="line mb-4"></div>

<div class="row">
	<div class="col-md-9 border-end">
		<style>
			/* ACTIVITIES */

			.activities h1 {
				margin: 0 0 20px;
				font-size: 1.4rem;
				font-weight: 700;
			}

			.activity-container {
				display: grid;
				grid-template-columns: repeat(5, 1fr);
				grid-template-rows: repeat(2, 150px);
				column-gap: 10px;
			}

			.img-one {
				grid-area: 1 / 1 / 2 / 2;
			}

			.img-two {
				grid-area: 2 / 1 / 3 / 2;
			}

			.img-three {
				display: block;
				grid-area: 1 / 2 / 3 / 4;
			}

			.img-four {
				grid-area: 1 / 4 / 2 / 5;
			}

			.img-five {
				grid-area: 1 / 5 / 2 / 6;
			}

			.img-six {
				display: block;
				grid-area: 2 / 4 / 3 / 6;
			}

			.image-container {
				position: relative;
				margin-bottom: 10px;
				box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 3px;
				border-radius: 10px;
			}

			.image-container img {
				width: 100%;
				height: 100%;
				border-radius: 10px;
				object-fit: cover;
			}

			.overlay {
				position: absolute;
				display: flex;
				flex-direction: column;
				align-items: flex-end;
				justify-content: flex-end;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background: linear-gradient(180deg,
						transparent,
						transparent,
						rgba(3, 3, 185, 0.5));
				border-radius: 10px;
				transition: all 0.6s linear;
			}

			.image-container:hover .overlay {
				opacity: 0;
			}

			.overlay h3 {
				margin-bottom: 8px;
				margin-right: 10px;
				color: #fff;
			}

			/* LEFT BOTTOM */

			.left-bottom {
				display: grid;
				grid-template-columns: 55% 40%;
				gap: 40px;
			}

			a.header:link {
				color: #ffffff;
				text-decoration: none;
			}

			a.header:visited {
				color: #ffffff;
				text-decoration: none;
			}

			a.header:hover {
				color: #ffffff;
				text-decoration: none;
			}
		</style>


		<div class="d-none d-sm-block">
			<div class="activity-container">
				<div class="image-container img-one">
					<img src="https://compote.slate.com/images/17bdccdd-d8c9-44e6-b7f8-96f03ca50b33.jpeg?crop=1560%2C1040%2Cx0%2Cy0&width=1200" alt="code the pixel">
					<div class="overlay">
						<h3><a href="https://codethepixel.com/" class="stretched-link header" target="_blank"><b class="logo-small">&lt;/&gt;</b></a></h3>
					</div>
				</div>
				<div class="image-container img-two">
					<img src="https://realhousemoms.com/wp-content/uploads/Red-Velvet-Cake-Recipe-RECIPE-CARD-500x500.jpg" alt="cakephp">
					<div class="overlay">
						<h3><a href="https://cakephp.org/" class="stretched-link header">CakePHP</a></h3>
					</div>
				</div>
				<div class="image-container img-three">
					<img src="https://t4.ftcdn.net/jpg/06/42/16/69/360_F_642166904_nc1NJWECzIQraDZU60DbdoT5eLy1OPPb.jpg" alt="recrud">
					<div class="overlay">
						<h3><a href="#" class="stretched-link header">ReCRUD</a></h3>
					</div>
				</div>
				<div class="image-container img-four">
					<img src="https://github.blog/wp-content/uploads/2023/01/1200x640-2.png?fit=1200%2C640" alt="github">
					<div class="overlay">
						<h3><a href="#" class="stretched-link header">Github</a></h3>
					</div>
				</div>
				<div class="image-container img-five">
					<img src="https://cff2.earth.com/uploads/2023/11/02172105/black-hole_supermassive_1medium.jpg" alt="crud">
					<div class="overlay">
						<h3><a href="#" class="stretched-link header">???</a></h3>
					</div>
				</div>
				<div class="image-container img-six">
					<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZ7I0FxW09VD2Rza0XNrlU19uYwmoTPt0ZOw&s" alt="bootstrap">
					<div class="overlay">
						<h3><a href="#" class="stretched-link header">Bootstrap</a></h3>
					</div>
				</div>
			</div>
		</div>



		<div class="row py-3">
			<div class="col-8 fs-5 fw-medium text-body-secondary">
				Report
			</div>
			<div class="col-4 text-end">
				<button class="btn btn-xs btn-outline-warning me-2" data-bs-toggle="collapse" href="#chartCollapse" role="button" aria-expanded="true" aria-controls="chartCollapse">
					Hide Chart
				</button>
				<button onClick="window.location.reload();" class="btn btn-xs btn-primary">Refresh</button>

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

		<div class="collapse show" id="chartCollapse">
			<div class="row mb-4">
				<div class="col-md-3 ps-5">
					<div class="users" data-waffly-title="Total Active Users" data-waffly-value="<?php echo $user_percent; ?>%">
						<div class="title">Total Active Users</div>
						<meter class="users" value="50" max="100"></meter>
					</div>
				</div>
				<div class="col-md-3 ps-5">
					<div class="todo" data-waffly-title="Total Pending To Do Task" data-waffly-value="<?php echo $pending_todo_percent; ?>%">
						<div class="title">Total Pending To Do Task</div>
						<meter class="todo" value="50" max="100"></meter>
					</div>
				</div>
				<div class="col-md-3 ps-5">
					<div class="contact" data-waffly-title="Total Pending Contact" data-waffly-value="<?php echo $pending_contact_percent; ?>%">
						<div class="title">Total Pending Contact</div>
						<meter class="contact" value="50" max="100"></meter>
					</div>
				</div>
				<div class="col-md-3 ps-5">
					<div class="faq" data-waffly-title="Total Active FAQ" data-waffly-value="<?php echo $pending_faq_percent; ?>%">
						<div class="title">Total Active FAQ</div>
						<meter class="faq" value="50" max="100"></meter>
					</div>
				</div>
			</div>




			<?php echo $this->Html->script('waffly.js'); ?>
			<script>
				$(document).ready(function() {
					$('.users').waffly({
						graph_width: 200,
						dot_gap: 3,
						dot_radius: '3px',
						graph_color: '#e9c46a',
						//graph_title_color: '#555',
						graph_value_color: '#e9c46a',
						dot_opacity: .2,
						graph_reverse: true,
						graph_animate: true,
					});

					$('.todo').waffly({
						graph_width: 200,
						dot_gap: 3,
						dot_radius: '3px',
						graph_color: '#c8b6ff',
						//graph_title_color: '#555',
						graph_value_color: '#c8b6ff',
						dot_opacity: .2,
						graph_reverse: true,
						graph_animate: true,
					});

					$('.contact').waffly({
						graph_width: 200,
						dot_gap: 3,
						dot_radius: '3px',
						graph_color: '#ffafcc',
						//graph_title_color: '#555',
						graph_value_color: '#ffafcc',
						dot_opacity: .2,
						graph_reverse: true,
						graph_animate: true,
					});

					$('.faq').waffly({
						graph_width: 200,
						dot_gap: 3,
						dot_radius: '3px',
						graph_color: '#a2d2ff',
						//graph_title_color: '#555',
						graph_value_color: '#a2d2ff',
						dot_opacity: .2,
						graph_reverse: true,
						graph_animate: true,
					});

					$('.my_chart').waffly({
						graph_reverse: false,
						graph_animate: true,
						style_override: true,
						total_dots: 62,
					});
				});
			</script>
		</div>


		<?php //echo json_encode($formattedResults); 
		?>

		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<div class="card-title mb-0">Activities</div>
				<div class="tricolor_line mb-4"></div>
				<div id="heatmap-1"></div>
			</div>
		</div>

		<script>
			var data = <?php echo json_encode($formattedResults); ?>;
			$("#heatmap-1").CalendarHeatmap(data, {
				title: null,
				months: 12,
				//weekStartDay: 1,
				//lastMonth: 1,
				//lastMonth: "current month",
				//lastYear: "current year",
				labels: {
					days: true,
					months: true,
					custom: {
						weekDayLabels: null,
						monthLabels: null
					}
				},
				tiles: {
					shape: "square"
				},
				legend: {
					show: true,
					align: "right",
					minLabel: "Less",
					maxLabel: "More",
					divider: " to "
				},
				tooltips: {
					show: false,
					options: {}
				}
			});
		</script>

		<?php //echo json_encode($totalActivityByMonth); 
		?>
		<?php
		// Decode the JSON data
		$totalActivityByMonth = json_encode($totalActivityByMonth);
		$dataArray = json_decode($totalActivityByMonth, true);

		// Create an array to hold the formatted results
		$formattedArray = [];

		// Loop through the data array and add the month and count to the formatted array
		foreach ($dataArray as $entry) {
			//$formattedArray[] = $entry['month'];
			$formattedArray[] = $entry['count'];
		}
		$formattedJson = json_encode($formattedArray);
		//echo $formattedJson;


		$formattedMonthArray = [];

		// Loop through the data array and add the month and count to the formatted array
		foreach ($dataArray as $entry) {
			//$formattedArray[] = $entry['month'];
			$formattedMonthArray[] = $entry['month'];
		}
		$formattedMonthJson = json_encode($formattedMonthArray);
		//echo $formattedMonthJson;
		?>

		<div class="row mb-4">
			<div class="col-md-4">
				<div id="chart_line"></div>
				<script>
					var options = {
						chart: {
							type: 'line',
							toolbar: {
								show: false
							},
						},
						stroke: {
							curve: 'stepline',
						},
						series: [{
							name: 'sales',
							data: [35, 45, 55, 20, 11, 42, 32, 64, 64, 64, 50, 35]
						}],
						xaxis: {
							categories: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
							min: 0,
							max: 13
						},
						yaxis: {
							min: 0
						},
						markers: {
							size: 1,
						},
						fill: {
							type: 'solid'
						}
					}

					var chart = new ApexCharts(document.querySelector("#chart_line"), options);

					chart.render();
				</script>
			</div>
			<div class="col-md-4">
				<div id="chart_bar"></div>
				<script>
					var options = {
						chart: {
							type: 'bar',
							toolbar: {
								show: false
							},
						},
						stroke: {
							curve: 'stepline',
						},
						series: [{
							data: <?php echo $formattedJson; ?>
						}],
						xaxis: {
							categories: <?php echo $formattedMonthJson; ?>,
						},
						yaxis: {
							min: 0
						},
						markers: {
							size: 1,
						},
						fill: {
							type: 'solid'
						}
					}

					var chart = new ApexCharts(document.querySelector("#chart_bar"), options);

					chart.render();
				</script>
			</div>
			<div class="col-md-4">
				<div id="chart_tree"></div>
				<script>
					var options = {
						series: [{
							name: "Desktops",
							data: [10, 41, 35, 51, 49, 62, 69, 91, 100]
						}],
						chart: {
							type: 'line',
							zoom: {
								enabled: false
							},
							toolbar: {
								show: false
							},
						},
						dataLabels: {
							enabled: false
						},
						stroke: {
							curve: 'straight'
						},
						grid: {
							row: {
								colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
								opacity: 0.5
							},
						},
						xaxis: {
							categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
						}
					};

					var chart = new ApexCharts(document.querySelector("#chart"), options);
					chart.render();


					window.setInterval(function() {
						getNewSeries(lastDate, {
							min: 10,
							max: 90
						})

						chart.updateSeries([{
							data: data
						}])
					}, 1000)

					var chart = new ApexCharts(document.querySelector("#chart_tree"), options);

					chart.render();
				</script>
			</div>
		</div>

		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body text-body-secondary">
				<div class="card-title mb-0">
					<div class="row py-3">
						<div class="col-8 text-body-secondary">
							Re-CRUD
						</div>
						<div class="col-4 text-end">
							<?= $this->Html->link(
								'<i class="fa-brands fa-github"></i> Github',
								'https://github.com/Asyraf-wa/recrud',
								['class' => 'btn btn-xs btn-outline-warning me-2', 'escapeTitle' => false, 'target' => '_blank', '_full' => true]
							) ?>
						</div>
					</div>
				</div>
				<div class="tricolor_line mb-3"></div>
				<?= $system_abbr; ?> allows developers to construct complete Create Read Update Delete Search and Report CRUD components using the <?= $system_abbr; ?> generator. The integrated features in the <?= $system_abbr; ?> operation enable the code automation for generating web application functions such as <span id="js-rotating">create, retrieve, update, delete, search, report, authentication, configurations, contact management, FAQ management</span> and comprehensive form helper features. All you need to do is to set your database, then <?= $system_abbr; ?> them!

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
				<div class="card-title mb-0">Profile</div>
				<div class="tricolor_line mb-3"></div>
				<div class="row">
					<div class="col-5 text-center">
						<?php if ($this->Identity->get('avatar') != NULL) {
							echo $this->Html->image('../files/Users/avatar/' . $this->Identity->get('slug') . '/' . $this->Identity->get('avatar'), ['class' => 'w-px-40 rounded', 'width' => '100px', 'height' => '100px']);
						} else
							echo $this->Html->image('avatar_default.png', ['alt' => 'avatar', 'class' => 'w-px-40 h-auto rounded', 'width' => '100px', 'height' => '100px']); ?>
					</div>
					<div class="col-7">
						<?php echo $this->Identity->get('fullname'); ?>
						<br />
						<?php if ($this->Identity->get('user_group_id') == 1) {
							echo 'Administrator';
						} elseif ($this->Identity->get('user_group_id') == 2) {
							echo 'Moderator';
						} elseif ($this->Identity->get('user_group_id') == 3) {
							echo 'User';
						} else
							echo 'Error';
						?>
						<br />
						<div class="mt-4 text-end">
							<a class="btn btn-outline-warning btn-xs" data-bs-toggle="collapse" href="#collapseActivity" role="button" aria-expanded="false" aria-controls="collapseActivity">
								Account Activity
							</a>
						</div>


					</div>

					<br /><br />

				</div>
				<div class="collapse" id="collapseActivity">
					<div class="table-responsive">
						<table class="table table-sm table-border mb-0 table_transparent table-hover">
							<tr>
								<th>Action</th>
								<th>Date/Time</th>
							</tr>
							<?php foreach ($userLogs as $userLog) : ?>
								<tr>
									<td>
										<?php if ($userLog->action == 'Login') {
											echo '<span class="badge bg-success">Login</span>';
										} elseif ($userLog->action == 'Logout') {
											echo '<span class="badge bg-danger">Logout</span>';
										} else
											echo '<span class="badge bg-secondary">Error</span>';
										?>
									</td>
									<td><?php echo date('M d, Y (h:i A)', strtotime($userLog->created)); ?></td>
								</tr>
							<?php endforeach; ?>
						</table>
					</div>
				</div>

			</div>
		</div>

		<div class="row">
			<div class="col-6 pe-1 pb-2">
				<div class="card bg-body-tertiary border-0 shadow">
					<div class="card-body text-body-secondary">

					</div>
				</div>
			</div>
			<div class="col-6 ps-1 pb-2">
				<div class="card bg-body-tertiary border-0 shadow">
					<div class="card-body text-body-secondary">

					</div>
				</div>
			</div>
			<div class="col-6 pe-1">
				<div class="card bg-body-tertiary border-0 shadow mb-4">
					<div class="card-body text-body-secondary">

					</div>
				</div>
			</div>
			<div class="col-6 ps-1">
				<div class="card bg-body-tertiary border-0 shadow mb-4">
					<div class="card-body text-body-secondary">

					</div>
				</div>
			</div>
		</div>

		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<a href="https://github.com/Asyraf-wa" class="follow-me" target="_blank">
				<span class="follow-text">
					<svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M28.7444 60.1431C28.7444 60.416 28.429 60.6344 28.0315 60.6344C27.579 60.6754 27.2637 60.457 27.2637 60.1431C27.2637 59.8702 27.579 59.6518 27.9766 59.6518C28.3879 59.6109 28.7444 59.8292 28.7444 60.1431ZM24.4806 59.529C24.3847 59.8019 24.6589 60.1158 25.0702 60.1977C25.4266 60.3342 25.8379 60.1977 25.9202 59.9247C26.0024 59.6518 25.7419 59.3379 25.3306 59.2151C24.9742 59.1195 24.5766 59.256 24.4806 59.529ZM30.5403 59.297C30.1427 59.3925 29.8685 59.6518 29.9097 59.9657C29.9508 60.2386 30.3073 60.4161 30.7185 60.3205C31.1161 60.225 31.3903 59.9657 31.3492 59.6927C31.3081 59.4334 30.9379 59.256 30.5403 59.297ZM39.5613 7C20.546 7 6 21.3707 6 40.2997C6 55.4347 15.5694 68.3862 29.2379 72.9444C30.9927 73.2583 31.6097 72.1801 31.6097 71.2931C31.6097 70.4469 31.5685 65.7795 31.5685 62.9135C31.5685 62.9135 21.9718 64.9606 19.9565 58.8466C19.9565 58.8466 18.3935 54.8752 16.1452 53.8516C16.1452 53.8516 13.0056 51.709 16.3645 51.7499C16.3645 51.7499 19.7782 52.0229 21.6565 55.271C24.6589 60.5389 29.6903 59.024 31.6508 58.1233C31.9661 55.9397 32.8573 54.4248 33.8444 53.5241C26.1806 52.678 18.4484 51.5725 18.4484 38.4437C18.4484 34.6906 19.4903 32.8073 21.6839 30.4053C21.3274 29.5183 20.1621 25.8608 22.0403 21.1387C24.9056 20.2517 31.5 24.8235 31.5 24.8235C34.2419 24.0593 37.1895 23.6635 40.1097 23.6635C43.0298 23.6635 45.9774 24.0593 48.7194 24.8235C48.7194 24.8235 55.3137 20.238 58.179 21.1387C60.0573 25.8744 58.8919 29.5183 58.5355 30.4053C60.729 32.8209 62.0726 34.7043 62.0726 38.4437C62.0726 51.6135 53.9976 52.6643 46.3339 53.5241C47.5952 54.6022 48.6645 56.6494 48.6645 59.8565C48.6645 64.4557 48.6234 70.1467 48.6234 71.2658C48.6234 72.1528 49.254 73.231 50.9952 72.9171C64.7048 68.3862 74 55.4347 74 40.2997C74 21.3707 58.5766 7 39.5613 7ZM19.3258 54.07C19.1476 54.2065 19.1887 54.5204 19.4218 54.7797C19.6411 54.998 19.9565 55.0936 20.1347 54.9161C20.3129 54.7797 20.2718 54.4658 20.0387 54.2065C19.8194 53.9881 19.504 53.8926 19.3258 54.07ZM17.8452 52.9646C17.7492 53.142 17.8863 53.3603 18.1605 53.4968C18.3798 53.6333 18.654 53.5923 18.75 53.4013C18.846 53.2239 18.7089 53.0055 18.4347 52.869C18.1605 52.7871 17.9411 52.8281 17.8452 52.9646ZM22.2871 57.823C22.0677 58.0005 22.15 58.4099 22.4653 58.6692C22.7806 58.9831 23.1782 59.024 23.3565 58.8057C23.5347 58.6282 23.4524 58.2188 23.1782 57.9595C22.8766 57.6456 22.4653 57.6047 22.2871 57.823ZM20.7242 55.8169C20.5048 55.9533 20.5048 56.3082 20.7242 56.6221C20.9435 56.936 21.3137 57.0724 21.4919 56.936C21.7113 56.7585 21.7113 56.4037 21.4919 56.0898C21.3 55.7759 20.9435 55.6395 20.7242 55.8169Z" fill="#C2CCDE" />
					</svg>
					Follow me on Github
				</span>
				<span class="developer">
					<?php if ($this->Identity->get('avatar') != NULL) {
						echo $this->Html->image('../files/Users/avatar/' . $this->Identity->get('slug') . '/' . $this->Identity->get('avatar'), ['class' => 'w-px-40 rounded-circle', 'width' => '100px', 'height' => '100px']);
					} else
						echo $this->Html->image('avatar_default.png', ['alt' => 'avatar', 'class' => 'w-px-40 h-auto rounded-circle', 'width' => '100px', 'height' => '100px']); ?>
					Asyraf-wa
				</span>
			</a>
		</div>

		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<div class="row">
					<div class="col-2 mt-1">
						<svg width="40" height="40" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M12 16C12 13.7909 13.7909 12 16 12H32C34.2091 12 36 13.7909 36 16V32C36 34.2091 34.2091 36 32 36H16C13.7909 36 12 34.2091 12 32V16Z" stroke="#C2CCDE" stroke-linecap="round" />
							<path d="M44 16C44 13.7909 45.7909 12 48 12H64C66.2091 12 68 13.7909 68 16V32C68 34.2091 66.2091 36 64 36H48C45.7909 36 44 34.2091 44 32V16Z" stroke="#C2CCDE" stroke-linecap="round" />
							<path d="M12 48C12 45.7909 13.7909 44 16 44H32C34.2091 44 36 45.7909 36 48V64C36 66.2091 34.2091 68 32 68H16C13.7909 68 12 66.2091 12 64V48Z" stroke="#C2CCDE" stroke-linecap="round" />
							<path d="M44 48C44 45.7909 45.7909 44 48 44H64C66.2091 44 68 45.7909 68 48V64C68 66.2091 66.2091 68 64 68H48C45.7909 68 44 66.2091 44 64V48Z" stroke="#C2CCDE" stroke-linecap="round" />
						</svg>
					</div>
					<div class="col-10">
						<div class="article-title mt-1">CakePHP 4 Soft Delete</div>A soft delete marks a record as no longer active or valid without deleting it from the database.
					</div>
				</div>
			</div>
		</div>


		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body text-body-secondary">
				<div class="card-title mb-0">Search</div>
				<div class="tricolor_line mb-3"></div>
				<?php if ($this->Identity->get('avatar') != NULL) {
					echo $this->Html->image('../files/Users/avatar/' . $this->Identity->get('slug') . '/' . $this->Identity->get('avatar'), ['class' => 'w-px-40 rounded-circle', 'width' => '40px', 'height' => '40px']);
				} else
					echo $this->Html->image('avatar_default.png', ['alt' => 'avatar', 'class' => 'w-px-40 h-auto rounded-circle', 'width' => '40px', 'height' => '40px']); ?>
				<b>Logged as:</b> <?php echo $this->Identity->get('fullname'); ?> |
				<b>Last login:</b> <?php echo date('M d, Y (h:i A)', strtotime($this->Identity->get('last_login'))); ?> |
				<b>Role:</b>
				<?php if ($this->Identity->get('user_group_id') == 1) {
					echo 'Administrator';
				} elseif ($this->Identity->get('user_group_id') == 2) {
					echo 'Moderator';
				} elseif ($this->Identity->get('user_group_id') == 3) {
					echo 'User';
				} else
					echo 'Error';
				?>
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

		<div class="card text-bg-info mb-4">
			<div class="card-body">
				This is some text within a card body.
			</div>
		</div>

		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body text-body-secondary">
				<div class="row">
					<div class="col-8">
						<div class="card-title mb-0">Scan</div>
					</div>
					<div class="col-4 text-end">
						<button type="button" class="btn btn-xs btn-outline-secondary">QR Code</button>
					</div>
				</div>
				<div class="tricolor_line mb-3"></div>
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