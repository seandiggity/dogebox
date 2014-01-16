<?php 
/* Configuration for DogeBox.  See README and LICENSE for more info. */

$debug_mode = 1; //turn on error reporting?
$forceSSL = 1; //force SSL connection?
$allow_robots = 0; //show to search engines?

// Paths and URLs
$root_url = "https://yourdomain.com/"; //usually the Web server domain
$root_path = "/var/www/"; //your root Web directory on the server filesystem
$app_dir = "dogebox/"; //change this if you rename the default dogebox folder
$read_dir = "files/"; //top-level directory to read. DogeBox lists the contents of subdirectories inside.
$desc_file = "DOGE.md"; //README file in each directory, displayed by DogeBox as the description

$app_path = $root_path.$app_dir;
$app_url = $root_url.$app_dir;
$read_path = $app_path.$read_dir; //by default, $read_dir is inside $app_dir
$read_url = $app_url.$read_dir; //by default, $read_url is inside $app_url
$theme_dir = "theme/doge/"; //themes
$lib_dir = "lib/"; //libraries

// Server variables
$ip = $_SERVER['SERVER_ADDR']; //Web server IP address
$browser = $_SERVER['HTTP_USER_AGENT']; //Web browser user agent string
$time01 = date("Y-m-d_H-i-s"); //for filenames
$time02 = date('m-d-Y h:i:sa'); //for logs
$time03 = date('F d, Y g:iA T'); //fancy datetime

// Display settings
$num_dirs = 6; //number of directories to display on each page
$num_files = 6; //number of files to display from each directory
$num_chars = 255; //number of characters to display from each $
$sort_order = "mod_desc"; //mod_desc = date modified descending, mod_asc = date modified ascending, alpha_desc = alphabetically descending, alpha_asc = alphabetically ascending
$dir_timestamp = "F d, Y"; //format for timestamp in listings. See PHP date() manual for options
$markdown = 1; //use MarkdownExtra formatting?
$target_blank = 1; //force links in listings to open in a new window/tab?
$render_img = 1; //render links to image files in as inline images
$file_icon = $theme_dir."img/doge.png"; //renders next to filenames
$favicon = $theme_dir."img/favicon.ico"; //for bookmarks

// Bootswatch styles
$style[0] = "primary"; //primary = red
$style[1] = "success"; //success = green
$style[2] = "danger"; //danger = orange
$style[3] = "info"; //info = purple
$style[4] = "warning"; //warning = yellow

// Logo, header, and footer
$show_logo = 1; //show logo?
$logo_img = $theme_dir."img/doge.png";  //logo path and filename
$top_title = "DogeBox.";
$top_desc = "So basic. Such files. Very hypertext. Wow.";

$cust_footer = 0; //custom footer?
$cust_footer_txt = ""; //custom footer content
?>
