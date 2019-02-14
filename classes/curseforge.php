<?php
require_once('configuration.php');
require_once('classes/cache.php');
require_once('classes/mod_version.php')
class source
{
  function format_url($url)
  {
    $components =explode('/', parse_url($url, PHP_URL_PATH));
    if ($components[2]=='mc-mods')
    {
      $mod=$components[3];
    }
    elseif($components[1]=='projects')
    {
      $mod=$components[2];
    }
    $export_url = 'https://minecraft.curseforge.com/projects/'.$mod;
  }
  function get_num_releases($id)
  {
    $configuration=new configuration;
    $mysqli = new mysqli($configuration->db_address, $configuration->db_username, $configuration->db_password, $configuration->database);
    if ($mysqli->connect_errno)
    {
      echo "Sorry, this website is experiencing problems.";
      exit;
    }
    $sql = "SELECT id, url, last_ver FROM mods WHERE id = $id";
      if ($result->num_rows === 0) {
      echo "Error.  Invalid mod ID number";
      exit;
    }
    $mod = $result->fetch_assoc();
    $url = $mod['url'];
    $url = $url."/files";
    $page = new cache();
    $html = $page->load_page($url);
    $dom = new DOMDocument;
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $div = $xpath->query("//div[@class='b-pagination b-pagination-a']");
    $links = [];
    $page;
    foreach($div as $container) {
        $arr = $container->getElementsByTagName("a");
        foreach($arr as $item) {
          $text = trim(preg_replace("/[\r\n]+/", " ", $item->nodeValue));
          if(is_numeric($text)){
            $page = $text;
          }
      }
    }
    $total = $page*25;
    $list= array('pages' => $page, 'total' => $total);
    return $list;
  }
  function get_info($id, $page_num=1, $initialize=false)
  {
    $configuration=new configuration;
    $mysqli = new mysqli($configuration->db_address, $configuration->db_username, $configuration->db_password, $configuration->database);
    if ($mysqli->connect_errno)
    {
      echo "Sorry, this website is experiencing problems.";
      exit;
    }
    $sql = "SELECT id, url, last_ver FROM mods WHERE id = $id";
      if ($result->num_rows === 0) {
      echo "Error.  Invalid mod ID number";
      exit;
    }
    $mod = $result->fetch_assoc();
    $url = $mod['url'];
    $url = $url . "/files?page=$page_num";
    $page = new cache();
    $html = $page->load_page($url);
    $last_ver = $mod['last_ver'];
    if(!$initialize)
    {
      $last_version = new mod_version();
      $last_version->load($last_ver);
    }
    $dom = new DOMDocument;
    @$dom->loadHTML($html);
  	$xpath = new DOMXPath($dom);
  	$div = $xpath->query("//div[@class='listing-body']");
  	$div = $div ->item(0);
  	$table = $dom->saveXML($div);
  	$dom = new DOMDocument();
  	@$dom->loadHTML($table);
  	$xpath = new DOMXPath($dom);
  	$version_tr = $xpath->query("//tr[@class='project-file-list-item']");
  	foreach($version_tr as $tr){
      $link_url = $xpath->query("descendant::a[@data-action='file-link']", $tr);
  		$url = 'https://minecraft.curseforge.com'.$link_url->item(0)->getAttribute('href');
      $version = $link_url->item(0)->getAttribute('data-name');
      $abbr_date = $xpath->query("descendant::td[@class='project-file-date-uploaded']/*", $tr);
      $epoch = $abbr_date->item(0)->getAttribute('data-epoch');
      $dt = new DateTime("@$epoch");
      $date = $date->format('Y-m-d H:i:s');
      foreach ($xpath->query("descendant::span[@class='version-label']/text()", $tr) as $textNode) {
          $mc_ver = $textNode->nodeValue;
      }
      $mod_version = new mod_version();
      $mod_version->set($id, $date, $url, $mc_ver, $version);
      if(!$initialize)
      {
        if($mod_version->is_same($id, $date, $url, $mc_ver, $version))
        {
          return 'done';
          exit;
        }
        elseif($mod_version->is_older_than($date))
        {
          return 'done';
          exit;
        }
      }
    }
  }

}
?>
