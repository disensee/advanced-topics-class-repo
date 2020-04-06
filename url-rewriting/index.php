<?php
define('PROJECT_ROOT', "/adv-topics/url-rewriting/");
// you may have to update the PROJECT_ROOT if you put the url-rewriting folder in a different place


$path = $_GET['path'] ?? "";
// echo("The page requested (relative to the folder that has the .htaccess file in it):<br><b>{$path}</b><br>");
// echo("The php script that is running:<br><b>{$_SERVER['SCRIPT_FILENAME']}</b><br>");
// die();


if(empty($path)){
	$path = "index.html";
}

// get the content for the page that is being requested 
// note: get_page_by_path() is defined at the bottom of this page
$content = get_page_by_path($path);


// if we don't have that page in our database (or array), then show a 404 page
if(empty($content)){
	header("HTTP/1.0 404 Not Found");
	$content = "Sorry, we can't find the page you are looking for";
}
?>
 
<html>
	<head></head>
	<style>
		ul {margin:0; padding:0; overflow: auto;}
		li {margin: 0; padding:10px; list-style: none; float: left;}
	</style>
	<body>
		<div id="banner">
			<h1>My Dynamic Site</h1>
			<ul>
				<li><a href="<?php echo(PROJECT_ROOT); ?>index.html">Home</a></li>
				<li><a href="<?php echo(PROJECT_ROOT); ?>about.html">About</a></li>
				<li><a href="<?php echo(PROJECT_ROOT); ?>contact-us.html">Contact Us</a></li>
			</ul>
		</div>
		<div id="content">
			<?php echo($content); ?>
		</div>
		<div id="footer">
		</div>
	</body>
</html>

<?php
/**
Retrieves the content for the page that is being requested.

@param 	string 	$requested_path	The path of the page that is being requested

@return string	The content for the page being requested. Returns null if it can't
				find the content for the requested page.  			
*/
function get_page_by_path($requested_path){
	// all of your website's content can be stored in a database
	// but for this example I'll just use an array
	// but imagine what you could do with your website if you did something like this:
	//$qStr = "SELECT * FROM pages WHERE path = '$requested_path'";
	//die($qStr);

	$pages = array(
		"index.html" => "This is the home page content<br>Here's my <a href='blog/some-blog-post.html'>a new blog post</a>",
		"about.html" => "This is the about page content",
		"contact-us.html" => "This is the contact us page content",
		"blog/some-blog-post.html" => "This is some blog post"
	);


	if(isset($pages[$requested_path])){
		return $pages[$requested_path];
	}

	return null;
}
?>

