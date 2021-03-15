<?php

$next_launches = json_decode(file_get_contents("https://fdo.rocketlaunch.live/json/launches/next/5"));
$launch = $next_launches->result[0];

echo '
	<html>
		<head>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			<style>
				@import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap");
				@font-face {
					font-family: count;
					src: url(numeral.ttf);
				}
				* {
					color: white;
					font-family: "Montserrat", sans-serif;
				}
				body {
					background-color: black;
				}
				.numberdisplay {
					border: 1px solid gray;
					display: inline-block;
					padding: 10px;
					font-size: 20vh;
				}
				.ctdown {
					font-family: count;
					color: red;
				}
				h1, h2 {
					padding: 0;
					margin: 0;
				}
				h1 {
					font-size: 10vh;
				}
				h2 {
					font-size: 5vh;
				}
				td { 
				    padding: 0px 10px;
					font-size: 3vh;
				}
			</style>
		</head>
		<body>
			<h1>' . $launch->name . '</h1>
			<h2>' . $launch->provider->name . ' ' . $launch->vehicle->name . '</h2><br>
			<h2>' . $launch->pad->location->name . ' ' . $launch->pad->name . '</h2><br>';
if (isset($launch->t0) || isset($launch->win_open)) {
	echo '<div class="numberdisplay ctdown" id="ctdown">--:--:--:--</div><br>';
} else {
	echo '<div class="numberdisplay">' . date('M d', strtotime($launch->date_str . ' ' . date("Y"))) . '' . '</div><br>';
}

echo '			<hr>
			<table>';
			
$i = 0;
foreach ($next_launches->result as $future_launch) {
	if ($i == 0) { $i++; continue;  }
	echo "<tr><td>" . $future_launch->name . "</td><td>" . $future_launch->provider->name . " " . $future_launch->vehicle->name . "</td><td><span id='ctdown" . $i . "'></span></td></tr>";
	$i++;
}

echo '
			</table>
			<script>
		
				//Countdown
';
				if (isset($launch->t0) || isset($launch->win_open)) {
					echo 'var x = setInterval(function() {
						var countDownDate = new Date("' . (isset($launch->t0) ? $launch->t0 : $launch->win_open) . '").getTime();
						var now = new Date().getTime();
						var distance = countDownDate - now;
						document.getElementById("ctdown").innerHTML = String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, "0") + ":" + String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, "0") + ":" + String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, "0") + ":" + String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, "0");
						
						if (distance < 0) {
							clearInterval(x);
							document.getElementById("ctdown").innerHTML = "00:00:00:00";
							setTimeout(function() {
								location.reload();
							}, (60 * 3 * 1000));
						}
					}, 1000);';
				}
	
$i = 0;
foreach ($next_launches->result as $future_launch) {
	if ($i == 0) { $i++; continue;  }
	if (isset($future_launch->t0) || isset($future_launch->win_open)) {
		echo '
			var x' . $i . ' = setInterval(function() {
				var countDownDate = new Date("' . (isset($future_launch->t0) ? $future_launch->t0 : (isset($future_launch->win_open) ? $future_launch->win_open : "")) . '").getTime();
				var now = new Date().getTime();
				var distance = countDownDate - now;
				document.getElementById("ctdown' . $i . '").innerHTML = "T-<span class=ctdown>" + String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, "0") + ":" + String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, "0") + ":" + String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, "0") + ":" + String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, "0") + "</span>";
			}, 1000);
		';
	} else {
		echo '
			document.getElementById("ctdown' . $i . '").innerHTML = "' . $future_launch->date_str . '";
			document.getElementById("ctdown' . $i . '").classList = "";
		';
	}
	$i++;
}

echo '
				//Refresh every 10 minutes to check for scrubs, delays, etc.
				setTimeout(function() {
					location.reload();
				}, (60 * 10 * 1000));

				var tup = new Date().getTime();
				setInterval(function() {
					var tnow = new Date().getTime();
					var dist = Math.trunc((tnow - tup) / 1000);
					var m = String(Math.floor(dist / 60));
					var s = String(Math.floor((dist - (m*60))));
					document.getElementById("lastup").innerHTML = "Last Updated: " + m + "m " + s + "s ago";
				}, 1000);
			</script>
		<hr>
		<p id="lastup"></p>
	</body>
</html>';

?>