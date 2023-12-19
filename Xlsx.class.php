<?php 

class Xlsx{

    /*ReadXLSX fetch the entire data from the XL
    it May Slow Down the Process
    */
    public static function ReadXLSX($path){
        $command = "python3 $path --field '*'";
        $output = shell_exec($command);
        return json_decode($output,true);
    }
    //GetField is used to get Perticulat Distinct field
    public static function GetField($path,$field,$type="array"){
        $command = "python3 $path -f '$field'";
        $output = shell_exec($command);
        if($type=="array"){
            return json_decode($output,true);
        }else{
            return $output;
        }
    }

}