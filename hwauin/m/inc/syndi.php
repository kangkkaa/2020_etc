<?


function naver_syndi_ping($bo_table, $wr_id)
{
	$sqlsy = "SELECT * FROM syndication WHERE idx = 1";
	$rssy = mysql_fetch_array(mysql_query($sqlsy));
	$siteUrl = $rssy['url'];

    $token = trim($siteUrl);

    // ��ū���� ���ٸ� ���̹� �ŵ����̼� ������
    if ($token == '') return 0;
    
    // ��ū�� ���̴� 112 �����Դϴ�.
//    if (strlen($token) != 112) return -1;

    // curl library �� �����Ǿ�� �մϴ�.
    if (!function_exists('curl_init')) return -2;


    $ping_auth_header = "Authorization: Bearer " . $token;
    $ping_url = urlencode("http://gsi123.mireene.com/ping.php?bo_table={$bo_table}&wr_id={$wr_id}");
    $ping_client_opt = array( 
        CURLOPT_URL => "https://apis.naver.com/crawl/nsyndi/v2", 
        CURLOPT_POST => true, 
        CURLOPT_POSTFIELDS => "ping_url=" . $ping_url, 
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 10, 
        CURLOPT_TIMEOUT => 10, 
        CURLOPT_HTTPHEADER => array("Host: apis.naver.com", "Pragma: no-cache", "Accept: */*", $ping_auth_header)
    ); 

    $ping = curl_init(); 
    curl_setopt_array($ping, $ping_client_opt); 
    $response = curl_exec($ping); 
    curl_close($ping);
//print_r2($ping_client_opt); exit;
    return $response;
}
?>