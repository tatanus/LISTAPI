<?
include "../scripts/error_reporting.php";
include "../scripts/db.php";
set_error_handler("customError");
include "../scripts/header.php";
?>

                        <!-- page heading -->
                        <div class="row">
                                <div class="span12">
                                        <center><h1>About</h1></center>
                                </div>
                        </div>
                        <hr />

                    <div class="row">
			 <div class="span12">
This site is an attempt at creating an online searchable repository of security related lists. What kind of lists? Well, pretty much any list that can be stored in a manner similar to "[type], [value]". So for example, it is fairly easy to store a list of common passwords... "[passwords], [123456]" or a list of common Unix usernames... "[usernames], [root]". The site can also store lists of other items such as common browser user agent strings, reverse shells which can be written on one line, one line back doors, known malicious IPs, and so on. There really is no limit to the types of data that list.exploitsearch.net can store and provide out as needed.
</br></br>
The only site imposed limitation is that all the data be actual/live data. That is to say, all the data that is to be stored should have been actually seen "in the wild". So, what does this limit? The easiest place to see this limitation is in the password list. This site will only store passwords that have been known to hav been used by actual people. So, it will not be string all possibly 8 character passwords. If you want that list, you can easily create it your self via some other mechanism.
</br></br>
Also, all/most of the data contained in the site has a fixed life span. Depending on the nature of the data, the life span can vary. For example, the lifespan of passwords may be 1 year, where as the life span of malicious IPs may just be a few weeks. After the life span of a piece of data has been reached, it will be removed from the standard list generation process, thus helping to enforce that the lists that are generated contain only up to date information. There may be an API parameter that will allow the generated lists to contain old data at some point, but currently this is not possible.
</br></br>
The goal of this site is to allow security researchers, consultants, pentesters, etc... an place from which they can pull a list tailored to their specifications of common passwords, usernames, database columns, browser user agent strings, one line reverse shells, etc...
</br></br>
If you have data you would like to have added to one of the current types of lists or if you have an entirely new type of list you would like to have stored here, feel free to contact me at <b>adam@exploitsearch.net</b>
</br></br>
</br></br>
I would like to thank the following people for acting as sounding boards:</br></br>
<a href="https://twitter.com/averagesecguy">averagesecguy</a></br>
<a href="https://twitter.com/g0tmi1k">g0tmi1l</a></br>
<a href="https://twitter.com/jakx_">Jakx_</a></br>
<a href="https://twitter.com/NullMode_">NullMode_</a></br>
                         </div>
		</div>
<?
include "../scripts/footer.php";
?>

