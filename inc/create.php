<?php

/**
 * DB SYSTEM
 *
 * @author mohamed amr
 */

if(TABLENAME) {
//-------------------------------------
    $fn = 'inc/Db.php';
    $newfn = "database/" . TABLENAME . ".php";
//-------------------------------------

    if (!file_exists($newfn)) {
        if (copy($fn, $newfn)) {
            $oldMessage = '$table';
            $deletedFormat = TABLENAME;
            $op = '$ob';
            $neob = '$' . TABLENAME;
            $str = file_get_contents($newfn);

            $str = str_replace("$oldMessage", "$deletedFormat", $str);
            $str = str_replace("$op", "$neob", $str);
            $res1 = file_put_contents($newfn, $str);

            if ($res1) {
                $file = 'req.php';
                $current = file_get_contents($file);
                $current .= "require_once 'database/" . TABLENAME . ".php';";
                file_put_contents($file, $current . "\n");
       }
               $message = 'The file was copied successfully';

        } else {
            $message = 'The file dont copy';
        }

    } else {
        $message = ' the file exists';
    }
}else{
    $message = ' the table name is not exist';
}
//--------------------------end ------------------------------