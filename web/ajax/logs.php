<?php
if(isset($_GET['log'])) {
		$log = $_GET['log'];
	}
	
if(isset($_GET['max'])) {
		$_max = $_GET['max'];
	}
?>

<script>
		$('.more').click(function(){
			$.get('ajax/logs.php?log=<?php echo $log; ?>&max=400', function(data) {
			  $('.result').html(data);
			  //alert('Load was performed.');
			  $('.more').hide();
			});
		});
		
		$('.less').click(function(){
			$.get('ajax/logs.php?log=<?php echo $log; ?>&max=100', function(data) {
			  $('.result').html(data);
			  //alert('Load was performed.');
			  $('.less').hide();		  
			});
		});
		
</script>

<?php
if (isset($_GET['log'])){ 
	$log = $_GET['log'];
	if (isset($_GET['max'])) {
		$_max = $_GET['max'];
		$text_note = "<p class=\"less\">show less content...</p><br/>";	
	}
	else {
		$_max = 100;	
		$text_note = "<p class=\"more\">more...</p><br/>";
	}
	?> <div class="result"><?php
	//print "<b>$log log</b><br/>";
	//print "<a href=\"index.php?view=logs&log=$log&max=400\">400 lines</a><br/>";	

	$logpath = "../../logs/$log.log";
	$lok = array();
	$a = 0;

	if (file_exists($logpath)) {
		$lok = file($logpath);
		$lok = array_reverse($lok);
	}
	else {
		print "<span class=error>logfile $log not found</span><br/>";
		
	}

	foreach ($lok as $line){
		if ($a++ > $_max ) {
			break;
		}
		#$line =preg_replace('/(\d{4}\/\d\d\/\d\d\)/i','<small>$1</small>',$line);
		#$lines =preg_match('/(\d{4}\/\d\d\/\d\d) (\d\d:\d\d:\d\d)/i','<small>$1</small><big>$2</big>',$line);
		preg_match('/(\d{4}\/\d\d\/\d\d) (\d\d:\d\d:\d\d) (\w*)\: (.*)/i',$line,$lines);
		$date = $lines[1];
		$time = $lines[2];
		$machine = $lines[3];
		$rest = $lines[4];
		#print_r($lines);
		#print "$line<br/>";
		print "<div class=\"log_$machine\">$machine</div><div class=\"log_time_display\">@$date $time </div>";
		print "<b>$rest</b>";
		print "<br/>----------------------<br/>";
	}
	print $text_note;
	?> </div><?php	
}
?>
