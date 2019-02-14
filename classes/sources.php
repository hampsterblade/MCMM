<?php
require_once('configuration.php');
class sources
{
  function format_url($id, $url)
  {
    $configuration=new configuration;
    $mysqli = new mysqli($configuration->db_address, $configuration->db_username, $configuration->db_password, $configuration->database);
    if ($mysqli->connect_errno)
    {
      echo "Sorry, this website is experiencing problems.";
      exit;
    }
    $sql = "SELECT id, name, filename FROM sources WHERE id = $id";
    if (!$result = $mysqli->query($sql))
    {
      echo "Sorry, the website is experiencing problems.";
      exit;
    }
    if ($result->num_rows === 0)
    {
      echo "Error, invalid source."
      exit;
    }
    $status = $result->fetch_assoc();
    $filename=$status['filename'];
    require_once("classes/$filename");
    $source = new source();
    return $source->format_url("$url");
  }
  function get_num_releases($id, $mod_id)
  {
    $configuration=new configuration;
    $mysqli = new mysqli($configuration->db_address, $configuration->db_username, $configuration->db_password, $configuration->database);
    if ($mysqli->connect_errno)
    {
      echo "Sorry, this website is experiencing problems.";
      exit;
    }
    $sql = "SELECT id, name, filename FROM sources WHERE id = $id";
    if (!$result = $mysqli->query($sql))
    {
      echo "Sorry, the website is experiencing problems.";
      exit;
    }
    if ($result->num_rows === 0)
    {
      echo "Error, invalid source."
      exit;
    }
    $status = $result->fetch_assoc();
    $filename=$status['filename'];
    require_once("classes/$filename");
    $source = new source();
    return $source->get_num_releases("$mod_id");
  }
  function get_info($id, $mod_id, $page_num, $initialize=false)
  {
    $configuration=new configuration;
    $mysqli = new mysqli($configuration->db_address, $configuration->db_username, $configuration->db_password, $configuration->database);
    if ($mysqli->connect_errno)
    {
      echo "Sorry, this website is experiencing problems.";
      exit;
    }
    $sql = "SELECT id, name, filename FROM sources WHERE id = $id";
    if (!$result = $mysqli->query($sql))
    {
      echo "Sorry, the website is experiencing problems.";
      exit;
    }
    if ($result->num_rows === 0)
    {
      echo "Error, invalid source."
      exit;
    }
    $status = $result->fetch_assoc();
    $filename=$status['filename'];
    require_once("classes/$filename");
    $source = new source();
    $source->get_info($mod_id, $page_num, $initialize);
  }
}
?>
