<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>เงื่อนไขการสร้างหนังสือ</title>
<meta name="description" content="Nifty Modal Window Effects with CSS Transitions and Animations" />
<meta name="keywords" content="modal, window, overlay, modern, box, css transition, css animation, effect, 3d, perspective" />
<meta name="author" content="Codrops" />
<link rel="shortcut icon" href="../favicon.ico">
<link rel="stylesheet" type="text/css" href="cssCon/default.css" />
<link rel="stylesheet" type="text/css" href="cssCon/component.css" />
<script src="jsCon/modernizr.custom.js"></script>
</head>
<body>
<!-- All modals added here for the demo. You would of course just have one, dynamically created -->

<div class="md-modal md-effect-1" id="modal-1">
<div class="md-content">

		<h3>Modal Dialog</h3>
		<div>
		<p>This is a modal window. You can do the following things with it:</p>
		<ul>
		<li><strong>Read:</strong> modal windows will probably tell you something important so don't forget to read what they say.</li>
						<li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and appreciate its presence.</li>
						<li><strong>Close:</strong> click on the button below to close the modal.</li>
					</ul>
					<button class="md-close">Close me!</button>
				</div>
			</div>
		</div>
		
		
			<button class="md-trigger" data-modal="modal-1">condition</button>							
								
										<div class="md-overlay"></div><!-- the overlay element -->

										<!-- classie.js by @desandro: https://github.com/desandro/classie -->
										<script src="jsCon/classie.js"></script>
										<script src="jsCon/modalEffects.js"></script>

										<!-- for the blur effect -->
										<!-- by @derSchepp https://github.com/Schepp/CSS-Filters-Polyfill -->
										<script>
										// this is important for IEs
			var polyfilter_scriptpath = '/jsCon/';
		</script>
		<script src="jsCon/cssParser.js"></script>
		<script src="jsCon/css-filters-polyfill.js"></script>
	</body>

</html>