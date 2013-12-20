<?php
include "../include/db.php";
include "../include/general.php";

# External access support (authenticate only if no key provided, or if invalid access key provided)
$k=getvalescaped("k","");if (($k=="") || (!check_access_key(getvalescaped("ref","",true),$k))) {include "../include/authenticate.php";}

$ref=getval("ref","");
$size=getval("size","");
$ext=getval("ext","");
$alternative=getval("alternative",-1);

hook("pageevaluation");

$download_url_suffix=hook("addtodownloadquerystring");

if (getval("save","")!="")
	{
	$usage=getvalescaped("usage","");
	$usagecomment=getvalescaped("usagecomment","");
	if($download_url_suffix==""){$download_url_suffix="?";}
	else{$download_url_suffix.="&";}
	$download_url_suffix.="ref=" . urlencode($ref)  . "&size=" . urlencode($size) . "&ext=" . urlencode($ext) . "&k=" . urlencode($k) . "&alternative=" . urlencode($alternative) . "&usage=" . urlencode($usage) . "&usagecomment=" . urlencode($usagecomment);
	redirect("pages/download_progress.php" . $download_url_suffix);
	}

include "../include/header.php";

?>

<div class="BasicsBox">

<form method=post action="<?php echo $baseurl_short?>pages/download_usage.php<?php echo $download_url_suffix ?>" onSubmit="if ((jQuery('#usagecomment').val()=='') || (jQuery('#usage').val()=='')) {alert('<?php echo $lang["usageincorrect"] ?>');return false;} else {return CentralSpacePost(this,true);}">
<input type="hidden" name="ref" value="<?php echo htmlspecialchars($ref) ?>" />
<input type="hidden" name="size" value="<?php echo htmlspecialchars($size) ?>" />
<input type="hidden" name="ext" value="<?php echo htmlspecialchars($ext) ?>" />
<input type="hidden" name="alternative" value="<?php echo htmlspecialchars($alternative) ?>" />
<input type="hidden" name="k" value="<?php echo htmlspecialchars($k) ?>" />
<input type="hidden" name="save" value="true" />
<h1><?php echo $lang["usage"]?></h1>
<p><?php echo $lang["indicateusage"]?></p>

<div class="Question"><label><?php echo $lang["usage"]?></label><textarea rows="5" name="usagecomment" id="usagecomment" type="text" class="stdwidth"></textarea><div class="clearerleft"> </div></div>

<div class="Question"><label><?php echo $lang["indicateusagemedium"]?></label>
<select class="stdwidth" name="usage" id="usage">
<option value=""><?php echo $lang["select"] ?></option>
<?php 
for ($n=0;$n<count($download_usage_options);$n++)
	{
	?>
	<option value="<?php echo $n; ?>"><?php echo htmlspecialchars($download_usage_options[$n]) ?></option>	
	<?php
	}
?>
</select>
<div class="clearerleft"> </div></div>


<div class="QuestionSubmit">
<label for="buttons"> </label>			
<input name="submit" type="submit" value="&nbsp;&nbsp;<?php echo $lang["action-download"]?>&nbsp;&nbsp;" />
</div>

</form>
</div>


<?php
include "../include/footer.php";
?>
