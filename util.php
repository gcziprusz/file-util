<!DOCTYPE HTML>
<html>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		Source folder:<br/> 	<textarea rows="4" cols="50" name="src"  placeholder="(enter multiple folders separated by commas)"></textarea><br/>
		Selected folder:<br/> <input style="width:420px;" type="text" name="sel" placeholder="Ex: C:/pictures/vacation/"/><br/>
		Destination folder:<br/><input style="width:420px;" type="text" name="dest" placeholder="Ex: C:/pics/folder/"/><br/>	
		<input name="submit" type="submit" value="copy files"/>
	</form>
	<?php
	ini_set('max_execution_time', 600);
	if(isset($_POST['submit']))
	{
			$xl_dirs =explode(",", $_POST['src']); 
			$sel_dir = $_POST['sel'];
			$dest_dir = $_POST['dest']; 
			$selected_files = glob("$sel_dir/*");
			foreach ($xl_dirs as $directory){
				$files = glob("$directory/*");
				foreach ($files as $fl){
					for ($i=0; $i<count($selected_files); $i++){
						if (basename($fl) == basename($selected_files[$i])) {
							$d = "$dest_dir".basename($selected_files[$i]);
								if (!copy("$fl", $d)) {
									echo "failed to copy $fl...<br/>";
								}
								else{
									echo "copied: $fl to $dest_dir ...<br/>";
								}
						}
					}
				}
			}
	}
	?>
</body>
</html>