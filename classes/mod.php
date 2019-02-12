<?php
class mod
{
    function initialize()
    {
    //starts the initial scrape of the mod, populating all versions from specified source and url.
    }
    function check_for_update()
    {
    //Scrapes only new versions of mod and flags the mod if an update is availble.
    }
    function get_name()
    {
    //returns the name of the mod
    }
    function update_name($name)
    {
    //changes the name of the mod.
    }
    function update_source($source)
    {
    //changes the mod source.
    }
    function update_url($url)
    {
    //changes the mod url.  
    }
    function load($id)
    {

    }
    function create($name, $url, $source)
    {

    }
    private $name;
    private $source;
    private $url;
}
?>
