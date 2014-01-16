DogeBox.
=======
So basic. Such files. Very hypertext. Wow.
-----------
A basic Web frontend for uploaded files.  Doesn't provide any uploading functionality, on purpose.

DogeBox treats the directory you specify in config.php as the filesharing root, and each subdirectory in this root as an individual blog post.  It will ignore directories further down the tree.  It treats a text file in each subdirectory (by default a MarkdownExtra file named DOGE.md) as the text of the blog post.  Below this text, which should ideally descibe the files in the folder, DogeBox renders download links with info about each file (e.g. filesize).  Such colors.  Many buttons.  Wow.

See an example at [https://getlibre.org/dogebox](https://getlibre.org/dogebox)

Installation
-----------
1. Copy DogeBox to a Web server with PHP 5+ running
2. Edit config.php appropriately.  The only variables you must change are $root_url and $root_path
3. Copy the folders you wish to share to the location specified in $read_dir, /files by default
4. Optionally create a descriptive text file inside each directory, DOGE.md by default.  This README.md is Markdown.  [More Examples](http://en.wikipedia.org/wiki/Markdown#Example).

5. There are sample .htaccess, .htpasswd, and robots.txt files in the root.  Be wary of search engines and don't rely upon security by obscurity.

Use Cases
-----------
* Artists and musicians wishing to share their work without a hassle.
* Microbloggers who want to link their posts to personally-hosted files.
* Teachers uploading assignments and documents.
* Bulletin board users tired of sharing files in forum threads.
* SSH/SFTP users looking for a simple frontend for files.
* Office workers posting announcements with attached reports.

Source
-----------
[https://github.com/seandiggity/dogebox](https://github.com/seandiggity/dogebox)

Author
-----------
Sean "Diggity" O'Brien, [sean@webio.me](mailto:sean@webio.me)

License
-----------
[GNU AGPL v3](https://www.gnu.org/licenses/agpl.html)

Requirements
-----------
PHP 5+

More Info
-----------
See JavaScript labels for LibreJS at [theme/doge/javascript.html](theme/javascript.html)

More licensing info for the theme at [theme/doge/THEME.md](theme/THEME.md)

Additional icons from FreedomBox are in [theme/freedom/](theme/freedom/THEME.md)

Doge images by Doge. Yes, [this is Doge](https://en.wikipedia.org/wiki/Doge_%28meme%29)

