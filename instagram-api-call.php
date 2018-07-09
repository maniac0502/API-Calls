<?php 

$userid = "************"; // User ID
$accessToken = "*************************************"; // User Access Token

// Get our data
function fetchData($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}
// Pull and parse data.
$result = fetchData("https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$accessToken}");
$result = json_decode($result);

$limit = 5; // Amount of images to show 
$i = 1; 
$insta_posts = $result->data; ?>

<div class="twitter-feed" align="center">
	<?php
	foreach( $insta_posts as $insta_post ):
		if( $i < $limit ):
			$link = $insta_post->link;
			$source = $insta_post->images->standard_resolution->url; ?>
				<a href="<?php echo $link; ?>" target="_blank">
					<img src="<?php echo $source; ?>" width="500" height="500">
				</a>			
			<?php
			$i++; 
		endif; 
	endforeach; ?>
</div>

<?php get_footer(); ?>