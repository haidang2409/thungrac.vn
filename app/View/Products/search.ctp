<?php
function highlight($text, $words) {
    preg_match_all('~\w+~', $words, $m);
    if(!$m)
        return $text;
    $re = '~\\b(' . implode('|', $m[0]) . ')\\b~';
    return preg_replace($re, '<b>$0</b>', $text);
}

//$text = '
//Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
//tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
//quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
//consequat.
//';
$text = '
Lorem nhà dolor sit amet, căn hộ mini adipisicing elit, sed do eiusmod
tempor văn phòng ut đất et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation căn hộ nisiut căn ex ea commodo labore
consequat.
';

$words = 'can hộ labore';

print highlight($text, $words);



function highlight_word( $content, $word, $color ) {
    $replace = '<span style="background-color: ' . $color . ';">' . $word . '</span>'; // create replacement
    $content = str_replace( $word, $replace, $content ); // replace content

    return $content; // return highlighted data
}

function highlight_words( $content, $words, $colors ) {
    $color_index = 0; // index of color (assuming it's an array)

    // loop through words
    foreach( $words as $word ) {
        $content = highlight_word( $content, $word, $colors[$color_index] ); // highlight word
        $color_index = ( $color_index + 1 ) % count( $colors ); // get next color index
    }

    return $content; // return highlighted data
}
