<?php
/**
 * Editor Functions
 *
 * @package Dyna
 * @subpackage Dyna Starter Theme
 * @version 1.0.0
 * @author Alf Drollinger
 * @copyright 2018 https://dyna.press
 * @license GPL V2 https://www.gnu.org/licenses/gpl
 *
 * @link https://dyna.press/docs/functions/theme-setup/navigation-menus
 * 
 * @see https://wordpress.stackexchange.com/questions/64515/fall-back-for-main-menu
 * @see http://xiaohudie.net/code/link_to_menu_editor.html
 * @see https://sprosi.pro/questions/56396/vernutsya-v-glavnoe-menyu
 */

Namespace Dyna;

function link_to_menu_editor( $args )
{
    if ( ! current_user_can( 'manage_options' ) )
    {
        return;
    }

    extract( $args );

    $link = $link_before . '<a href="' .admin_url( 'nav-menus.php' ) . '">' . $before . 'Add a menu' . $after . '</a>' . $link_after;

    if ( FALSE !== stripos( $items_wrap, '<ul' )
        or FALSE !== stripos( $items_wrap, '<ol' )
    )
    {
        $link = "<li>$link</li>";
    }

    $output = sprintf( $items_wrap, $menu_id, $menu_class, $link );
    if ( ! empty ( $container ) )
    {
        $output  = "<$container class='$container_class' id='$container_id'>$output</$container>";
    }

    if ( $echo )
    {
        echo $output;
    }

    return $output;
}