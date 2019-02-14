<?php
require_once('classes/mod.php');
require_once('classes/mod_version.php');
class mod_list
{
  function get_mod($id)
  {
    $mod = new mod();
    $mod->load($id);
    return $mod;
  }
  function load($id)
  {
    $configuration=new configuration;
    $mysqli = new mysqli($configuration->db_address, $configuration->db_username, $configuration->db_password, $configuration->database);
    if ($mysqli->connect_errno)
    {
      echo "Sorry, this website is experiencing problems.";
      exit;
    }
    $sql = "SELECT * FROM modpack_contents WHERE parent = $id";
    if (!$result = $mysqli->query($sql))
    {
        echo "Sorry, the website is experiencing problems.";
        exit;
    }
    if ($result->num_rows === 0)
    {
    return false;
    exit;
    }
    if ($result = $mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        $mod = new mod();
        $mod->load($row['mod_id']);
        $mod_version= new mod_version();
        $mod_version->load($row['version']);
        $mods[$row['id']], ['mod' => $mod, 'mod_version'=>$mod_version]);
      }
      $result->free();
    }
    return $mods;
  }
  public $mods=[];
}
?>
