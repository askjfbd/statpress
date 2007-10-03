<?php
/*
Plugin Name: StatPress
Plugin URI: http://www.irisco.it/?page_id=28
Description: Stats for your blog
Version: 0.5.2
Author: Daniele Lippi
Author URI: http://www.irisco.it
*/

function iri_add_pages() {
    add_submenu_page('index.php', 'StatPress', 'StatPress', 8, 'statpress', 'iriStatPress');
    add_submenu_page('index.php', 'StatPressUP', 'StatPressUP', 8, 'statpressup', 'iriStatPressUpdate');
}


function iriStatPress() {
	global $wpdb;
	$table_name = $wpdb->prefix . "statpress";
	
	$querylimit="LIMIT 10";
	
?>
<ul id="submenu">
	<li><a href='#lasthits'>Last Hits</a></li>
	<li><a href='#feeds'>Feeds</a></li>
	<li><a href='#searchterms'>SearchTerms</a></li>
	<li><a href='#referrers'>Referrers</a></li>
	<li><a href='#spiders'>Spiders</a></li>
</ul>

<?php
    
	# Tabella OVERVIEW
	$web_color="#3377B6";
	$rss_color="#f38f36";
	$spider_color="#83b4d8";
    $lastmonth = date('Ym', mktime(0, 0, 0, date("m")-1 , date("d") - 1, date("Y")));
    $yesterday = date('Ymd', time()-86400);
	print "<div class='wrap'><h2>Overview</h2>";
	print "<table class='widefat'><thead><tr><th scope='col'></th><th scope='col'>Total</th><th scope='col'>Last month</th><th scope='col'>This month</th><th scope='col'>Yesterday</th><th scope='col'>Today</th></tr></thead>";
	print "<tbody id='the-list'>";
	###### Pageviews
    print "<tr><td><div style='background:$web_color;width:10px;height:10px;float:left;margin-top:4px;margin-right:5px;'></div>Pageviews</td>";
	$qry = $wpdb->get_results("SELECT count(date) as pageview FROM $table_name WHERE feed='' AND spider='';");
	foreach ($qry as $rk) {
		print "<td>".$rk->pageview."</td>\n";
	}
    $prec=0;
	$qry = $wpdb->get_results("SELECT count(date) as pageview FROM $table_name WHERE feed='' AND spider='' AND date LIKE '".$lastmonth."%';");
	foreach ($qry as $rk) {
		print "<td>".$rk->pageview."</td>\n";
	}
    $prec=$rk->pageview;
	$qry = $wpdb->get_results("SELECT count(date) as pageview FROM $table_name WHERE feed='' AND spider='' AND date LIKE '".date("Ym")."%';");
	foreach ($qry as $rk) {
		print "<td>".$rk->pageview;
		if($prec<>0) {
			print " (";
			$pc=round(( 100 * ($rk->pageview) / $prec ) - 100,1);
			if($pc>=0) { print "+"; }
			print $pc."%)";
		}
		print "</td>\n";
	}
	$qry = $wpdb->get_results("SELECT count(date) as pageview FROM $table_name WHERE feed='' AND spider='' AND date = '".$yesterday."';");
	foreach ($qry as $rk) {
		print "<td>".$rk->pageview."</td>\n";
	}
	$qry = $wpdb->get_results("SELECT count(date) as pageview FROM $table_name WHERE feed='' AND spider='' AND date = '".date("Ymd")."';");
	foreach ($qry as $rk) {
		print "<td>".$rk->pageview."</td>\n";
	}
    print "</tr>";
  	###### Spider
    print "<tr><td><div style='background:$spider_color;width:10px;height:10px;float:left;margin-top:4px;margin-right:5px;'></div>Spiders</td>";
	$qry = $wpdb->get_results("SELECT count(date) as pageview FROM $table_name WHERE feed='' AND spider NOT LIKE '';");
	foreach ($qry as $rk) {
		print "<td>".$rk->pageview."</td>\n";
	}
    $prec=0;
	$qry = $wpdb->get_results("SELECT count(date) as pageview FROM $table_name WHERE feed='' AND spider NOT LIKE '' AND date LIKE '".$lastmonth."%';");
	foreach ($qry as $rk) {
		print "<td>".$rk->pageview."</td>\n";
	}
    $prec=$rk->pageview;
	$qry = $wpdb->get_results("SELECT count(date) as pageview FROM $table_name WHERE feed=''  AND spider NOT LIKE '' AND date LIKE '".date("Ym")."%';");
	foreach ($qry as $rk) {
		print "<td>".$rk->pageview;
		if($prec<>0) {
			print " (";
			$pc=round(( 100 * ($rk->pageview) / $prec ) - 100,1);
			if($pc>=0) { print "+"; }
			print $pc."%)";
		}
		print "</td>\n";
	}
	$qry = $wpdb->get_results("SELECT count(date) as pageview FROM $table_name WHERE feed=''  AND spider NOT LIKE '' AND date = '".$yesterday."';");
	foreach ($qry as $rk) {
		print "<td>".$rk->pageview."</td>\n";
	}
	$qry = $wpdb->get_results("SELECT count(date) as pageview FROM $table_name WHERE feed=''  AND spider NOT LIKE '' AND date = '".date("Ymd")."';");
	foreach ($qry as $rk) {
		print "<td>".$rk->pageview."</td>\n";
	}
    print "</tr>";
    
    print "<tr><td><div style='background:$rss_color;width:10px;height:10px;float:left;margin-top:4px;margin-right:5px;'></div>Feeds</td>";
	$qry = $wpdb->get_results("SELECT count(date) as pageview FROM $table_name WHERE feed<>'';");
	foreach ($qry as $rk) {
		print "<td>".$rk->pageview."</td>\n";
	}
    $prec=0;
	$qry = $wpdb->get_results("SELECT count(date) as pageview FROM $table_name WHERE feed<>'' AND date LIKE '".$lastmonth."%';");
	foreach ($qry as $rk) {
		print "<td>".$rk->pageview."</td>\n";
	}
    $prec=$rk->pageview;
	$qry = $wpdb->get_results("SELECT count(date) as pageview FROM $table_name WHERE feed<>'' AND date LIKE '".date("Ym")."%';");
	foreach ($qry as $rk) {
		print "<td>".$rk->pageview;
		if($prec<>0) {
			print " (";
			$pc=round(( 100 * ($rk->pageview) / $prec ) - 100,1);
			if($pc>=0) { print "+"; }
			print $pc."%)";
		}
		print "</td>\n";
	}

	$qry = $wpdb->get_results("SELECT count(date) as pageview FROM $table_name WHERE feed<>'' AND date = '".$yesterday."';");
	foreach ($qry as $rk) {
		print "<td>".$rk->pageview."</td>\n";
	}

	$qry = $wpdb->get_results("SELECT count(date) as pageview FROM $table_name WHERE feed<>'' AND date = '".date("Ymd")."';");
	foreach ($qry as $rk) {
		print "<td>".$rk->pageview."</td>\n";
	}

    print "</tr></table>";
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    # last 30 days graph
    print "<table width=100% border=0><tr><td>";
	$qry = $wpdb->get_row("SELECT count(date) as pageview, date FROM $table_name GROUP BY date HAVING date >= '".date('Ymd', time()-86400*30)."' ORDER BY pageview DESC LIMIT 1");
	$maxxday=$qry->pageview;
	if($maxxday == 0) { $maxxday = 1; }
	# Y
	$qry = $wpdb->get_results("SELECT date, feed, spider FROM $table_name WHERE date >= '".date('Ymd', time()-86400*30)."';");
	for($gg=30;$gg>=0;$gg--) {
		$tot_web=0; $tot_rss=0; $tot_spider=0; $tot=0;
		foreach ($qry as $rk) {
			if($rk->date == date('Ymd', time()-86400*$gg)) {
				$tot++;
				if($rk->feed == '') {
					if(empty($rk->spider) OR is_null($rk->spider)) {
						$tot_web++;
					} else {
						$tot_spider++;
					}
				} else {
					$tot_rss++;
				}
			}
		}
		print "<!a href='/?m=".$rk->date."' target=_new><div style='float:left;font-family:Helvetica;font-size:7pt;text-align:center;'>";
		print "<div style='background:#ffffff;width:30px;height:".(($maxxday-$tot_web-$tot_rss-$tot_spider)*100/$maxxday)."px;margin-right:2px;'></div>";
		print "<div style='background:$rss_color;width:30px;height:".($tot_rss*100/$maxxday)."px;margin-right:2px;'></div>";
		print "<div style='background:$spider_color;width:30px;height:".($tot_spider*100/$maxxday)."px;margin-right:2px;'></div>";
		print "<div style='background:$web_color;width:30px;height:".($tot_web*100/$maxxday)."px;margin-right:2px;'></div>";
				
		print "<div style='background:#448abd;width:32px;height:2px;'></div>";
		print "<!/a><br>";		
		print date('d/m', time()-86400*$gg);
	    print "</div>";
	}
	print "</td></tr></table>";
	print "</div>";


	# Tabella LAST
	print "<a name=lasthits></a>";
	print "<div class='wrap'><h2>Last hits</h2><table class='widefat'><thead><tr><th scope='col'>Date</th><th scope='col'>Time</th><th scope='col'>IP</th><th scope='col'>Domain</th><th scope='col'>Page</th><th scope='col'>OS</th><th scope='col'>Browser</th><th scope='col'>Feed</th></tr></thead>";
	print "<tbody id='the-list'>";	

	$fivesdrafts = $wpdb->get_results("SELECT * FROM $table_name WHERE (os<>'' OR feed<>'') order by id DESC $querylimit");
	foreach ($fivesdrafts as $fivesdraft) {
		print "<tr>";
		print "<td>". irihdate($fivesdraft->date) ."</td>";
		print "<td>". $fivesdraft->time ."</td>";
		print "<td>". $fivesdraft->ip ."</td>";
		print "<td>". $fivesdraft->nation ."</td>";
		print "<td>". $fivesdraft->urlrequested ."</td>";
		print "<td>". $fivesdraft->os . "</td>";
		print "<td>". $fivesdraft->browser . "</td>";
		print "<td>". $fivesdraft->feed . "</td>";
		print "</tr>";
	}
	print "</table></div>";
	
	# Feeds
	print "<a name=feeds></a>";
    iriValueTable("feed","Feeds",5);
    
	# Top days
    iriValueTable("date","Top days",5);

	# O.S.
    iriValueTable("os","O.S.");

	# Browser
    iriValueTable("browser","Browser");
	
	# SE
    iriValueTable("searchengine","Search engines");

	# Search terms
	print "<a name=searchterms></a>";
    iriValueTable("search","Top search terms",20);

	print "<div class='wrap'><h2>Last search terms</h2><table class='widefat'><thead><tr><th scope='col'>Date</th><th scope='col'>Time</th><th scope='col'>Terms</th><th scope='col'>Engine</th><th scope='col'>Result</th></tr></thead>";
	print "<tbody id='the-list'>";	
	$qry = $wpdb->get_results("SELECT date,time,referrer,urlrequested,search,searchengine FROM $table_name WHERE search<>'' ORDER BY id DESC $querylimit");
	foreach ($qry as $rk) {
		print "<tr><td>".irihdate($rk->date)."</td><td>".$rk->time."</td><td><a href='".$rk->referrer."'>".$rk->search."</a></td><td>".$rk->searchengine."</td><td><a href='".get_bloginfo('url')."/?".$rk->urlrequested."'>page viewed</a></td></tr>\n";
	}
	print "</table></div>";

	# Top referrer
	print "<a name=referrers></a>";
    iriValueTable("referrer","Top referrer",15);
    
	# Referrer
	print "<div class='wrap'><h2>Last Referrers</h2><table class='widefat'><thead><tr><th scope='col'>Date</th><th scope='col'>Time</th><th scope='col'>URL</th><th scope='col'>Result</th></tr></thead>";
	print "<tbody id='the-list'>";	
	$qry = $wpdb->get_results("SELECT date,time,referrer FROM $table_name WHERE ((referrer NOT LIKE '".get_settings('siteurl')."%') AND (referrer <>'')) ORDER BY id DESC $querylimit");
	foreach ($qry as $rk) {
		print "<tr><td>".irihdate($rk->date)."</td><td>".$rk->time."</td><td><a href='".$rk->referrer."'>".substr($rk->referrer,0,70)."...</a></td><td><a href='".get_bloginfo('url')."/?".$rk->urlrequested."'>page viewed</a></td></tr>\n";
	}
	print "</table></div>";

	# Last Agents
	print "<div class='wrap'><h2>Last Agents</h2><table class='widefat'><thead><tr><th scope='col'>Date</th><th scope='col'>Time</th><th scope='col'>Agent</th><th scope='col'>What</th></tr></thead>";
	print "<tbody id='the-list'>";	
	$qry = $wpdb->get_results("SELECT date,time,agent,os,browser,spider FROM $table_name WHERE (agent <>'') ORDER BY id DESC $querylimit");
	foreach ($qry as $rk) {
		print "<tr><td>".irihdate($rk->date)."</td><td>".$rk->time."</td><td>".$rk->agent."</td><td> ".$rk->os. " ".$rk->browser." ".$rk->spider."</td></tr>\n";
	}
	print "</table></div>";
	
	
	# Countries
    iriValueTable("nation","Countries (domains)",10);

	# Spider
	print "<a name=spiders></a>";
    iriValueTable("spider","Spiders");

	# Last pages
	print "<div class='wrap'><h2>Last Pages</h2><table class='widefat'><thead><tr><th scope='col'>Date</th><th scope='col'>Time</th><th scope='col'>Page</th><th scope='col'>What</th></tr></thead>";
	print "<tbody id='the-list'>";	
	$qry = $wpdb->get_results("SELECT date,time,urlrequested,os,browser,spider FROM $table_name WHERE (urlrequested <>'') ORDER BY id DESC $querylimit");
	foreach ($qry as $rk) {
		print "<tr><td>".irihdate($rk->date)."</td><td>".$rk->time."</td><td>".$rk->urlrequested."</td><td> ".$rk->os. " ".$rk->browser." ".$rk->spider."</td></tr>\n";
	}
	print "</table></div>";
    
	# Page requested
	print "<div class='wrap'><h2>Pages</h2><table class='widefat'><thead><tr><th scope='col'>Address</th><th scope='col'>Visits</th></tr></thead>";
	print "<tbody id='the-list'>";	
	$qry = $wpdb->get_results("SELECT count(urlrequested) as pageview,urlrequested FROM $table_name GROUP BY urlrequested ORDER BY pageview DESC $querylimit");
	foreach ($qry as $rk) {
		$out_url=$rk->urlrequested;
		if($out_url == '') { $out_url=get_bloginfo('url'); }
		if(substr($out_url,0,4)=="cat=") { $out_url="Category: ".get_cat_name(substr($out_url,4)); }
		if(substr($out_url,0,2)=="m=") { $out_url="Calendar: ".substr($out_url,6,2)."/".substr($out_url,2,4); }
		if(substr($out_url,0,2)=="p=") {
			$post_id_7 = get_post(substr($out_url,2), ARRAY_A);
			$out_url = $post_id_7['post_title'];
		}
		if(substr($out_url,0,8)=="page_id=") {
			$post_id_7=get_page(substr($out_url,8), ARRAY_A);
			#$out_url = "Page: ".$post_id_7['page_title'];
			$out_url = "Page: ".substr($out_url,8);
		}
		print "<tr><td>".$out_url."</td><td>" .$rk->pageview ."</td></tr>\n";
	}
	print "</table></div>";

}

# Converte da data us to default format di Wordpress
function irihdate($dt = "00000000") {
	return mysql2date(get_option('date_format'), substr($dt,0,4)."-".substr($dt,4,2)."-".substr($dt,6,2));
}

function irirgbhex($red, $green, $blue) {
    $red = 0x10000 * max(0,min(255,$red+0));
    $green = 0x100 * max(0,min(255,$green+0));
    $blue = max(0,min(255,$blue+0));
    // convert the combined value to hex and zero-fill to 6 digits
    return "#".str_pad(strtoupper(dechex($red + $green + $blue)),6,"0",STR_PAD_LEFT);
}

function iriValueTable($fld,$fldtitle,$limit = 0) {
	global $wpdb;
	$table_name = $wpdb->prefix . "statpress";
	print "<div class='wrap'><h2>$fldtitle</h2><table class='widefat'><thead><tr><th scope='col' width=300>$fldtitle</th><th scope='col' width=150>Visits</th><th scope='col' width=150>%</th><th></th></tr></thead>";
	print "<tbody id='the-list'>";
	$rks = $wpdb->get_var("SELECT count($fld) as rks FROM $table_name WHERE $fld<>'';");
	if($rks > 0) {
		$sql="SELECT count($fld) as pageview, $fld FROM $table_name WHERE $fld<>'' GROUP BY $fld ORDER BY pageview DESC";
		if($limit > 0) { $sql=$sql." LIMIT $limit"; }
		$qry = $wpdb->get_results($sql);
#	    $tdwidth=450; $red=0; $green=200; $blue=0; $deltacolor=round(250/count($qry),0);
	    $tdwidth=450; $red=131; $green=180; $blue=216; $deltacolor=round(250/count($qry),0);

		foreach ($qry as $rk) {
			$pc=round(($rk->pageview*100/$rks),1);
			if($fld == 'date') { $rk->$fld = irihdate($rk->$fld); }
        	print "<tr><td>".$rk->$fld."</td><td>".$rk->pageview."</td><td>$pc%</td><td>";
	        print "<div style='text-align:right;font-family:helvetica;font-size:7pt;font-weight:bold;height:10px;width:".($tdwidth*$pc/100)."px;background:".irirgbhex($red,$green,$blue).";border-top:2px solid ".irirgbhex($red+20,$green+20,$blue).";border-right:2px solid ".irirgbhex($red+30,$green+30,$blue).";border-bottom:2px solid ".irirgbhex($red-20,$green-20,$blue).";'>&nbsp;$pc%&nbsp;</div>";
    	    print "</td></tr>\n";
        	$red=$red+$deltacolor; $blue=$blue-($deltacolor/2);
		}
	}
	print "</table></div>";
}


function iriDomain($ip) {
	$host=gethostbyaddr($ip);
    if (ereg('^([0-9]{1,3}\.){3}[0-9]{1,3}$', $host)) {
    	return "";
    } else {
	    return substr(strrchr($host,"."),1);
	}
}

function iriGetQueryPairs($url){
$parsed_url = parse_url($url);
$tab=parse_url($url);
$host = $tab['host'];
if(key_exists("query",$tab)){
 $query=$tab["query"];
 return explode("&",$query);
}
else{return null;}
}


function iriGetOS($arg){
    $arg=str_replace(" ","",$arg);
	$lines = file(ABSPATH.'wp-content/plugins/wp-statpress/def/os.dat');
	foreach($lines as $line_num => $os) {
		list($nome_os,$id_os)=explode("|",$os);
		if(strpos($arg,$id_os)===FALSE) continue;
    	return $nome_os; // riconosciuto
	}
    return '';
}


function iriGetBrowser($arg){
    $arg=str_replace(" ","",$arg);
	$lines = file(ABSPATH.'wp-content/plugins/wp-statpress/def/browser.dat');
	foreach($lines as $line_num => $browser) {
		list($nome,$id)=explode("|",$browser);
		if(strpos($arg,$id)===FALSE) continue;
    	return $nome; // riconosciuto
	}
    return '';
}

function iriGetSE($referrer = null){
	$key = null;
	$lines = file(ABSPATH.'wp-content/plugins/wp-statpress/def/searchengines.dat');
	foreach($lines as $line_num => $se) {
		list($nome,$url,$key)=explode("|",$se);
		if(strpos($referrer,$url)===FALSE) continue;
		# trovato se
		$variables = iriGetQueryPairs($referrer);
		$i = count($variables);
		while($i--){
		   $tab=explode("=",$variables[$i]);
			   if($tab[0] == $key){return ($nome."|".urldecode($tab[1]));}
		}
	}
	return null;
}

function iriGetSpider($agent = null){
    $agent=str_replace(" ","",$agent);
	$key = null;
	$lines = file(ABSPATH.'wp-content/plugins/wp-statpress/def/spider.dat');
	foreach($lines as $line_num => $spider) {
		list($nome,$key)=explode("|",$spider);
		if(strpos($agent,$key)===FALSE) continue;
		# trovato
		return $nome;
	}
	return null;
}

function iriCreateTable() {
	global $wpdb;
	global $wp_db_version;
	$table_name = $wpdb->prefix . "statpress";
	$sql_createtable = "CREATE TABLE " . $table_name . " (
	id mediumint(9) NOT NULL AUTO_INCREMENT,
	date text,
	time text,
	ip text,
	urlrequested text,
	agent text,
	referrer text,
	search text,
	nation text,
	os text,
	browser text,
	searchengine text,
	spider text,
	feed text,
	UNIQUE KEY id (id)
	);";
	if($wp_db_version >= 5540)	$page = 'wp-admin/includes/upgrade.php';  
								else $page = 'wp-admin/upgrade'.'-functions.php';
	require_once(ABSPATH . $page);
	dbDelta($sql_createtable);	
}

function iriStatAppend($feed='') {
	global $wpdb;
	$table_name = $wpdb->prefix . "statpress";
	# Raccoglie le informazioni
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    $urlRequested = (isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '' );
    $referrer = (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
    $userAgent = (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');
    
	$vdate  = date("Ymd");
	$vtime  = date("H:i:s");
	
	$os=iriGetOS($userAgent);
	$browser=iriGetBrowser($userAgent);
	list($searchengine,$search_phrase)=explode("|",iriGetSE($referrer));
	$spider=iriGetSpider($userAgent);
	if($spider != '') { $os=''; $browser=''; }
    if ( !is_user_logged_in() ) {
		# Crea/aggiorna tabella se non esiste
		$table_name = $wpdb->prefix . "statpress";
		if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
			iriCreateTable();
		}
		$insert = "INSERT INTO " . $table_name .
            " (date, time, ip, urlrequested, agent, referrer, search,nation,os,browser,searchengine,spider,feed) " .
            "VALUES ('$vdate','$vtime','$ipAddress','$urlRequested','$userAgent','$referrer','$search_phrase','".iriDomain($ipAddress)."','$os','$browser','$searchengine','$spider','$feed')";
		$results = $wpdb->query( $insert );
	}
}

function iriStatAppendRSS() { iriStatAppend('RSS'); }
function iriStatAppendRSS2() { iriStatAppend('RSS2'); }
function iriStatAppendATOM() { iriStatAppend('ATOM'); }
function iriStatAppendRDF() { iriStatAppend('RDF'); }


function iriStatPressUpdate() {
	global $wpdb;
	$table_name = $wpdb->prefix . "statpress";
	
	$wpdb->show_errors();
	# update table
	print "Updating table struct $table_name... ";
	iriCreateTable();
	print "done<br>";
	
	# Update OS
	print "Updating OSes... ";
    $wpdb->query("UPDATE $table_name SET os = '';");
	$lines = file(ABSPATH.'wp-content/plugins/wp-statpress/def/os.dat');
	foreach($lines as $line_num => $os) {
		list($nome_os,$id_os)=explode("|",$os);
		$qry="UPDATE $table_name SET os = '$nome_os' WHERE os='' AND replace(agent,' ','') LIKE '%".$id_os."%';";
		$wpdb->query($qry);
	}
	print "done<br>";
	
	# Update Browser
	print "Updating Browsers... ";
    $wpdb->query("UPDATE $table_name SET browser = '';");
	$lines = file(ABSPATH.'wp-content/plugins/wp-statpress/def/browser.dat');
	foreach($lines as $line_num => $browser) {
		list($nome,$id)=explode("|",$browser);
		$qry="UPDATE $table_name SET browser = '$nome' WHERE browser='' AND replace(agent,' ','') LIKE '%".$id."%';";
		$wpdb->query($qry);
	}
	print "done<br>";

	# Update Spider
	print "Updating Spiders... ";
    $wpdb->query("UPDATE $table_name SET spider = '';");
	$lines = file(ABSPATH.'wp-content/plugins/wp-statpress/def/spider.dat');
	foreach($lines as $line_num => $spider) {
		list($nome,$id)=explode("|",$spider);
		$qry="UPDATE $table_name SET spider = '$nome',os='',browser='' WHERE spider='' AND replace(agent,' ','') LIKE '%".$id."%';";
		$wpdb->query($qry);
	}
	print "done<br>";

	# Update feed to ''
	print "Updating Feeds... ";
	$wpdb->query("UPDATE $table_name SET feed = '' WHERE isnull(feed);");	
	print "done<br>";
	
	# Update Search engine
	print "Updating Search engines... ";
	print "<br>";
	$wpdb->query("UPDATE $table_name SET searchengine = '', search='';");
	print "...null-ed!<br>";
	$qry = $wpdb->get_results("SELECT id, referrer FROM $table_name");
	print "...select-ed!<br>";
	foreach ($qry as $rk) {
		list($searchengine,$search_phrase)=explode("|",iriGetSE($rk->referrer));
		if($searchengine <> '') {
			$q="UPDATE $table_name SET searchengine = '$searchengine', search='$search_phrase' WHERE id=".$rk->id;
			print " - $q<br>";
			$wpdb->query($q);
		}
	}
	print "done<br>";
	
	$wpdb->hide_errors();
	
	print "<br>&nbsp;<h1>Updated!</h1>";
}

    
    
function widget_statpress_init($args) {
	// Check for the required API functions
	if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
		return;

	function widget_statpress_control() {
		$options = get_option('widget_statpress');
		if ( !is_array($options) )
			$options = array('title'=>'StatPress', 'body'=>'Visits today: %visits%');
		if ( $_POST['statpress-submit'] ) {

			// Remember to sanitize and format use input appropriately.
			$options['title'] = strip_tags(stripslashes($_POST['statpress-title']));
			$options['body'] = stripslashes($_POST['statpress-body']);
			update_option('widget_statpress', $options);
		}
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$body = htmlspecialchars($options['body'], ENT_QUOTES);
		// the form
		echo '<p style="text-align:right;"><label for="statpress-title">' . __('Title:') . ' <input style="width: 250px;" id="statpress-title" name="statpress-title" type="text" value="'.$title.'" /></label></p>';
		echo '<p style="text-align:right;"><label for="statpress-body"><div>' . __('Body:', 'widgets') . '</div><textarea style="width: 288px;height:100px;" id="statpress-body" name="statpress-body" type="textarea">'.$body.'</textarea></label></p>';
		echo '<input type="hidden" id="statpress-submit" name="statpress-submit" value="1" />Use %visits% %os% %browser% %ip%';
	}
	
	// main widget function
	function widget_statpress($args) {
	    extract($args);
		$options = get_option('widget_statpress');
		$title = $options['title'];
		$body = $options['body'];
		
    	global $wpdb;
   		$table_name = $wpdb->prefix . "statpress";
    	echo $before_widget;
    	print($before_title . $title . $after_title);
		# Query table...
		$qry = $wpdb->get_results("SELECT count(DISTINCT(ip)) as pageview FROM $table_name WHERE date = '".date("Ymd")."';");
		foreach ($qry as $rk) {
			$body = str_replace("%visits%", $rk->pageview, $body);
		}
        $userAgent = (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');
       	$os=iriGetOS($userAgent);
       	$body = str_replace("%os%", $os, $body);
		$browser=iriGetBrowser($userAgent);
       	$body = str_replace("%browser%", $browser, $body);
   	    $ipAddress = $_SERVER['REMOTE_ADDR'];
       	$body = str_replace("%ip%", $ipAddress, $body);
		print $body;
	    echo $after_widget;
    }
   	register_sidebar_widget('StatPress', 'widget_statpress');
	register_widget_control(array('StatPress', 'widgets'), 'widget_statpress_control', 300, 200);

}

  
add_action('admin_menu', 'iri_add_pages');
add_action('plugins_loaded', 'widget_statpress_init');
add_action('wp_head', 'iriStatAppend');

add_action('rss_head','iriStatAppendRSS');
add_action('rss2_head','iriStatAppendRSS2');
add_action('rdf_header','iriStatAppendRDF');
add_action('atom_head','iriStatAppendATOM');


?>
