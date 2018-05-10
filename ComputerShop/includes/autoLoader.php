<?php

function autoLoader($classname)
{
    $dirs=array('/models/','models/','../models/','http://localhost/ComputerShop/models/','/includes/','includes/','../includes/','http://localhost/ComputerShop//includes/',"/controllers/","controllers/","../controllers/","http://localhost/ComputerShop/controllers/");
    $formats=array('%s.php','%s.php.inc','%s.class.php','class.%s.php');
    foreach ($dirs as $dir) {
        
        foreach ($formats as $format) {
            
            $path=$dir.sprintf($format,$classname);
            if(file_exists($path    ))
            {
                include $path;
                return true;
            }
            
        }
        
    }
    
    
    
    
}
spl_autoload_register('autoLoader');