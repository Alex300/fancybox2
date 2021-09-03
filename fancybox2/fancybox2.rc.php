<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=rc
[END_COT_EXT]
==================== */
/**
 * FancyBox plugin for Cotonti Siena CMF
 *
 * @package FancyBox
 * @author Janis Skarnelis, Kalnov Alexey <kalnovalexey@yandex.ru>
 * @copyright (c) Cotonti plugin 2011-2021 Lily Software https://lily-software.com (ex. Portal30 Studio)
 */
defined('COT_CODE') or die('Wrong URL.');

if (!defined('COT_ADMIN')){

    $jsFunc = 'linkFileFooter';
    if(cot::$cfg['headrc_consolidate'] && cot::$cache) $jsFunc = 'addFile';

    Resources::addFile(cot::$cfg['plugins_dir'].'/fancybox2/fancybox/jquery.fancybox.css');
    Resources::$jsFunc(cot::$cfg['plugins_dir'].'/fancybox2/fancybox/jquery.fancybox.min.js');
    Resources::$jsFunc(cot::$cfg['plugins_dir'].'/fancybox2/fancybox/jquery.mousewheel-3.0.6.min.js');


    Resources::addFile(cot::$cfg['plugins_dir'].'/fancybox2/fancybox/helpers/jquery.fancybox-buttons.css');
    Resources::$jsFunc(cot::$cfg['plugins_dir'].'/fancybox2/fancybox/helpers/jquery.fancybox-buttons.js');

    Resources::addFile(cot::$cfg['plugins_dir'].'/fancybox2/fancybox/helpers/jquery.fancybox-thumbs.css');
    Resources::$jsFunc(cot::$cfg['plugins_dir'].'/fancybox2/fancybox/helpers/jquery.fancybox-thumbs.js');
}