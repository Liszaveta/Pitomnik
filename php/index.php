<?php 
function search($text, $use_register=false)
{
  if ($use_register) // если учитывать регистр символов
  {
  return ereg_replace($text,"<b>\0</b>",$text); // ищем, заменяем, возвращаем
  }
  else // если не учитывать регистр символов
  {
  return eregi_replace($text,"<b>\0</b>",$text); // ищем, заменяем, возвращаем
  }
return $result; // так, на всякий случай
}


$files_file="files.dat";
$obrezanie=100; //обрезание строки по длинне
// $text - текст в котором ищем
// $search_text - искомые слова
// $use_register - использование регистра
function search($text,$use_register=false)
{
  if ($use_register)
  {
  return ereg_replace($text,"<b>\0</b>",$text);
  }
  else
  {
  return eregi_replace($text,"<b>\0</b>",$text);
  }
return "";
}

function Remote_file_read($url)
{
$text="";
$file=@fopen ($url, "r");
if (!$file) {
    return "READ EROR";
    exit;
}
while (!feof ($file))
    {
    $line=fgets ($file, 1024);
    $text.=$line;
    }
fclose($file);
return $text;
}

function Cut_string($text) // Функция обрезающая текст
{
  global $obrezanie;
  $p=strpos($text, "<b>".$text."</b>");
  $p=$p-$obrezanie;
  if ($p<0) $p=0;
  $text=substr($text,$p,$obrezanie*2+strlen("<b>".$text."</b>"));
  return $text;
}

 // Выводим форму поиска
echo '<form name="f1" method="get" action="search.php">
<table align="center" cellpadding="0" cellspacing="0" width="70%"><tr>
<td width="35%"><p align="right">Что искать:</p></td><td width="368"><p>
<input type="text" name="Search_text" size="34" value=""></p>
</td></tr><tr><td width="368">
<p align="right">Как искать:</p></td><td width="368"><p>
<input type="radio" name="type" value="0">С учетом регистра<br>
<input type="radio" name="type" value="1">Без учета регистра</p>
</td></tr><tr><td width="527" colspan="2"><p align="center">
<input type="submit" value="Найти"> </p></td></tr></table></form>';

if (isset($text)) // Если слово для поиска заданно то идем дальше
{
$found=false;
if (!isset($type)) $type=1; // Проверяем тип поиска
if ($type==0) $use_register=true;
else
$use_register=false;
$file=file($files_file);
$count=count($file);
for ($i=0 ; $i<$count ; $i++) // Проходим по всем файлам указанным в files.dat
      {
      $def_text=htmlspecialchars(Remote_file_read(trim($file[$i])));
      $return_text=search($def_text,$use_register);
      if ($def_text!==$return_text)
      {
      echo "<h3>".trim($file[$i])."</h3>";
      echo Cut_string($return_text,);
      echo "<br><a href="".trim($file[$i])."">Открыть эту страницу</a>";
      echo "<br><hr><br>";
      }
      }
}
?>