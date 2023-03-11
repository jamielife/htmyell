��d<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":23:{s:2:"ID";s:3:"226";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2010-05-14 08:30:31";s:13:"post_date_gmt";s:19:"2010-05-14 12:30:31";s:12:"post_content";s:6129:"<img src="https://htmyell.com/wp-content/uploads/2010/07/afog.jpg" />
<p>Yep, that's right... yet another social media plug-on for Zen Cart. This one, automatically generates Open Graph Tags in your header. As well all know Open Graph is supposed to be a way of the future. Some people even projecting that it will change the way we use the web. Well Im not sure about that, however, not to be left in the past I created this little bit of script for everyone's favorite e-commerce solution.</p>

<p>This little bit of code allows you to integrate the new Facebook Open Social Graph API into your store's header info.</p>

<p>The following code goes in your html_header.php file located in your: includes/templates/YOUR_TEMPLATE_NAME/common/ directory right under the title tags. Which should be around line 25 and look like this:</p>

<pre>[php gutter="false"]&lt;title&gt;&lt;?php echo META_TAG_TITLE; ?&gt;&lt;/title&gt;[/php]</pre><br /><br />

<p>And this gets pasted under it:</p>
<pre>[php gutter="false"]
&lt;?php
################ start of AutoOpenGraph ###################

$store_name = &quot;Htmyell&quot;; //e.g. &quot;Samanthas Power Tools&quot;, or &quot;Gus' China Shop&quot;.
$store_url = &quot;https://www.htmyell.com&quot;; //url to your store (no trailing '/')
$product_type = &quot;product&quot;; //type of product you're selling (see tutorial)
$use_addr = 0; //use address? if yes, set $use_addr = 1; (no quotes). edit lines 31-34.
$use_email = 0; //use email address? if yes, set $use_email = 1; (no quotes) edit line 37.
$use_phone = 0; //use phone number? if yes, set $use_phone = 1; (no quotes) edit line 40.

//if $use_addr is set to 1;
$street = &quot;123 Main St&quot;;  //change to your street address.
$city = &quot;Richmond&quot;; //your city
$state = &quot;VA&quot;; //Your State. Facebook exaple uses abbreviation.
$zip = &quot;23220&quot;; //you're zip/postal code.
$country = &quot;USA&quot;; //your country. Facebook example uses acronym.

//if $use_email is set to 1;
$email_address = &quot;yourEmail@yoursite.com&quot;; // your email

//if use_phone is set to 1
$phone_number = &quot;+1-800-555-1234&quot;; //format: +country code - area code - number.

//no need to edit below this line:
extract($product_info_metatags-&gt;fields);
extract($category_metatags-&gt;fields);
$prod_url = &quot;http://&quot; . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

//get defined image or default
$myImage= zen_get_products_image((int)$_GET['products_id']);
$img = simplexml_load_string($myImage);
$img = $img['src'];
if($this_is_home_page){ $depends = $store_name; $product_type = &quot;website&quot;; }
else if ($categories_name){  $depends = $categories_name; $product_type = &quot;website&quot;;  }
else if ($products_name){ $depends = $products_name; }
else { $depends = META_TAG_TITLE; $product_type = &quot;website&quot;; }
//print_r($product_info_metatags);
################# end of AutoOpenGraph ####################

?&gt;
&lt;!-- start of AutoOpenGraph tags --&gt;
&lt;meta property=&quot;og:title&quot; content=&quot;&lt;?php echo $depends; ?&gt;&quot; /&gt;
&lt;meta property=&quot;og:type&quot; content=&quot;&lt;?php echo $product_type; ?&gt;&quot; /&gt;
&lt;meta property=&quot;og:url&quot; content=&quot;&lt;?php echo $prod_url; ?&gt;&quot; /&gt;
&lt;meta property=&quot;og:image&quot; content=&quot;&lt;?php echo $store_url . '/' . $img; ?&gt;&quot; /&gt;
&lt;meta property=&quot;og:description&quot; content=&quot;&lt;?php echo META_TAG_DESCRIPTION; ?&gt;&quot; /&gt;
&lt;meta property=&quot;og:site_name&quot; content=&quot;&lt;?php echo $store_name; ?&gt;&quot; /&gt;
&lt;?php
if($use_addr){
echo '&lt;meta property=&quot;og:street-address&quot; content=&quot;'.$street.'&quot; /&gt;'.&quot;\n&quot;;
echo '&lt;meta property=&quot;og:locality&quot; content=&quot;'.$city.'&quot; /&gt;'.&quot;\n&quot;;
echo '&lt;meta property=&quot;og:region&quot; content=&quot;'.$state.'&quot; /&gt;'.&quot;\n&quot;;
echo '&lt;meta property=&quot;og:postal-code&quot; content=&quot;'.$zip.'&quot; /&gt;'.&quot;\n&quot;;
echo '&lt;meta property=&quot;og:country-name&quot; content=&quot;'.$country.'&quot; /&gt;'.&quot;\n&quot;;
}
if($use_email){
echo '&lt;meta property=&quot;og:email&quot; content=&quot;'.$email_address.'&quot; /&gt;'.&quot;\n&quot;;
}
if($use_phone){
echo '&lt;meta property=&quot;og:phone_number&quot; content=&quot;'.$phone_number.'&quot; /&gt;'.&quot;\n&quot;;
}
?&gt;[/php]</pre><br /><br /><h3>Configuration</h3><p>Obviously you're going to want to configure this a bit. Here's how:</p><ol><li>on the first line you're going to want to change $store_name to the name of your store.</li><li>$store_url should be the http path to your store (e.g. <a href="http://www.mystore.com">http://www.mystore.com</a>) with no trailing '/'slash.</li><li>$product_type will usually be left alone it's used for Facebook's own categorizing purposes. However you can see what categories you're allowed to use @ <a href="http://opengraphprotocol.org/#types">http://opengraphprotocol.org/#types</a>.</li><li>$use_addr, $use_email, and $use_phone are set to 0 by default (this means they're off) however if you'd like to turn them on, set them to 1. So if you wanted to have your email address used by Facebook you'd set $use_email = 1; then edit the section that says "if email is set to 1" with your personal information. Do this for any of the info you change to 1. Otherwise just leave the info alone. There is no need to delete it as it wont be executed unless set to 1.</li></ol><p>For the image sent to facebook, the script is set up to use your product's main image. However if someone tries to share your home page (or any page that isn't a product page) the script will search for a product image and upon not finding one will use your zen cart default no product image. Due to this, I recomend changing the default no_image.gif to your companie's logo. In your zen cart admin go to Configuration -&gt; Images -&gt; Product Image - No image picture, and change it to an image of your company's logo.</p>";s:10:"post_title";s:28:"AutoFacebookOG for Zen Cart.";s:12:"post_excerpt";s:622:"<img src="https://htmyell.com/wp-content/uploads/2010/07/afog.jpg" />
<p>Yep, that's right... yet another social media plug-on for Zen Cart. This one, automatically generates Open Graph Tags in your header. As well all know Open Graph is supposed to be a way of the future. Some people even projecting that it will change the way we use the web. Well Im not sure about that, however, not to be left in the past I created this little bit of script for everyone's favorite e-commerce solution.</p>
<p>This little bit of code allows you to integrate the new Facebook Open Social Graph API into your store's header info.</p>";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:6:"closed";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:38:"autofacebookog-open-graph-for-zen-cart";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2017-06-22 15:42:02";s:17:"post_modified_gmt";s:19:"2017-06-22 19:42:02";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";s:1:"0";s:4:"guid";s:26:"https://htmyell.com/?p=226";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"2";}}