<?php 
 
class Dump {
 
    public static function v($data)
    {
        print '<pre>';
        var_dump($data);
        print '</pre>';
    }
    
    public static function p($data)
    {
        print '<pre>';
        print_r($data);
        print '</pre>';
    }
    
    public static function vd($data)
    {
        $time_start = microtime(true);
        
        print '<pre>';
        var_dump($data);
        print '</pre>';
        
        $time_end = microtime(true);
		$execution_time = ($time_end - $time_start) / 60;
        
        //execution time of the script
		echo "<br /><hr /><b>Total Execution Time:</b> " . sprintf("%01.6f", $execution_time) . ' seconds';
        
        die();
    }
    
    public static function pd($data)
    {
        $time_start = microtime(true);
        
        print '<pre>';
        print_r($data);
        print '</pre>';
        
        $time_end = microtime(true);
		$execution_time = ($time_end - $time_start);
        
        //execution time of the script
		echo "<br /><hr /><b>Total Execution Time:</b> " . sprintf("%01.6f", $execution_time) . ' seconds';
        
        die();
    }
    
}