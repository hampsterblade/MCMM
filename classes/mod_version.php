<?php
  require_once('configuration.php');
  class mod_version
  {
    function load($load_id)
    {
      $configuration=new configuration;
      $mysqli = new mysqli($configuration->db_address, $configuration->db_username, $configuration->db_password, $configuration->database);
      if ($mysqli->connect_errno)
      {
        echo "Sorry, this website is experiencing problems.";
        exit;
      }
      $sql = "SELECT * FROM mod_version WHERE id = $load_id";
        if ($result->num_rows === 0) {
        echo "Error.  Invalid mod version ID number";
        exit;
      }
      $mod_version = $result->fetch_assoc();
      $id = $mod_version['id'];
      $parent = $mod_version['parent'];
      $date = $mod_version['date'];
      $mc_ver = $mod_version['mc_ver'];
      $url = $mod_version['url'];
      $version = $mod_version['version'];
    }
    function delete()
    {
      $configuration=new configuration;
      $mysqli = new mysqli($configuration->db_address, $configuration->db_username, $configuration->db_password, $configuration->database);
      if ($mysqli->connect_errno)
      {
        echo "Sorry, this website is experiencing problems.";
        exit;
      }
      $sql = "DELETE FROM mod_versions WHERE id = $id";
      if (!$result = $mysqli->query($sql))
      {
          echo "Sorry, the website is experiencing problems.";
          exit;
      }
    }
    function create()
    {
      $configuration=new configuration;
      $mysqli = new mysqli($configuration->db_address, $configuration->db_username, $configuration->db_password, $configuration->database);
      if ($mysqli->connect_errno)
      {
        echo "Sorry, this website is experiencing problems.";
        exit;
      }
      $sql = "INSERT into mod_versions (parent, date, url, mc_ver, version) VALUES ($parent, $date, $url, $mc_ver, $version)";
      if (!$result = $mysqli->query($sql))
      {
          echo "Sorry, the website is experiencing problems.";
          exit;
      }
    }
    function set($set_parent, $set_date, $set_url, $set_mc_ver)
    {
      $parent = $set_parent;
      $date = $set_date;
      $url = $set_url;
      $mc_ver = $set_mc_ver;
    }
    function is_same($com_parent, $com_date, $com_url, $com_mc_ver, $com_version)
    {
      return ($com_parent == $parent && $com_date == $date && $com_url == $url && $com_mc_ver == $mc_ver && $com_version == $version);
    }
    function is_older_than($com_date)
    {
      $date1 = new DateTime($com_date);
      $date2 = new DateTime($date);
      return $date1 < $date2;
    }
    public $id;
    public $parent;
    public $date;
    public $url;
    public $mc_ver;
    public $version;
  }
?>
