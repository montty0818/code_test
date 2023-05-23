<?php
require('data.php');

function sortDataStructure($data, $sortBy) {
    if (!is_array($data)) {
        return $data;
    }

    uasort($data, function ($a, $b) use ($sortBy) {
        foreach ($sortBy as $field) {
            $aValue = findFieldValue($a, $field);
            $bValue = findFieldValue($b, $field);

            if ($aValue !== $bValue) {
                return $aValue <=> $bValue;
            }
        }

        return 0;
    });

    foreach ($data as &$value) {
        if (is_array($value)) {
            $value = sortDataStructure($value, $sortBy);
        }
    }

    return $data;
}

function findFieldValue($data, $field) {
    if (!is_array($data)) {
        return null;
    }

    if (isset($data[$field])) {
        return $data[$field];
    }

    foreach ($data as $value) {
        if (is_array($value)) {
            $result = findFieldValue($value, $field);
            if ($result !== null) {
                return $result;
            }
        }
    }

    return null;
}

$sortedData = sortDataStructure($data, ['last_name', 'account_id']);
?>

<!DOCTYPE html>
<pre>
    <?php print_r($sortedData); ?>
</pre>