<?
include_once("_link.php");

$wr_id = $_REQUEST['wr_id'];
$bo_table = $_REQUEST['bo_table'];


$sql = "SELECT * FROM boardTable WHERE b_id = ".$wr_id." ORDER BY b_writeday DESC";
$write = mysql_fetch_array(mysql_query($sql));
$title        = htmlspecialchars($write['b_subject']);
$author       = htmlspecialchars($write['b_writerName']);
$published    = date('Y-m-d\TH:i:s\+09:00', strtotime($write['b_writeday']));
$updated      = $published;
$link_href    = "http://gsi123.mireene.com/sub.php?ck=B&amp;id=".$write['board_id'];//"http://gsi123.mireene.com/board/board.php?boardID=".$write['board_id']."&amp;board=".$write['b_category']; 
$id           = $link_href . "&amp;b_idx=".$write['b_id'];
$link_title   = $write['b_category'];
$feed_updated = date('Y-m-d\TH:i:s\+09:00', time());

$find         = array('&amp;', '&nbsp;'); # 찾아서
$replace      = array('&', ' '); # 바꾼다

$content      = str_replace( $find, $replace, $write['b_contents'] );
$summary      = str_replace( $find, $replace, strip_tags($write['b_contents']) );

Header("Content-type: text/xml"); 
header("Cache-Control: no-cache, must-revalidate"); 
header("Pragma: no-cache"); 

echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<feed xmlns=\"http://webmastertool.naver.com\">\n";
echo "<id>http://gsi123.mireene.com</id>\n";
echo "<title>naver syndication feed document</title>\n";
echo "<author>\n";
    echo "<name>webmaster</name>\n";
echo "</author>\n";

echo "<updated>{$feed_updated}</updated>\n";

echo "<link rel=\"site\" href=\"http://gsi123.mireene.com\" title=\"orionnet\" />\n";
echo "<entry>\n";
    echo "<id>{$id}</id>\n";
    echo "<title><![CDATA[{$title}]]></title>\n";
    echo "<author>\n";
        echo "<name>{$author}</name>\n";
    echo "</author>\n";
    echo "<updated>{$updated}</updated>\n";
    echo "<published>{$published}</published>\n";
    echo "<link rel=\"via\" href=\"{$link_href}\" title=\"{$link_title}\" />\n";
    echo "<link rel=\"mobile\" href=\"{$id}\" />\n";
	echo "<content type=\"html\"><![CDATA[{$content}]]></content>\n";
    echo "<summary type=\"text\"><![CDATA[{$summary}]]></summary>\n";
    echo "<category term=\"{$bo_table}\" label=\"{$link_title}\" />\n";
echo "</entry>\n";
echo "</feed>";

?>