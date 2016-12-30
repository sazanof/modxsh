<?php
/*
 * Name:SyntaxHighlighter Plugin for Site Frontend
 * CMS / CMF MODx Evolution
 * Author: Saz (sazanof.ru)
 * Version: v1.0
 * Default	shThemeDefault.css
 * Django	shThemeDjango.css
 * Eclipse	shThemeEclipse.css
 * Emacs	shThemeEmacs.css
 * Fade To Grey	shThemeFadeToGrey.css
 * Midnight	shThemeMidnight.css
 * RDark	shThemeRDark.css
 * NOTY: use great with TiniMCE custom "styles fix by bubenok" (see http://modx.im/blog/questions/4624.html)
 * @PROPERITIES
 * {
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
 *
 * @EVENTS
 * OnWebPageInit
 *
 */
if (!defined('MODX_BASE_PATH')) {
    die('What are you doing? Get out of here!');
}
global $modx;
$e = &$modx->Event;
define("SH_DIR", MODX_SITE_URL . 'assets/plugins/modxsh/syntaxhighlighter/');
if ($e->name == 'OnWebPageInit') {
    $out = '';
    $theme = isset($theme) ? $theme : 'Default';
    $cssTheme = 'shTheme' . $theme . '.css';
    $cssTheme = str_replace(' ', '', $cssTheme);
    $all = '<script type="text/javascript">
         SyntaxHighlighter.autoloader(
            ["js","jscript","javascript","' . SH_DIR . 'scripts/shBrushJScript.js"],
            ["bash","shell","' . SH_DIR . 'scripts/shBrushBash.js"],
            ["css","' . SH_DIR . 'scripts/shBrushCss.js"],
            ["xml","html","' . SH_DIR . 'scripts/shBrushXml.js"],
            ["sql","' . SH_DIR . 'scripts/shBrushSql.js"],
            ["php","' . SH_DIR . 'scripts/shBrushPhp.js"],
            ["plain","' . SH_DIR . 'scripts/shBrushPlain.js"]
         );
         SyntaxHighlighter.config.stripBrs = true;
         SyntaxHighlighter.all()
    </script>';
    $modx->regClientCSS(SH_DIR . 'styles/shCore.css');
    $modx->regClientCSS(SH_DIR . 'fix.css');
    $modx->regClientCSS(SH_DIR . 'styles/' . $cssTheme);
    $modx->regClientScript(SH_DIR . 'scripts/shCore.js');
    $modx->regClientScript(SH_DIR . 'scripts/shAutoloader.js');
    $modx->regClientScript($all);
    $e->output($out);
}