<?php
// Require configuration file
require("config.php");

if($debug_mode == 1) {
	error_reporting(E_ALL & E_STRICT); //turn on all error reporting
	ini_set('display_errors','On');
}

if($forceSSL == 1) {
	require("lib/check_secure.php"); //detect if this is an SSL connection, switch to SSL if not
}

// Include PHP Markdown rendering libraries 
if($markdown == 1) {
	include_once("lib/php-markdown/markdown.php"); // MarkdownExtra classic version, http://michelf.ca/projects/php-markdown/classic/
}

include_once("lib/filesize.php"); //convert filesizes to human-readable text
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?= $top_title; ?> <?= $top_desc; ?></title>
    <meta name="description" content="<?= $top_title; ?> <?= $top_desc; ?>">
<?php if($allow_robots == 1) { ?>
    <meta name="robots" content="index, follow, snippet">
<?php } else { ?>
    <meta name="robots" content="noindex, nofollow, nosnippet">
<?php } ?>

    <!-- Always force latest IE rendering engine and Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <!--  Mobile Viewport Fix http://j.mp/mobileviewport & http://davidbcalhoun.com/2010/viewport-metatag 
    device-width : Occupy full width of the screen in its current orientation
    initial-scale = 1.0 retains dimensions instead of zooming out if page height > device height
    maximum-scale = 1.0 retains dimensions instead of zooming in if page width < device width
    -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta charset="utf-8">

    <link rel="shortcut icon" href="<?= $favicon; ?>" />

    <!-- The is the icon for iOS's Web Clip. Size: 57x57 for older iPhones, 72x72 for iPads, 114x114 for iPhone4 -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?= $theme_dir; ?>img/apple-touch-icon-57px-precomposed.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= $theme_dir; ?>img/apple-touch-icon-72px-precomposed.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= $theme_dir; ?>img/apple-touch-icon-114px-precomposed.png">

    <!-- Bootstrap, Bootswatch, Font Awesome -->
    <link rel="stylesheet" href="<?= $theme_dir; ?>css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="<?= $theme_dir; ?>css/bootswatch.min.css">
    <link rel="stylesheet" href="<?= $theme_dir; ?>css/font-awesome-3.2.1.css"> <!-- old version for IE7 support -->

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= $theme_dir; ?>css/doge.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?= $theme_dir; ?>js/html5shiv.js"></script>
      <script src="<?= $theme_dir; ?>js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="container">

      <div class="page-header" id="banner">
        <div class="row">
          <div class="col-lg-12">
            <img src="<?= $logo_img; ?>" class="img-responsive pull-left" alt="<?= $top_title; ?>">
            <h1><?= $top_title; ?></h1>
            <p class="lead"><?= $top_desc; ?></p>
            <hr class="soften">
          </div>
        </div>
      </div>

<?php
// open the specified directory and check if it's opened successfully
if ($handle = opendir($read_path)) {
   // keep reading the directory entries until the end
   while (false !== ($file = readdir($handle))) {

      // just skip the reference to current and parent directory
      if ($file != "." && $file != "..") {
         if (is_dir($read_path.$file)) { 

	// Fun with colors!  Applies each style in order
	$bsStyle = current($style);
	array_shift($style);
	array_push($style, $bsStyle);
	reset($style);

	echo "<!-- Begin ".$read_path.$file." directory listing -->"; ?>
        <div class="directory-list">

        <div class="row">
        <!-- Description of subdirectory, from /DOGE.md -->
          <div class="col-lg-12">
            <div class="panel panel-<?= $bsStyle; ?>">
              <div class="panel-heading">
                <h3 class="panel-title"><?= date($dir_timestamp, filemtime($read_path.$file."/".$desc_file)); ?></h3>
              </div>
              <div class="panel-body">
	<?php
		$desc_text = file_get_contents($read_path.$file."/".$desc_file); //read directory description

		if($markdown == 1) { 
			$desc_html = Markdown($desc_text); //if Doge owner kept MarkdownExtra parsing turned on 
			if($target_blank == 1) { //if Doge owner wants links opened in a new window/tab
				$desc_html = str_replace( '<a ', '<a target="_blank" ', $desc_html);
			}
			if($render_img == 1) { //if Doge owner wants images rendered inline
				$desc_html = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?\.(gif|png|jpe?g))@', '<img src="$1">', $desc_html);
			}
			echo $desc_html;
		}
		else {
			if($target_blank == 1) {
				$desc_text = str_replace( '<a ', '<a target="_blank" ', $desc_text);
			}
			if($render_img == 1) {
				$desc_text = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?\.(gif|png|jpe?g))@', '<img src="$1">', $desc_text);
			}
			echo $desc_text;
		}
	
		// Now list files inside this subdirectory, skipping dirs inside this subdir

		// open the specified directory and check if it's opened successfully
		if ($subhandle = opendir($read_path.$file)) {

		   // keep reading the directory entries until the end
		   while (false !== ($subfile = readdir($subhandle))) {

		      // just skip the reference to current and parent directory
		      if ($subfile != "." && $subfile != "..") {
			 if (is_dir($subfile)) { 
			
			    // found another dir
			    //echo "$subfile<br>";
		 	} else { 
				if($subfile!==$desc_file) { //ignore $desc_file like DOGE.md
			?>
		<!-- Download links -->
            	<div class="well col-lg-3" style="margin-right:16px;">
		<a style="font-size:1.5em;" href="<?= $read_url.$file.'/'.$subfile; ?>"<?php if($target_blank == 1) { echo 'target="_blank"'; } ?>><img src="<?= $file_icon; ?>" style="height:24px;border:0;margin-right:6px;" alt="<?= $subfile; ?>"><?= $subfile; ?></a> <a style="margin-top:6px;" class="btn btn-<?= $bsStyle; ?>" href="<?= $read_url.$file.'/'.$subfile; ?>"<?php if($target_blank == 1) { echo 'target="_blank"'; } ?>><!--<i class="icon-hand-down icon-large"></i>--> Download <span class="badge"><?= FileSizeConvert(filesize($read_path.$file.'/'.$subfile)); ?></span></a>
		</div>
		<?php
				}
			 }
		      }
		   }

		   // Don't close dir yet, Doge not done with it
		   //closedir($handle);
		}
		?>
              </div>
            </div>
          </div>
        </div>
        
	</div>
        <?php echo "<!-- End ".$read_path.$file." directory listing -->"; ?>

<?php
         } else {
            // found an ordinary file
            echo "$file<br>";
         }
      }
   }

   // ALWAYS remember to close what you opened
   closedir($handle);
}
?>
<!--
	<div class="pagination">

        <div class="row">
          <div class="col-lg-12 align-center">
              <ul class="pagination pagination-lg">
                <li class="disabled"><a href="#">&laquo;</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">6</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>
	 </div>

	</div>
	</div>
-->
      <footer>
        <div class="row">
          <div class="col-lg-12">
            
            <ul class="list-unstyled">
              <li class="pull-right"><a href="#top">Back to top</a></li>
              <li><a href="https://github.com/seandiggity/dogebox" target="_blank">Powered by DogeBox</a></li>
              <li><a href="https://www.gnu.org/licenses/agpl.html" target="_blank">GNU AGPL License</a></li>
              <li><a href="<?= $theme_dir; ?>javascript.html" target="_blank">JavaScript info</a></li>
            </ul>

<?php if($cust_footer == 1) { ?>
            <p><?= $cust_footer_txt; ?></p>
<?php } ?>
          </div>
        </div>
        
      </footer>
    
    </div><!-- End container -->

<!-- JavaScript <script> tags are placed at the end of the document to speed up initial page loads-->
    <script src="<?= $theme_dir; ?>js/jquery-1.10.2.min.js"></script>
    <script src="<?= $theme_dir; ?>js/bootstrap.min.js"></script>
    <script src="<?= $theme_dir; ?>js/bootswatch.js"></script>
    <!-- Custom JS, currently empty -->
    <script src="<?= $theme_dir; ?>js/doge.js"></script>   
  </body>
</html>
