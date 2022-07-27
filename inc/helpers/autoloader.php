<?php

/**
 * Autoloader file for theme.
 * 
 * @package Aquila
*/

 namespace AQUILA_THEME\Inc\Helpers;

 /**
  * Auto loader function.
  * @param string $resouces Source namespace
  * @return void
  */

  function autoloader($resource = " "){
    
    $resouce_path   = false;
    $namespace_root = "AQUILA_THEME\\";
    $resource       = trim($resource, "\\");

    if(empty($resource) || strpos($resource, '\\') === false || strpos($resource, $namespace_root)!==0){
        //if we are not working in this name space, quit
        return;
    }
    //remove root namespace
    //search for the name space root and replace it with nothing in the resource name
    $resource = str_replace( $namespace_root, '', $resource );
    
    //convert str to lowercase
    //search for underscore and replace with hyphen
    //split string by '\\'
    //returns an array
    $path = explode(
        "\\",
        str_replace("_","-",strtolower($resource))
    );
   
    

    /**
	 * Time to determine which type of resource path it is,
	 * so that we can deduce the correct file path for it.
	 */
    //if path is empty, leave
     if(empty($path[0]) || empty ($path[1])){
        return;
     }

    
    

    $directory = "";
    $file_name = "";

    if ("inc" === $path[0]){
        switch($path[1]){
            case 'traits':
                $directory = "traits";
                $file_name = sprintf('trait-%s', trim(strtolower($path[2])));
                break;
            case "widgets"://do nothing
            case 'blocks':
                /**
				 * If there is class name provided for specific directory then load that.
				 * otherwise find in inc/ directory.
                 * class name is found in $path[2]
				 */
                if (!empty($path[2])){
                    $directory = sprintf('classes/%s',$path[1]);
                    $file_name = sprintf('class-%s', trim(strtolower($path[2])));
                    break;
                }
            default:
                $directory = "classes";
                $file_name = sprintf('class-%s', trim(strtolower($path[1])));
                break;

        }
        $resource_path = sprintf("%s/inc/%s/%s.php", untrailingslashit(AQUILA_DIR_PATH), $directory, $file_name);
       
    }
    /**
	 * If $is_valid_file has 0 means valid path or 2 means the file path contains a Windows drive path.
	 */
    $is_valid_file = validate_file( $resource_path );
    
    //if the resource path isnt empty and the file exists and is either a normal or contains a window drive path

    if ( ! empty( $resource_path ) && file_exists( $resource_path ) && ( 0 === $is_valid_file || 2 === $is_valid_file ) ) {
		// We already making sure that file is exists and valid.
		require_once( $resource_path ); // phpcs:ignore
      
	}

  }

  spl_autoload_register( '\AQUILA_THEME\Inc\Helpers\autoloader' );