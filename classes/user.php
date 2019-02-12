<?php
class user
{
  function is_logged_in()
  {
    //returns true if a user is logged in.
  }
  function get_username()
  {
    //returns the username
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
  function login($login, $password)
  {
    //logs the user in.
  }
  function logout()
  {
    //logs the user out.
  }
  function change_password($old, $new)
  {
    //change the password.
  }
  function change_permission($level, $privelege, $val)
  {
    //changes a permission
  }
  function change_mp_perm($level, $privelege, $val)
  {
    //changes a modpack permission
  }
  function change_max_packs($num)
  {
    //set max number of mod packs
  }
  function delete()
  {
    //removes the user.
  }
  function create($username, $password, $level)
  {
    //creates a user.
  }
}
?>
