<?php
require_once('configuration.php');
class user
{
  function __contruct()
  {
    if isset($_SESSION['id'])
    {
      $id = $_SESSION['id'];
      $configuration=new configuration;
      $mysqli = new mysqli($configuration->db_address, $configuration->db_username, $configuration->db_password, $configuration->database);
      if ($mysqli->connect_errno)
      {
        echo "Sorry, this website is experiencing problems.";
        exit;
      }
      $sql = "SELECT id, user, level FROM users WHERE id = $id";
      if (!$result = $mysqli->query($sql))
      {
          echo "Sorry, the website is experiencing problems.";
          exit;
      }
      if ($result->num_rows === 0)
      {
      exit;
      }
      $status = $result->fetch_assoc();
      $id = $status['id'];
      $username = $status['name'];
      $level = $status['level'];
      $logged_in = true;
    }
    else
    {
      $logged_in = false;
    }
  }
  function is_logged_in()
  {
    return $logged_in;
  }
  function get_username()
  {
    return $username;
  }
  function get_permission($privelege)
  {
    //checks if the user has permission to do an action.
  }
  function check_mp_permission($modpack, $privelege)
  {
    //checks if the user has permissions for a modpack.
  }
  function check_max_packs()
  {
    //checks the maximum number of packs a user can create.
  }
  function check_num_packs()
  {
    //returns the number of packs a user controls.
  }
  function login($un, $pw)
  {
    $configuration=new configuration;
    $mysqli = new mysqli($configuration->db_address, $configuration->db_username, $configuration->db_password, $configuration->database);
    if ($mysqli->connect_errno)
    {
      echo "Sorry, this website is experiencing problems.";
      exit;
    }
    $sql = "SELECT id, user, level FROM users WHERE password = $pw AND username=$un";
    if (!$result = $mysqli->query($sql))
    {
        echo "Sorry, the website is experiencing problems.";
        exit;
    }
    if ($result->num_rows === 0)
    {
    return false
    exit;
    }
    $status = $result->fetch_assoc();
    $id = $status['id'];
    $username = $status['name'];
    $level = $status['level'];
    $logged_in = true;
    return true;
  }
  function logout()
  {
    session_destroy();
    return true;
  }
  function change_password($old, $new, $idnum=$id)
  {
    $configuration=new configuration;
    $mysqli = new mysqli($configuration->db_address, $configuration->db_username, $configuration->db_password, $configuration->database);
    if ($mysqli->connect_errno)
    {
      echo "Sorry, this website is experiencing problems.";
      exit;
    }
    if($idnum == $id)
    {
    $sql = "UPDATE users SET password = $new WHERE id = $idnum AND password = $old";
    }
    else
    {
      $sql = "UPDATE users SET password = $new WHERE id = $idnum";
    }
    if (!$result = $mysqli->query($sql))
    {
        echo "Sorry, the website is experiencing problems.";
        exit;
    }
  }
  function change_permission($lvl, $privelege, $val)
  {
    $configuration=new configuration;
    $mysqli = new mysqli($configuration->db_address, $configuration->db_username, $configuration->db_password, $configuration->database);
    if ($mysqli->connect_errno)
    {
      echo "Sorry, this website is experiencing problems.";
      exit;
    }
  }
  function change_mp_perm($lvl, $privelege, $val)
  {
    $configuration=new configuration;
    $mysqli = new mysqli($configuration->db_address, $configuration->db_username, $configuration->db_password, $configuration->database);
    if ($mysqli->connect_errno)
    {
      echo "Sorry, this website is experiencing problems.";
      exit;
    }
  }
  function change_max_packs($num)
  {
    $configuration=new configuration;
    $mysqli = new mysqli($configuration->db_address, $configuration->db_username, $configuration->db_password, $configuration->database);
    if ($mysqli->connect_errno)
    {
      echo "Sorry, this website is experiencing problems.";
      exit;
    }
  }
  function delete($idnum)
  {
    $configuration=new configuration;
    $mysqli = new mysqli($configuration->db_address, $configuration->db_username, $configuration->db_password, $configuration->database);
    if ($mysqli->connect_errno)
    {
      echo "Sorry, this website is experiencing problems.";
      exit;
    }
    $sql = "DELETE FROM users WHERE id = $idnum";
    if (!$result = $mysqli->query($sql))
    {
        echo "Sorry, the website is experiencing problems.";
        exit;
    }
  }
  function create($un, $pw, $lvl)
  {
    $configuration=new configuration;
    $mysqli = new mysqli($configuration->db_address, $configuration->db_username, $configuration->db_password, $configuration->database);
    if ($mysqli->connect_errno)
    {
      echo "Sorry, this website is experiencing problems.";
      exit;
    }
    $sql = "INSERT INTO users (name, level, password) VALUES($un, $lvl, $pw)";
    if (!$result = $mysqli->query($sql))
    {
        echo "Sorry, the website is experiencing problems.";
        exit;
    }
  }
  private $logged_in;
  private $id;
  private $username;
  private $level;
}
?>
