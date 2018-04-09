	<script src="<?php echo HLSCRIPTS;?>"></script>
	<?php
		if (isset($Hyzher) && $Hyzher == true) {
			?>
			<script src="<?php echo JSHYZHER;?>"></script>
			<script>
				document.onkeydown = function(e) {
				        if (e.ctrlKey && 
				            (e.keyCode === 85 ||
				             e.keyCode === 83 || 
				             e.keyCode === 117)) {
				            return false;
				        } else {
				            return true;
				        }
				};
			</script>
			<?php
		}else{
			?>
			<script>
				document.onkeydown = function(e) {
				        if (e.ctrlKey && 
				            (e.keyCode === 67 || 
				             e.keyCode === 86 || 
				             e.keyCode === 85 ||
				             e.keyCode === 83 || 
				             e.keyCode === 117)) {
				            return false;
				        } else {
				            return true;
				        }
				};
			</script>
			<?php
		}
	?>
	</body>
</html>