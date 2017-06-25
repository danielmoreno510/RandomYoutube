<?php
    $video = $_GET["dato"];
	if ($video!="") {
		// echo "<a href=\"http://youtube.com/watch?v=".$videoId."\">".$videoId."</a>";
		$content = file_get_contents("http://youtube.com/get_video_info?video_id=" . $video);
		parse_str($content, $ytarr);
		$title = $ytarr['title']; // title
		$time = number_format($ytarr['length_seconds']/60, 2, '.', '');
		$author = $ytarr['author'];

		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$datos=array('status'=>'success','video'=>$video,'title'=>$title,'author'=>$author,'time'=>$time);
		echo json_encode($datos);
	} else {
		echo -1;
	}
?>