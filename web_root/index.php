<?
include "../scripts/error_reporting.php";
include "../scripts/db.php";
include "../scripts/search.php";
set_error_handler("customError");
include "../scripts/header.php";

$types = get_types_raw();
?>

			<!-- page heading -->
			<div class="row">
				<div class="span12">
					<center><h1>LIST GENERATOR</h1></center>
					<center>For more details on the direct API calls, vist the <a href="http://list.exploitsearch.net/api?help=1">API HELP PAGE</a>.</center>
				</div>
			</div>
			<hr />

<form class="form-horizontal" name="input" action="generate" method="get">

  <div class="control-group">
    <label class="control-label" for="idtypes"><strong>Select Type</strong></label>
    <div class="controls">
	<select id="idtypes" name="type">
<?
foreach ($types as $t) {
	echo "<option>$t</option>\n";
}
?>
</select>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="idcount"># of RESULTS</label>
    <div class="controls">
	<input id="idcount" name="count" class="input-mini" type="text">
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="idlen">Length of Returned Items</label>
    <div class="controls">
	<input id="idlen" name="minmin" class="input-mini" type="text"> - <input name="maxlen" class="input-mini" type="text">
    </div>
  </div>

  <div class="control-group">
    <label>Only Return Items That</label>
    <div class="controls">
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="idstart">Start With</label>
    <div class="controls">
	<input id="idstart" name="startstr" class="input-mini" type="text">
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="idend">End With</label>
    <div class="controls">
	<input id="idend" name="endstr" class="input-mini" type="text">
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="idsub">Contain</label>
    <div class="controls">
	<input id="idsub" name="substr" class="input-mini" type="text">
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="">Items Must Contain the Following CharSets</label>
    <div class="controls">
	<label class="checkbox inline">A-Z<input name="upper" type="checkbox" value="1"></label>
	<label class="checkbox inline">a-z<input name="lower" type="checkbox" value="1"></label>
	<label class="checkbox inline">0-9<input name="digits" type="checkbox" value="1"></label>
	<label class="checkbox inline">Special Chars<input name="special" type="checkbox" value="1"></label>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="">Sort the results</label>
    <div class="controls">
        <input type="radio" name="sortgui" value="0"> ABC - descending<br />
        <input type="radio" name="sortgui" value="1"> ABC - ascending<br />
        <input type="radio" name="sortgui" value="2" checked> most common - descending<br />
        <input type="radio" name="sortgui" value="3"> most common - ascending<br />
        <input type="radio" name="sortgui" value="99"> random
    </div>
  </div>
<input type="submit" class="btn btn-large btn-block btn-primary" type="button" value="Generate List">
</FORM>

<?
include "../scripts/footer.php";
?>
