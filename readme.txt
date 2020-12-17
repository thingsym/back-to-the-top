=== Back to the Top ===

Contributors: thingsym
Donate link:
Link: https://github.com/thingsym/back-to-the-top
Tags: To top, Scroll top, Back to the Top
Stable tag: 1.0.5
Tested up to: 5.4.2
Requires at least: 4.0
Requires PHP: 5.3
License: GPL2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Back to the Top is a WordPress plugin that return to scroll smoothly to the top of the page. You can scroll to the smooth anchor link in the page.

== Description ==

Back to the Top will add a link that return the top of the page for your website. You can customize label, color, display and so in the options page. You don't need to edit your theme.

Back to the Top is also a jQuery plugin. [Back to the Top Project Page here.](http://project.thingslabo.com/jquery.backtothetop) You can set easily WordPress plugin ’Back to the Top’ than jQuery plugin ones.

= Features =

* Customizable options in the options page
* Selectable the effects easing of the scroll
* The iconic font supported, Dashicons and Font Awesome

= Test Matrix =

For operation compatibility between PHP version and WordPress version, see below [Github Actions](https://github.com/thingsym/back-to-the-top/actions).

= Contributing =

= Patches and Bug Fixes =

Small patches and bug reports can be submitted a issue tracker in Github. Forking on Github is another good way. You can send a pull request.

* [back-to-the-top - GitHub](https://github.com/thingsym/back-to-the-top)
* [Back to the Top - WordPress Plugin](https://wordpress.org/plugins/back-to-the-top/)

== Screenshots ==

1. options page

== Installation ==

1. Download and unzip files. Or install 'Back to the Top' plugin using the WordPress plugin installer. In that case, skip 2.
2. Upload 'backtothetop' to the '/wp-content/plugins/' directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.
5. Go to the 'Back to the Top' options page through the 'Appearance' menu in WordPress.
4. Have fun!


= Customize Stylesheet =

You can customize Stylesheet by the Custom CSS. See the following example.

`
a#backtothetop-fixed {
	background: #f1f1f1;
	border-radius: 10%;
	padding: 0.2em;
}
a#backtothetop-fixed:hover {
	background: #fefefe;
}
`

== Changelog ==

= 1.0.5 =
* fix indent and reformat with phpcs and phpcbf
* add composer.json for test
* add static code analysis config

= 1.0.4 =
* change Requires at least from 3.4 to 4.0
* improve CI environment
* updated: update jquery.backtothetop.js v1.1.7

= 1.0.3 =
* fixed: fix backtothetop.admin.js
* updated: update jquery.backtothetop.js v1.1.6

= 1.0.2 =
* fixed: fix handle and option name
* fixed: fix typo

= 1.0.1 =
* fixed: refactoring by the PHP_CodeSniffer
* updated: update jquery.backtothetop.js v1.1.5
* added: add PHPUnit and tests

= 1.0.0 =
* initial release

== Upgrade Notice ==

= 1.0.4 =
* Requires at least version 4.0 of the WordPress
