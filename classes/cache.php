<?php
require_once('configuration.php');
class cache
{
  function load_page($url)
  {
    $configuration=new configuration;
    $mysqli = new mysqli($configuration->db_address, $configuration->db_username, $configuration->db_password, $configuration->database);
    if ($mysqli->connect_errno)
    {
      echo "Sorry, this website is experiencing problems.";
      exit;
    }
    $sql = "SELECT id, filename, date FROM cache WHERE url = $url";
    if (!$result = $mysqli->query($sql))
    {
        echo "Sorry, the website is experiencing problems.";
        exit;
    }
    if ($result->num_rows === 0)
    {
      $internalErrors = libxml_use_internal_errors(true);
	    $html = file_get_contents($url);
      $filename = tempnam('./cache', 'cache_');
      $handle = fopen($filename, "w");
      fwrite($handle, $html);
      fclose($handle);
      $sql = "INSERT INTO cache (url, filename) VALUES($url, $filename)";
      if (!$result = $mysqli->query($sql))
      {
          echo "Sorry, the website is experiencing problems.";
          exit;
      }
      return $html;
    }
    $status = $result->fetch_assoc();
    $id = $status['id'];
    $date = new \DateTime($status['date']);
    $now = new \DateTime();
    if($date->diff($now)->days > 1)
    {
      $internalErrors = libxml_use_internal_errors(true);
	    $html = file_get_contents($url);
      $filename = $status['filename'];
      $handle = fopen($filename, "w");
      fwrite($handle, $html);
      fclose($handle);
      $sql = "UPDATE cache SET date = CURRENT_TIMESTAMP() WHERE id = $id";
      if (!$result = $mysqli->query($sql))
      {
          echo "Sorry, the website is experiencing problems.";
          exit;
      }
      return $html;
    }
    else
    {
      $filename = $status['filename'];
      $html = file_get_contents($filename)
      return $html;
    }
    $logged_in = true;
    return true;
    $this->delete($id);
  }
  function clean_up()
  {
    $configuration=new configuration;
    $mysqli = new mysqli($configuration->db_address, $configuration->db_username, $configuration->db_password, $configuration->database);
    if ($mysqli->connect_errno)
    {
      echo "Sorry, this website is experiencing problems.";
      exit;
    }
    $sql = "SELECT id, filename, date FROM cache WHERE date < DATEADD(day, -1, GETDATE())";
    if (!$result = $mysqli->query($sql))
    {
      echo "Sorry, the website is experiencing problems.";
      exit;
    }
    if ($result->num_rows === 0)
    {
      return true;
    }
    if ($result = $mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        unlink($row['filename']);
      }
      $result->free();
    }
    $sql = "DELETE FROM cache WHERE date < DATEADD(day, -1, GETDATE())";
    if (!$result = $mysqli->query($sql)) {
        echo "Sorry, the website is experiencing problems.";
        exit;
    }
  }
  function delete($id)
  {
    $configuration=new configuration;
    $mysqli = new mysqli($configuration->db_address, $configuration->db_username, $configuration->db_password, $configuration->database);
    if ($mysqli->connect_errno)
    {
      echo "Sorry, this website is experiencing problems.";
      exit;
    }
    $sql = "DELETE FROM cache WHERE id = $id";
    if (!$result = $mysqli->query($sql)) {
        echo "Sorry, the website is experiencing problems.";
        exit;
    }
  }
} ?>
