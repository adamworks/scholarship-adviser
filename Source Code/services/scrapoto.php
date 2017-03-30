<?php
require_once ("config.php");
//require_once ("simple_html_dom.php"); // include library simple html dom
//require_once ("ambildata.php"); //include class pencari link	
//require_once ("ambildatak.php"); //include class pencari konten
require_once ("fungsidb.php"); 

	ini_set('user_agent', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36');
	ini_set('max_execution_time', 0);
	ini_set('max_input_time', 0);

	ini_set('memory_limit', '1024M');
	set_time_limit(0);
	
	$grab = new yqlsearch();	
	$link = $grab->routing();
		
		if(count($link) > 0){ 
		for ($row = 0; $row < count($link); $row++)
			{
					$beasiswa = save_konten($link[$row]['domain'],$kategori_id, $link[$row]['alamat'], $link[$row]['judul'], $link[$row]['deadline'], $link[$row]['univ'], $link[$row]['negara'],$link[$row]['konten'],$link[$row]['jurusan'],$link[$row]['thumb'],$link[$row]['image']);
						//save _img($result['image'],$imgName);
					
					//echo "sukses";
			}	
		}

	
class yqlsearch
{
	public $page;
	private $jur;
	private $neg;
	private $kat;
	
	public function routing()
	{
		ini_set('user_agent', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36');
		ini_set('max_execution_time', 0);
		ini_set('max_input_time', 0);
	
		ini_set('memory_limit', '1024M');
		set_time_limit(0);
		
		$result = $this->scholars4dev();
		return $result;
	}

	function alamat_website_kategori($id_website){
		$sql = mysql_query("SELECT id_url FROM db_url WHERE id_url = '$id_website'");
		if(mysql_num_rows($sql) == 1){      
			$row = mysql_fetch_row($sql);
			return $row[0];
		}
		else{
			return false;
		}		
	}

	public function scholars4dev()
	{
		
$result = array(array('domain'=>'','alamat'=>'','judul'=>'','deadline'=>'','univ'=>'','negara'=>'','konten'=>'','jurusan'=>'','thumb'=>'','image'=>''));
$url = "SELECT * FROM html WHERE url='http://afterschool.my/scholarship/' AND xpath='//*[@id=\"scholarship_latest_list\"]//li[position()>1]'";
				
					$path = "http://query.yahooapis.com/v1/public/yql?q=";
					$path .= urlencode($url);
					$path .= "&format=json";
					//$path .="&env=http://datatables.org/alltables.env";

					//set up the cURL
					$c = curl_init();
					curl_setopt($c, CURLOPT_URL, $path);
					curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
					 
					// execute the cURL
					$rawdata = curl_exec($c);
					curl_close($c);
					 
					// Convert the returned JSON to a PHP object
					$data = json_decode($rawdata);
					//$link0 = $data->query->results->li[0]->div[0]->a->href;
					$ref = $data->query->results->li;
for ($i=0; $i< count($ref); $i++){  
			            $url2 = $ref[$i]->div[0]->a->href;
						$link0 = stripslashes($url2);
						$result[$i]['alamat'] = $link0;

// $link = "\'http://afterschool.my/scholarship/academic-excellence-scholarships-at-university-of-lincoln-in-uk-2015/\'";
$list = array(
"satu" => "SELECT * from html WHERE url=\'".$link0."\' AND xpath=\'//div[@class=\"sd-table\"]/div\'",
"dua" => "SELECT * from htmlstring WHERE url=\'".$link0."\' AND xpath=\'//div[@class=\"sd-table\"]/div[1]|//div[@class=\"sd-table\"]/div[3]|//div[@class=\"sd-table\"]/div[6]\'"
);

// Tampilan QUERY selengkapnya
$query = "SELECT * FROM yql.query.multi WHERE queries='" . implode(';', $list) . "'";
$url = 'http://query.yahooapis.com/v1/public/yql?q=' . urlencode($query);
$url .= "&format=json";
$url .="&env=http://datatables.org/alltables.env";

$c = curl_init();
curl_setopt($c, CURLOPT_URL, $url);
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
 
// // execute the cURL
$rawdata = curl_exec($c);
curl_close($c);
//$new = strip_tags($rawdata);
$data = json_decode($rawdata);
//$data = (string)$rawdata;

//Show us the data
echo "<pre>\n";
print_r($data) . "\n";
echo "</pre>";

$deadline = $data->query->results->results[0]->div[1]->div[1]->p;
$jurusan = $data->query->results->results[0]->div[3]->div[1]->ul->li;
$jurusanalt = $data->query->results->results[0]->div[3]->div[1]->ul->li;
$biaya = $data->query->results->results[0]->div[4]->div[1]->p;
$biayaalt = $data->query->results->results[0]->div[4]->div[1]->ul->li;

$result[$i]['deadline'] = $deadline;

if(is_object($biaya)){
		$result[$i]['biaya'] = $biaya;
	}
	else{
		$result[$i]['biaya'] = $biayaalt;
	}
	echo "<br>";

	if(is_object($jurusan)){
	for ($i=0; $i<= count($jurusan); $i++) {
	    $jurlist = $jurusan[$i];
	        $result[$i]['jurlist'] = $jurlist;
	        // echo  $jurlist ;
	        // echo "<br>";
	    }
	}
	else{
		echo $jurusanalt;
	}
	$detail = $data->query->results->results[1]->result;
	echo $detail;
}

//$judul = $data->query->results->result;
//xpath versi p
// $judul = $data->query->results->div->h1->content;
// $negarauniv = $data->query->results->a;
// $deadline = $data->query->results->p[0]->span->content;
// $konten = $data->query->results->p;
?>