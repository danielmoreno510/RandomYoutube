<?php
	$consult="";
	$language = $_GET["lan"];
	if($language!="0"){
		$consult="&relevanceLanguage=".$language.$consult;
	}
	$duration = $_GET["dur"];
	if($duration!="0"){
		$consult="&videoDuration=".$duration.$consult;
	}
	$category = $_GET["cat"];
	if($category!="0"){
		$consult="&videoCategoryId=".$category.$consult;
	}
	$search = $_GET["sea"];

	$key = 'you api key youtube';
	$cs = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, '-', '_'];
	$vids = [];
	$video = '';
	// try to find a video 10 times
	for ($k = 1; $k <= 10; $k++) {
		$query = '';
		// get 4 char random string
		for ($i = 1; $i <= 4; $i++) {
			$query .= $cs[rand(0, sizeof($cs) - 1)];
		}
		//$querystring = 'v%3D' . $q;
		$url = 'https://www.googleapis.com/youtube/v3/search?part=id&maxResults=50&videoEmbeddable=true&type=video&q='.$query.'&key='.$key.$consult;
		if($search!="n"){
			$search= str_replace(' ','-',$search); 
			$url = 'https://www.googleapis.com/youtube/v3/search?part=id&maxResults=50&videoEmbeddable=true&type=video&q='.$search.'&key='.$key.$consult;
		}
		
		$resp = file_get_contents($url);
		$a = json_decode($resp, true);
		if ($a["pageInfo"]["totalResults"] > 50) {
			// continue?
		}
		if ($a["pageInfo"]["totalResults"] == 0) {
			// nothing found
			continue;
		}

		if($search!="n"){
			foreach ($a["items"] as $item) {
				if (($item["id"]["videoId"]) !== false) {
					$vids[] = $item["id"]["videoId"];
				} else {
					// q was somewhere else like description etc -> ignore video
				}
			}
		}else{
			foreach ($a["items"] as $item) {
				if (stripos($item["id"]["videoId"], $query) !== false) {
					// q in vid id
					$vids[] = $item["id"]["videoId"];
				} else {
					// q was somewhere else like description etc -> ignore video
				}
			}
		}

		if (sizeof($vids) > 0) {
			break;
		} else {
			// nothing found
			continue;
		}
	}
	if (sizeof($vids) > 0) {
		$videoId = $vids[rand(0, sizeof($vids) - 1)];
		// echo "<a href=\"http://youtube.com/watch?v=".$videoId."\">".$videoId."</a>";
		$content = file_get_contents("http://youtube.com/get_video_info?video_id=" . $videoId);
		parse_str($content, $ytarr);

		if($search!="n"){
			$title = $search;
			$time = "time";
			$author = "author";
		}else{
			$title = $ytarr['title']; // title
			$time = number_format($ytarr['length_seconds']/60, 2, '.', '');
			$author = $ytarr['author'];
		}

		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$datos=array('status'=>'success','video'=>$videoId,'title'=>$title,'author'=>$author,'time'=>$time);
		echo json_encode($datos);
	} else {
		echo -1;
	}
?>