# modxsh
Плагин автоматической подсветки кода во фронтенде MODx Evo
# События
OnWebPageInit
# Свойства
{
      "theme": [
        {
          "label": "Тема",
          "type": "list",
          "value": "Default",
          "options": "Default,Django,Eclipse,Emacs,Fade To Grey,Midnight,RDark",
          "default": "Default",
          "desc": ""
        }
      ]
    }
# TinyMCE интеграция в список стилей
***Формат:*** Важный блок,important-block,div|Зеленый текст,green-text,span
***Изменения, которые необходимо внести:***
В файле bridge.tinymce4.inc.php, в методе bridge_style_formats:
```php
foreach ($styles_formats as $val) {
        $style = explode(',', $val);
        $sfArray[] = array('title' => $style['0'], 'selector' => 'a,strong,em,p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,tr,span,img', 'classes' => $style['1']);
}
```
***Меняем на***
```php
foreach ($styles_formats as $val) {
        $style = explode(',', $val);
        $format = in_array(trim($style['2']),$inline_el) ? 'inline' : (in_array(trim($style['2']),$block_el) ? 'block' : '');
        $sfArray[] = array('title' => $style[0], 'selector' => 'a,strong,em,p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,tr,span,img', 'classes' => trim($style[1]), $format => trim($style[2]));
    }
```
Спасибо за это bubenok