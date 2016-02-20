=== Track Kickstarter Project ===

Contributors: teFox
Tags: kickstarter
Requires at least: 4.3
Tested up to: 4.4.1
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easly track your Kickstarter projects and show up stats in your blog.


== Description ==

Easly track your Kickstarter projects and show up stats in your blog with Track Kickstarter Project widget or [tf_track_project] shortcode.

== Installation ==

1. Unzip the downloaded zip file.
2. Upload the plugin folder into the `wp-content/plugins/` directory of your WordPress site.
3. Activate `Track Kickstarter Project` from Plugins page

== Configuration ==

1. Shortcode. Add into editor next shortcode: `[tf_track_project url="{your project page URL from kickstarter}" descr="{Your project description}"]`
2. Widget. Use `Track Kickstarter Project` at widgets page. Options the same as shortcode.
3. You can rewrite in your theme widget and shortode template - just copy it from the `templates` folder in plugin and put into `track-kickstarter` folder in your theme

Data getting from Kickstarter caching for 4 hours to prevent multiple requests to Kickstarter.

== Changelog ==

= 1.0.0 =

* Initial release

= 1.0.1 =

* Fix: template path for rewritten templates
* Fix: misprint int CSS class names
* Tweak: Increase caching time to 6 hours
* Tweak: Widget options management refactoring
