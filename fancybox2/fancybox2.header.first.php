<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=header.first
[END_COT_EXT]
==================== */
/**
 * FancyBox plugin for Cotonti Siena CMF
 *
 * @package FancyBox
 * @author Janis Skarnelis, Kalnov Alexey <kalnovalexey@yandex.ru>
 * @copyright (c) Janis Skarnelis, Cotonti plugin - Lily Software https://lily-software.com (ex. Portal30 Studio)
 */
defined('COT_CODE') or die('Wrong URL.');

if (!defined('COT_ADMIN')) {

    if (cot::$env["location"] == "forums"){
        $fbgroup = <<<HTM1
            // Ищем все td
            $('td').each(function(index, Element){
                var imgs;
                imgs = $(this).find("a[href]").filter(function() {
                    return /\.(jpg|jpeg|png|gif)$/i.test(this.href);
                });
                imgs.attr('rel', 'group_' + index);
            });
HTM1;
    } else {
        $fbgroup = "tmp.attr('rel', 'group');";
        // Это заточено под мой дизайн
        if(cot::$env["location"] == 'list') {
            $fbgroup .= <<<HTM1
            // Ищем все дивы со списком страниц
            $('div.block_list').each(function(index, Element){
                var imgs;
                imgs = $(this).find("a[href]").filter(function() {
                    return /\.(jpg|jpeg|png|gif)$/i.test(this.href);
                });
                imgs.attr('rel', 'group_' + index);
            });
HTM1;
        }

    }

    $outFancy = <<<HTM
    $(document).ready(function() {
        jQuery(function($) {
            var tmp;
            tmp = $("a[href]").filter(function() {
                    return /\.(jpg|jpeg|png|gif)$/i.test(this.href);
                });
            tmp.addClass( 'fancybox' ).addClass('thumbnail');
            tmp.attr('target', '_blank');
            {$fbgroup}
            $('a.fancybox').fancybox({
                openEffect	: 'elastic',
                closeEffect	: 'elastic',
                beforeShow: function () {
                    if (this.title) {
                        this.titleOrigin = this.title;
                        // New line
                        //this.title += '<br />';
                        //this.title += '<span style="width: 100px"> &nbsp; </span>';

                        this.title += '<div class="pull-right" id="ya_share_fbox" style=""></div><div class="clearfix"></div> ';
                    }
                },
                afterShow: function() {
                    // Render Yandex button
                    var href = '{$cfg['mainurl']}/' + this.href;
                    var title = this.titleOrigin;

                    //console.log(href);
                    Ya.share2('ya_share_fbox', {
                        content: {
                            url: href,
                            title: title,
                            image: href
                        },
                        theme: {
                            services: 'vkontakte,facebook,odnoklassniki,moimir,gplus,twitter,viber,whatsapp',
                            size: 's'
                        }
                    });
                },
                helpers	: {
                    thumbs	: {
                        width	: 50,
                        height	: 50
                    },
                    title : {
                        type: 'inside'
                    },
                    buttons	: {}
                }
            });
        });
    });
HTM;
    
    Resources::linkFileFooter('https://yastatic.net/share2/share.js');
    Resources::embedFooter($outFancy);
}