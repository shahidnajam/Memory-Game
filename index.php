<?php

	$maxNumberOfImages = 35;
	
	$cols = 0;
	$rows = 0;
	$numberOfImages = 0;
	$images = array();
	
	if( isset($_GET['i']) && isset($_GET['c']) && isset($_GET['r']) ) {
		$numberOfImages = floor(intval($_GET['i'])/2);
		$cols = intval($_GET['c']);
		$rows = intval($_GET['r']);
		while( count($images)<$numberOfImages ) {
			$rand = rand(1,$maxNumberOfImages);
			if( !in_array($rand,$images) )
				array_push( $images, $rand );
		}
		$images = array_merge($images,$images);
		shuffle($images);
	}

?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Memory</title>
	<meta name="author" content="Simon Lepel">
	<link rel="stylesheet" href="css/memory.css" />
	<link rel="stylesheet" href="css/ui-lightness/jquery-ui.css" />
	<script src="js/jquery.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/memory.js"></script>
</head>
<body>
<?php
	if( !empty($images) ) {
		echo '<div class="memory">';
		for( $c=0; $c<$cols; $c++ ) {
			echo '<ul>';
			for( $r=0; $r<$rows; $r++ ) {
				$i = $c*$rows+$r;
				if( isset($images[$i]) )
					echo '<li><div><img src="images/'.$images[$i].'.png"/></div></li>';
			}
			echo '</ul>';
		}
		echo '<br class="clear" />'
			.'<p>Pairs found: <span id="s">0</span> of '.$numberOfImages.'</p>'
			.'<p>Attempts: <span id="a">0</span></p>'
			.'<p>Time elapsed: <span id="t">0</span></p>'
			.'</div>';
	}
	else {
?>
	<form class="memory" action="" method="get">
		<fieldset>
			<p>
				<label for="i">Cards:</label>
				<span id="iV">36</span>
				<div id="iSlider"></div>
			</p><p>
				<label for="c">Cols:</label>
				<span id="cV">6</span>
			</p><p>
				<label for="r">Rows:</label>
				<span id="rV">6</span>
			</p><p class="buttons">
				<input type="hidden" id="i" name="i" value="36" />
				<input type="hidden" id="c" name="c" value="6" />
				<input type="hidden" id="r" name="r" value="6" />
				<input class="ui-button" type="submit" value="Start game" />
			</p>
		</fieldset>
	</form>
<?php
	}
?>
</body>
</html>
