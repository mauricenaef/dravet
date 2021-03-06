<?php
/**
 * Search Functions
 *
 * @package dravet
 */

if ( ! function_exists( 'bulmastarter_search_form' ) ) {
  function bulmastarter_search_form( $form ) {
      $form = '
      <form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
        <h2 class="widget-title is-bold">Suchen</h2>
        <div class="control has-addons">
          <label class="screen-reader-text" for="s">' . __( 'Suche nach ...' ) . '</label>
          <div class="input-wrap">
            <input class="input" type="text" value="' . get_search_query() . '" name="s" id="s" />
            <input class="button is-primary" type="submit" id="searchsubmit" value="'. esc_attr__( 'Suchen' ) .'" />
          </div>
        </div>
      </form>';

      return $form;
  }
}
add_filter( 'get_search_form', 'bulmastarter_search_form', 100 );
