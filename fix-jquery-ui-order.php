<?php
/**
 * jQuery UI の読み込み順序エラーを修正
 * mouse.min.js / draggable.min.js / menu.min.js すべてに
 * jquery-ui-widget と jquery-ui-core を依存関係として強制追加する
 *
 * functions.php の末尾にこのコードを貼り付けてください
 */
add_action( 'wp_print_scripts', function () {
    global $wp_scripts;

    $required_deps = array( 'jquery-ui-core', 'jquery-ui-widget' );

    $targets = array( 'jquery-ui-mouse', 'jquery-ui-draggable', 'jquery-ui-menu' );

    foreach ( $targets as $handle ) {
        if ( isset( $wp_scripts->registered[ $handle ] ) ) {
            foreach ( $required_deps as $dep ) {
                if ( ! in_array( $dep, $wp_scripts->registered[ $handle ]->deps, true ) ) {
                    $wp_scripts->registered[ $handle ]->deps[] = $dep;
                }
            }
        }
    }
}, 1 );
