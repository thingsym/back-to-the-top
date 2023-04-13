=== Back to the Top ===

Contributors: thingsym
Link: https://github.com/thingsym/back-to-the-top
Donate link: https://github.com/sponsors/thingsym
Tags: To top, Scroll top, Back to the Top
Stable tag: 1.2.0
Tested up to: 6.2.0
Requires at least: 4.9
Requires PHP: 5.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Back to the Top is a WordPress plugin that return to scroll smoothly to the top of the page. You can scroll to the smooth anchor link in the page.

== Description ==

Back to the Top is a WordPress plugin that return to scroll smoothly to the top of the page. You can scroll to the smooth anchor link in the page.

Back to the Top will add a link that return the top of the page for your website. You can customize label, color, display and so in the options page. You don't need to edit your theme.

Back to the Top is also a jQuery plugin. [Back to the Top Project Page here.](http://project.thingslabo.com/jquery.backtothetop) You can set easily WordPress plugin ’Back to the Top’ than jQuery plugin ones.

= Features =

* Customizable options in the options page
* Selectable the effects easing of the scroll
* The iconic font supported, Dashicons and Font Awesome

= Support =

If you have any trouble, you can use the forums or report bugs.

* Forum: [https://wordpress.org/support/plugin/back-to-the-top/](https://wordpress.org/support/plugin/back-to-the-top/)
* Issues: [https://github.com/thingsym/back-to-the-top/issues](https://github.com/thingsym/back-to-the-top/issues)

= Contribution =

Small patches and bug reports can be submitted a issue tracker in Github. Forking on Github is another good way. You can send a pull request.

Translating a plugin takes a lot of time, effort, and patience. I really appreciate the hard work from these contributors.

If you have created or updated your own language pack, you can send gettext PO and MO files to author. I can bundle it into plugin.

* [VCS - GitHub](https://github.com/thingsym/back-to-the-top)
* [Homepage - WordPress Plugin](https://wordpress.org/plugins/back-to-the-top/)
* [Translate Back to the Top into your language.](https://translate.wordpress.org/projects/wp-plugins/back-to-the-top)

You can also contribute by answering issues on the forums.

* Forum: [https://wordpress.org/support/plugin/back-to-the-top/](https://wordpress.org/support/plugin/back-to-the-top/)
* Issues: [https://github.com/thingsym/back-to-the-top/issues](https://github.com/thingsym/back-to-the-top/issues)

= Patches and Bug Fixes =

Forking on Github is another good way. You can send a pull request.

1. Fork [Back to the Top](https://github.com/thingsym/back-to-the-top) from GitHub repository
2. Create a feature branch: git checkout -b my-new-feature
3. Commit your changes: git commit -am 'Add some feature'
4. Push to the branch: git push origin my-new-feature
5. Create new Pull Request

= Contribute guidlines =

If you would like to contribute, here are some notes and guidlines.

* All development happens on the **develop** branch, so it is always the most up-to-date
* The **master** branch only contains tagged releases
* If you are going to be submitting a pull request, please submit your pull request to the **develop** branch
* See about [forking](https://help.github.com/articles/fork-a-repo/) and [pull requests](https://help.github.com/articles/using-pull-requests/)

= Test Matrix =

For operation compatibility between PHP version and WordPress version, see below [Github Actions](https://github.com/thingsym/back-to-the-top/actions).

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

= 1.2.0 =
* fix phpcs.ruleset.xml
* fix multiple assignments
* declare uninstall method as public method
* separate the file structure for class file
* add @package tag
* fix class name according to naming convention
* fix constants to uppercase
* update japanese translation
* update pot
* change makepot from php script to wp cli
* change plugin initialization to plugins_loaded hook
* replace assert from assertEquals to assertSame

= 1.1.1 =
* update wp-plugin-unit-test.yml
* bump up yoast/phpunit-polyfills version
* change os to ubuntu-20.04 for ci
* add Upgrade Notice
* change requires at least to wordpress 4.9
* change requires to PHP 5.6
* add test case

= 1.1.0 =
* add composer scripts
* update japanese translation
* update pot
* update composer dependencies
* add test case
* change method name from admin_init to register_settings
* change method name from validate to validate_options
* fix textdomain
* add plugin_metadata_links method
* change add_filter to plugin_action_links_**
* add init method
* add Constants
* add checking Back_to_the_Top class
* add checking ABSPATH
* add load_textdomain method
* remove protected variable
* change from protected variable to public variable for unit test
* update composer.json
* add timeout-minutes to workflows
* add phpunit-polyfills
* update wordpress-test-matrix
* add sponsor link
* add FUNDING.yml
* add GitHub actions for CI/CD, remove .travis.yml

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

= 1.1.1 =
* Requires at least version 4.9 of the WordPress
* Requires PHP version 5.6

= 1.0.4 =
* Requires at least version 4.0 of the WordPress
