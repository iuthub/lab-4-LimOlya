<?php
    function get_size($filesize){
        if ($filesize < 1024)
            $filesize = '(' . $filesize . ' b)';
		else if ($filesize > 1024 && $filesize < 1024*1024)
            $filesize = '(' . number_format($filesize/1024, 2) . ' kb)';
		else if ($filesize > 1024*1024)
            $filesize = '(' . number_format($filesize/1024/1024, 2) . ' mb)';
        return $filesize;
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
    </head>
    
	<body>

		<div id="header">
			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
            <a href="music.php"><input type="submit" value="Display all files"></a>
		</div>

		<div id="listarea">
			<ul id="musiclist">

                <?php                              
                    if (isset($_REQUEST['playlist'])){
                        $picked_playlist_file = $_REQUEST['playlist'];

                        $playlist_songs = file('songs/' . $picked_playlist_file);

                        foreach ($playlist_songs as $song){
                            $song = trim($song);
                ?>
                            <li class="mp3item">
                                <a href="songs/<?=$song?>"><?=basename($song)?></a>
                                <?=get_size(filesize('songs/' . $song));?>
                            </li>
                <?php
                        }
                    }
                    else {
                        $songs = glob('songs/*.mp3');
                        $playlists = glob('songs/*.txt');
                    
                        foreach ($songs as $song){
                ?>
                            <li class="mp3item">
                                <a href="<?=$song?>"><?=basename($song)?></a>
                                <?=get_size(filesize($song));?>
                            </li>
                <?php
                        }
                ?>

                <?php
                        foreach ($playlists as $playlist){
                ?>
                            <li class="playlistitem">
                                <a href="<?=$playlist?>"><?=basename($playlist)?></a>
                                <?=get_size(filesize($playlist));?>
                            </li>
                <?php
                        }
                    }
                ?>
			</ul>
		</div>  
	</body>
</html>
