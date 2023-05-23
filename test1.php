
<?php
require('data.php');

function nested_key_values($data, $indent = '') {
    if (is_array($data) || is_object($data)) {
        foreach ($data as $key => $value) {
            if (is_array($value) || is_object($value)) {
                if(is_array($value)) {
                    if(is_numeric($key)) {
                        echo "\n";  
                    } else {
                        echo $key;    
                    }
                }
                nested_key_values($value, $indent . '  ');
            } else {
                echo $indent . $key . ": " . $value . "\n";
            }
        }
    } else {
        echo $indent . $data . "\n";
    }
}

?>

<!DOCTYPE html>
<pre>
    <?php nested_key_values($data); ?>
</pre>