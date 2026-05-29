<?php
/**
 * jQuery UI menu.min.js の "a.widget is not a function" エラーを修正
 * widget ファクトリが menu より先に読み込まれるよう依存関係を強制する
 *
 * functions.php の末尾にこのコードを貼り付けてください
 */
add_action( 'wp_print_scripts', function () {
    global $wp_scripts;
    if ( isset( $wp_scripts->registered['jquery-ui-menu'] ) ) {
        $deps = &$wp_scripts->registered['jquery-ui-menu']->deps;
        if ( ! in_array( 'jquery-ui-widget', $deps, true ) ) {
            $deps[] = 'jquery-ui-widget';
        }
        if ( ! in_array( 'jquery-ui-core', $deps, true ) ) {
            $deps[] = 'jquery-ui-core';
        }
    }
}, 1 );
