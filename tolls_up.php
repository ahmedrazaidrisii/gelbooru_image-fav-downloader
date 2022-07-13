<?
set_time_limit(0);
ini_set('memory_limit', '1024M');
$dir_files = scandir(".");
for ($i = 0; $i < 10; $i++) {
   $data = file_get_contents("https://gelbooru.com/index.php?page=dapi&s=post&q=index&json=1&limit=1000&pid=$i&tags=fav:youruser_id");
   $data = json_decode($data, true);
   $x = 0;
   foreach ($data as $key => $val) { //to select between to array and enter into [post] array 
      if ($key == 'post') {
         foreach ($val as $ffd) { //loop throught [post] array
            foreach ($ffd as $kr => $var) { //loop throught each ovject of [post] array
               if ($kr == 'file_url') {
                  $file_name = basename($var);
                  if (in_array($file_name, $dir_files)) {
                     echo "Already Exist" . "->" . $file_name . "<br>";
                  } else {
                     $extension = pathinfo($file_name, PATHINFO_EXTENSION);
                     if ($extension == "mp4") {
                        continue;
                     }
                     file_put_contents("$file_name", file_get_contents($var));
                  }
               }
            }
         }
      }
   }
}
