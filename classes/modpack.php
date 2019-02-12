<?php
class modpack
{
	function get_mc-ver()
	{
	//return minecraft version of pack or error if not loaded	
	}
	function get_num_mods()
	{
	//return number of mods or error if not loaded.	
	}
	function check_for_updates()
	{
	//checks mod_versions table against modpack_contents table for updated mods
	}
	function add_mod($mod)
	{
	//adds a mod to the modpack_contents table
	}
	function remove_mod($mod)
	{
	//removes a mod from the modpack_contents table
	}
	function del()
	{
	//deletes the modpack
	}
	function create($name, $mc_ver, $version)
	{
	//creates a new modpack with a set name, minecraft version, and version number.
	}
	function update_version($version)
	{
	//updates the version number of the modpack
	}
	function update_mc_version($mc_ver)
	{
	//changes the minecraft version and returns error for incompatible mods
	}
	function update_name($name)
	{
	//changes the name of the modpack
	}
	function load($id)
	{
	//loads the modpack from the database
	}
	function save()
	{
	//writes changes to the modpack.
	}
	function create_zip()
	{
	//creates a modpack zip file of the mod or returns an error if all mods do not have files.
	}
	function get_mod_list()
	{
	//returns a mod list class file with all mods in modpack.
	}
	private $name;
	private $mc_ver;
	private $mod_list;
	private $version;
}
?>