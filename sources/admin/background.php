<?php
if(basename($_SERVER["PHP_SELF"]) == "background.php"){
    die("403 - Access Forbidden");
}
?>
<script type="text/javascript" src="<?php echo $siteurl; ?>assets/js/jscolor.js"></script>
<?php 
if($_SESSION['admin']){
	if(!isset($_POST['url'])) {
	if($bgfixed == 1){$bgfixedcheck = "checked";} else {$bgfixedcheck = "";}
	if($bgcenter == "center"){$bgcentercheck = "checked";} else {$bgcentercheck = "";}
	if($bgcover == 1){$bgcovercheck = "checked";} else {$bgcovercheck = "";}
		echo "<h2 class=\"text-left\">Site Background</h2><hr/>
		<p>Many sites have a background to make the website more personalized. There is not a default image size, but you may want to play around with some sizes to see what you like.</p>
		<p>To upload an image, please go to <a href=\"http://www.imgur.com\">imgur.com</a>, and then enter in the image url below. The URL will look like this: i.imgur.com/abcdefghi.jpg. Of course, you may use any other website to host your image.</p><hr/>
		<form method=\"post\">
			<div class=\"form-group\">
				<label for=\"inputURL\">Background URL</label>
				<input type=\"text\" class=\"form-control\" name=\"url\" id=\"inputURL\" placeholder=\"Enter image URL\" value=\"".$background."\">
			</div>
			<div class=\"form-group\">
				<label for=\"inputURL\">Background Color (Hex)</label>
				<input type=\"text\" class=\"form-control color\" name=\"bgcolor\" id=\"inputURL\" placeholder=\"Enter Background Color\" value=\"".$bgcolor."\">
				<span class=\"help-block\">Your background color must look like this: 000000<br/>To look up hex colors, click the input box above.</span>
			</div>
			<div class=\"form-group\">
				<label for=\"repeatStyle\">Background Repeat</label>
				<select class=\"form-control\" name=\"bgrepeat\" id=\"repeatStyle\">
					<option value=\"no-repeat\">No Repeat</option>
					<option value=\"repeat\">Repeat Both Directions</option>
					<option value=\"repeat-x\">Repeat Horizontally</option>
					<option value=\"repeat-y\">Repeat Vertically</option>
				</select>
				<span class=\"help-block\">Background images can repeat horizontally, vertically, both, or none.</span>
			</div>
			<div class=\"checkbox\">
				<label>
					<input type=\"checkbox\" name=\"bgcenter\" value=\"1\" $bgcentercheck>Center Background (Yes)
				</label>
			</div>
			<span class=\"help-block\">Background images can be centered.</span>
			<div class=\"checkbox\">
				<label>
					<input type=\"checkbox\" name=\"bgfixed\" value=\"1\" $bgfixedcheck>Fixed Background (Yes)
				</label>
			</div>				
			<span class=\"help-block\">Background images can be fixed (won&#39;t scroll).</span>
			<div class=\"checkbox\">
				<label>
					<input type=\"checkbox\" name=\"bgcover\" value=\"1\" $bgcovercheck>Fit Background to Screen (Yes)
				</label>
			</div>				
			<span class=\"help-block\">Background images can be resized to fit the browser window.</span>
			<hr/>
			<button type=\"submit\" class=\"btn btn-primary\" required>Submit &raquo;</button>
		</form>
		";	
	}
	else {
		$url = mysql_escape($_POST["url"]);
		$bgcolor = mysql_escape($_POST["bgcolor"]);
		$bgrepeat = mysql_escape($_POST["bgrepeat"]);
		$bgcenter = mysql_escape(isset($_POST["bgcenter"]));
		$bgfixed = mysql_escape(isset($_POST["bgfixed"]));
		$bgcover = mysql_escape(isset($_POST["bgcover"]));
		$mysqli->query("UPDATE ".$prefix."properties SET background = '$url', bgcolor = '$bgcolor', bgrepeat = '$bgrepeat', bgcenter = '$bgcenter', bgfixed = '$bgfixed', bgcover = '$bgcover'");
		echo "<div class=\"alert alert-success\">Successfully updated background.</div>";
		redirect_wait5("?base=admin&page=background");
	}
} else{
	redirect("?base");
}
?>