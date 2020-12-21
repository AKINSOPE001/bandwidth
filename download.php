<?php
session_start();
    
    function checkLogin()
    {
        if( !isset( $_SESSION['user_id'] ) )
        {
            header("location: index.php");
        }
    }

function dl_file_resumable($file, $is_resume=TRUE, $dbnd)
{
    //First, see if the file exists
    if (!is_file($file))
    {
        die("<b>404 File not found!</b>");
    }

    //Gather relevent info about file
    $size = filesize($file);
    $fileinfo = pathinfo($file);
    
    //workaround for IE filename bug with multiple periods / multiple dots in filename
    //that adds square brackets to filename - eg. setup.abc.exe becomes setup[1].abc.exe
    $filename = (strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE')) ?
                  preg_replace('/\./', '%2e', $fileinfo['basename'], substr_count($fileinfo['basename'], '.') - 1) :
                  $fileinfo['basename'];
    
    $file_extension = strtolower($path_info['extension']);

    //This will set the Content-Type to the appropriate setting for the file
    switch($file_extension)
    {
        case 'exe': $ctype='application/octet-stream'; break;
        case 'zip': $ctype='application/zip'; break;
        case 'mp3': $ctype='audio/mpeg'; break;
        case 'mpg': $ctype='video/mpeg'; break;
        case 'avi': $ctype='video/x-msvideo'; break;
        default:    $ctype='application/force-download';
    }

    //check if http_range is sent by browser (or download manager)
    if($is_resume && isset($_SERVER['HTTP_RANGE']))
    {
        list($size_unit, $range_orig) = explode('=', $_SERVER['HTTP_RANGE'], 2);

        if ($size_unit == 'bytes')
        {
            //multiple ranges could be specified at the same time, but for simplicity only serve the first range
            //http://tools.ietf.org/id/draft-ietf-http-range-retrieval-00.txt
            list($range, $extra_ranges) = explode(',', $range_orig, 2);
        }
        else
        {
            $range = '';
        }
    }
    else
    {
        $range = '';
    }

    //figure out download piece from range (if set)
    list($seek_start, $seek_end) = explode('-', $range, 2);

    //set start and end based on range (if set), else set defaults
    //also check for invalid ranges.
    $seek_end = (empty($seek_end)) ? ($size - 1) : min(abs(intval($seek_end)),($size - 1));
    $seek_start = (empty($seek_start) || $seek_end < abs(intval($seek_start))) ? 0 : max(abs(intval($seek_start)),0);

    //add headers if resumable
    if ($is_resume)
    {
        //Only send partial content header if downloading a piece of the file (IE workaround)
        if ($seek_start > 0 || $seek_end < ($size - 1))
        {
            header('HTTP/1.1 206 Partial Content');
        }

        header('Accept-Ranges: bytes');
        header('Content-Range: bytes '.$seek_start.'-'.$seek_end.'/'.$size);
    }

    //headers for IE Bugs (is this necessary?)
    //header("Cache-Control: cache, must-revalidate");   
    //header("Pragma: public");

    header('Content-Type: ' . $ctype);
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-Length: '.($seek_end - $seek_start + 1));

    //open the file
    $fp = fopen($file, 'rb');
    //seek to start of missing part
    fseek($fp, $seek_start);
// set the download rate limit (=> 20,5 kb/s)
$download_rate = $dbnd;

    //start buffered download
    while(!feof($fp))
    {
        //reset time limit for big files
        set_time_limit(0);
        print(fread($fp, round($download_rate * 1024)));
        flush();
        ob_flush();
    }

    fclose($fp);
    exit;
}

if(isset($_GET['f']))
{
	// local file that should be send to the client
	$local_file = $_GET['f'];
}
include 'db.php';
$q = "SELECT policy FROM bandwidth_policy";
$r = mysql_query($q) or die(mysql_error());
$row = mysql_fetch_array($r);
list($policy) = $row;

dl_file_resumable($local_file, $is_resume=TRUE, $policy);

/*	
$path_parts = pathinfo($local_file);

$ext = $path_parts['extension'];

$dfile =  basename($local_file, '.'.$ext);

// filename that the user gets as default
$download_file = $dfile.'_dwn.'.$ext;
 
// set the download rate limit (=> 20,5 kb/s)
$download_rate = 20;
 
if(file_exists($local_file) && is_file($local_file)) {
 
    // send headers
    header('Cache-control: private');
    header('Content-Type: application/octet-stream');
    header('Content-Length: '.filesize($local_file));
    header('Content-Disposition: filename='.$download_file);
 
    // flush content
    flush();
 
    // open file stream
    $file = fopen($local_file, "r");
 
    while (!feof($file)) {
 
        // send the current file part to the browser
        print fread($file, round($download_rate * 1024));
 
        // flush the content to the browser
        flush();
 
        // sleep one second
        sleep(1);
    }
 
    // close file stream
    fclose($file);
 
}
else {
    die('Error: The file '.$local_file.' does not exist!');
}*/
?>