<?php if (isset($all_strings) && ! empty($all_strings)) {
    $count = count($result);

    echo '<h6>Найдено совпадений: ' .$count. '</h6>';

    echo '<ol>';
    for ($num_article = 0; $num_article < $count; $num_article++){
        
        echo "<li><a href=" .$_SERVER['PHP_SELF']. "?action=article&id=" .$result[$num_article]['id']. ">"
                .$result[$num_article]['title']. "</a></li><div>";
        
        foreach ($all_strings[$num_article] as $str)
            echo '<span>...' .$str.'..., </span>';
        
        echo '</div>';
    }
    echo '</ol>';
    
}?>
        
    