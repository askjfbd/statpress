=== Plugin Name ===
Contributors: 
Donate link: 
Tags: stats, statistics, widget, admin, sidebar, visits, visitors, pageview, user, agent, referrer,post,posts
Requires at least: 2.0.2
Tested up to: 2.3.1
Stable Tag: 0.7.7

The real-time plugin dedicated to the management of statistics about blog visits. It collects information about visitors, spiders, search keywords, feeds, browsers etc.


== Description ==

The real-time plugin dedicated to the management of statistics about blog visits. It collects information about visitors, spiders, search keywords, feeds, browsers etc.

= Check "Other notes" tab to find out updates history! =

Once the plugin StatPress has been activated it immediately starts to collect statistic information about blog visitors.
In the Dashboard menu you will find the StatPress page where you could look up the statistics (overview or detailed).
StatPress also includes a widget one can possibly add to a sidebar (or easy PHP code if you can't use widgets!).

You could ban IP list from stats editing banips.dat!


= StatPress Widget / StatPress_Print function =

Widget is customizable. These are the available variables:

* %thistotalvisits% - this page, total visits
* %since% - Date of the first hit
* %visits% - Today visits
* %totalvisits% - Total visits
* %os% - Operative system
* %browser% - Browser
* %ip% - IP address
* %visitorsonline% - Counts all online visitors
* %usersonline% - Counts logged online visitors

Now you could add these values everywhere! StatPress >=0.7.6 offers a new PHP function *StatPress_Print()*.
* i.e. StatPress_Print("%totalvisits% total visits.");

== Installation ==

Upload wp-statpress directory in /wp-content/plugins/ . Then just activate it on your plugin management page.
You are ready!


= Update =

* Deactivate StatPress plugin (no data lost!)
* Override wp-statpress directory in /wp-content/plugins/
* Re-activate it on your plugin management page
* In the Dashboard click "StatPress", then "StatPressUpdate" and wait until it will add/update db's content

== Frequently Asked Questions ==

= I've a problem. Where can I get help? =

Please post your messages to <a href="http://www.irisco.it/forums/forum.php?id=1">statpress forum</a>

= Is it wp_2.3.x compatible? =

Of course!


== Screenshots ==
&middot; <a href="http://www.irisco.it/wp-content/uploads/overview.jpg">screenshot-1 - Overview</a><br>
&middot; <a href="http://www.irisco.it/wp-content/uploads/details.jpg">screenshot-2 - Details</a><br>
&middot; <a href="http://www.irisco.it/wp-content/uploads/widget.jpg">screenshot-3 - Widget</a><br>
&middot; <a href="http://www.irisco.it/wp-content/uploads/spy.jpg">screenshot-4 - Spy</a><br>
&middot; <a href="http://www.irisco.it/wp-content/uploads/search.jpg">screenshot-5 - Search</a><br>

== Updates ==

*Update from 0.1 to 0.2*

* Layout update
* iPhone and other new defs

*Update from 0.2 to 0.3 (15 Jul 2007)*

* Rss Feeds support!
* Layout update
* New defs

*Update from 0.3 to 0.4 (14 Sep 2007)*

* Customizable widget
* New defs

*Update from 0.4 to 0.5 (25 Sep 2007)*

* New "Overview"
* New defs

*Update from 0.5 to 0.5.2 (3 Oct 2007)*

* Solved (rare) compatibility issues - Thanks to Carlo A.

*Update from 0.5.2 to 0.5.3 (4 Oct 2007)*

* Solved setup compatibility issues - Thanks to Andrew

*Update from 0.5.3 to 0.6 (17 Oct 2007)*

* New interface layout
* Export to CSV
* MySQL table size in Overview

*Update from 0.6 to 0.7 (22 Oct 2007)*

* Unique visitors
* New graphs (and screenshots)

*Update from 0.7 to 0.7.1 (27 Oct 2007)*

* (one time) Automatically database table creation

*Update from 0.7.1 to 0.7.2 (30 Oct 2007)*

* Now "Last Pages" and "Pages" sections don't count spiders hits - Thanks to Maddler
* Page title decoded
* New spider defs - Thanks to Maddler

*Update from 0.7.2 to 0.7.3 (8 Nov 2007)*

* New IP banning (new file def/banips.dat)
* Functions updated, bugs resolved - Thanks to Maddler
* New "Overview"
* Updated defs

*Update from 0.7.3 to 0.7.4 (12 Nov 2007)*

* New Spy section
* Updated defs

*Update from 0.7.4 to 0.7.5 (14 Nov 2007)*

* New gfx look
* Updated defs

*Update from 0.7.5 to 0.7.6 (25 Nov 2007)*

* New SEARCH section!
* New StatPress_Print() function

*Update from 0.7.6 to 0.7.7 (28 Nov 2007)*

* New SEARCH section!
* New Options panel
* (Optionally) StatPress collects data about logged users
* New Widget variables: VISITORSONLINE and USERSONLINE
