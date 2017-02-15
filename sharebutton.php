<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
  <!-- Brand and toggle get grouped for better mobile display -->
      <ul class="nav nav-pills navbar-right">
        <li class=""><?php edit_post_link('Edit','','', null,'btn btn-edit'); ?></li>
        <li class=""><?php comments_popup_link(' 0', ' 1', ' %','btn btn-comment'); ?></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle btn-share" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a rel="nofollow" role="button" target="_blank" title="Click to share on Twitter" class="btn-twitter" href=>Twitter</a></li>
          </ul>
        </li>
      </ul>


