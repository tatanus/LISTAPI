<?
include "../scripts/error_reporting.php";
include "../scripts/db.php";
set_error_handler("customError");
include "../scripts/header.php";
?>

                        <!-- page heading -->
                        <div class="row">
                                <div class="span12">
                                        <center><h1>F.A.Q.</h1></center>
                                </div>
                        </div>
                        <hr />

                        <!-- useful stuff goes here :) -->
		<div class="row">
			 <div class="span12">
			      <DIV class="well">
				<H2>Why is it so slow</H2>
				Mostly because the site is in in development and has not been moved to its final host.  When the testing and development work is completed, the site will be moved to a different server which should improve the performance significantly.
			      </DIV>
			      <DIV class="well">
				<H2>Does not look like the site has all of the most common passwords</H2>
				That is probably correct.  As the site is srtill in development, data is being added/removed/updated on a constant basis.  Once the site leaves BETA status, the data will be more stable and will be more fully populated.
			      </DIV>
			      <DIV class="well">
				<H2>Why is there not data of type XYZ</H2>re there any any limitations I should know about during the BETA
				Yes.<br />
				1) You can only make 100 API calls from any given IP address within a 5 minute block.  This is to prevent overloading the dev environment.<br />
				2) Their is only a limited number of data types and only a limited number of values for each data type.  This is due to the site still being in development.  Once all of the bugs have been worked out, additional data types and values will be added.<br />
				3) The data is likely to be changing on a somewhat rapid basis.  This is again due to the fact that the site is still under minor development.<br />
			      </DIV>
			      <DIV class="well">
				<H2>Why is there not data of type XYZ</H2>
				Simple answer...    Either I do not have that data or I have not had time to add it in yet.
			      </DIV>
			      <DIV class="well">
				<H2>I have some items that I would like you to add</H2>
				No problem.  Simply send them to <b>adam@exploitsearch.net</b> and specify the type (and subtype) of the dat and I will add it to the queue of data to be added.
			      </DIV>
			      <DIV class="well">
				<H2>So I here there is a more complex API than what the web form provides</H2>
				That is correct.  You can see it <a href="http://list.exploitsearch.net/api?help=1">HERE</a>
			      </DIV>
                         </div>
		    </div>

<?
include "../scripts/footer.php";
?>
