<?php

$data =
    array(
        array(
            'guest_id' => 177,
            'guest_type' => 'crew',
            'first_name' => 'Marco',
            'middle_name' => NULL,
            'last_name' => 'Burns',
            'gender' => 'M',
            'guest_booking' => array(
                array(
                    'booking_number' => 20008683,
                    'ship_code' => 'OST',
                    'room_no' => 'A0073',
                    'start_time' => 1438214400,
                    'end_time' => 1483142400,
                    'is_checked_in' => true,
                ),
            ),
            'guest_account' => array(
                array(
                    'account_id' => 20009503,
                    'status_id' => 2,
                    'account_limit' => 0,
                    'allow_charges' => true,
                ),
            ),
        ),
        array(
            'guest_id' => 10000113,
            'guest_type' => 'crew',
            'first_name' => 'Bob Jr ',
            'middle_name' => 'Charles',
            'last_name' => 'Hemingway',
            'gender' => 'M',
            'guest_booking' => array(
                array(
                    'booking_number' => 10000013,
                    'room_no' => 'B0092',
                    'is_checked_in' => true,
                ),
            ),
            'guest_account' => array(
                array(
                    'account_id' => 10000522,
                    'account_limit' => 300,
                    'allow_charges' => true,
                ),
            ),
        ),
        array(
            'guest_id' => 10000114,
            'guest_type' => 'crew',
            'first_name' => 'Al ',
            'middle_name' => 'Bert',
            'last_name' => 'Santiago',
            'gender' => 'M',
            'guest_booking' => array(
                array(
                    'booking_number' => 10000014,
                    'room_no' => 'A0018',
                    'is_checked_in' => true,
                ),
            ),
            'guest_account' => array(
                array(
                    'account_id' => 10000013,
                    'account_limit' => 300,
                    'allow_charges' => false,
                ),
            ),
        ),
        array(
            'guest_id' => 10000115,
            'guest_type' => 'crew',
            'first_name' => 'Red ',
            'middle_name' => 'Ruby',
            'last_name' => 'Flowers ',
            'gender' => 'F',
            'guest_booking' => array(
                array(
                    'booking_number' => 10000015,
                    'room_no' => 'A0051',
                    'is_checked_in' => true,
                ),
            ),
            'guest_account' => array(
                array(
                    'account_id' => 10000519,
                    'account_limit' => 300,
                    'allow_charges' => true,
                ),
            ),
        ),
        array(
            'guest_id' => 10000116,
            'guest_type' => 'crew',
            'first_name' => 'Ismael ',
            'middle_name' => 'Jean-Vital',
            'last_name' => 'Jammes',
            'gender' => 'M',
            'guest_booking' => array(
                array(
                    'booking_number' => 10000016,
                    'room_no' => 'A0023',
                    'is_checked_in' => true,
                ),
            ),
            'guest_account' => array(
                array(
                    'account_id' => 10000015,
                    'account_limit' => 300,
                    'allow_charges' => true,
                ),
            ),
        ),
    );

/**
 * Sort multi-dimensional array by an array of keys.
 * 
 * @param array $sortKeys This keys will be used to sort array, where last key has highest priority.
 * @param array $array This is array which will be sorted (main array). This array is passed by reference because it is modified inside of usort.
 * @param array $firstElement This is first element of main array, which is an array. This array is passed by reference because it is modified during sortByKeys() recursion.
 * @param array $sortPath This is the path to key value pair by witch main array will be sorted. Path is constructed from keys, for example [guest_booking][0][start_time] is path to start_time value
 * @param string $order This is the order in which array will be sorted ASC or DESC.
 * 
 * @return void 
 */
function sortByKeys($sortKeys, &$array, &$firstElement, &$sortPath, $order = "ASC")
{
    foreach ($sortKeys as $sortKey) {
        foreach ($firstElement as $key => $value) {
            if (is_array($value) && sizeof($value)) {
                // as long as $value is array we go thru this function in recursion
                $sortPath[$sortKey][] = $key;
                sortByKeys([$sortKey], $array, $value, $sortPath, $order = "ASC");
            }

            if ($sortKey === $key) {
                // if we got here, it means we found complete path to key $sortKey and we can start sorting $array
                $sortPath[$sortKey][] = $key;
                $sort = $sortPath[$sortKey];
                usort($array, function ($a, $b) use ($sort, $order) {
                    foreach ($sort as $key) {
                        $a = $a[$key];
                        $b = $b[$key];
                    }

                    if ($a == $b) {
                        return 0;
                    }
                    if ($order == "ASC") {
                        return ($a < $b) ? -1 : 1;
                    } else {
                        return ($a < $b) ? 1 : -1;
                    }
                });

                // removing sort path, as we don't need it anymore
                unset($sortPath[$sortKey]);
                break;
            }

            if ($sortKey !== $key && !is_array($value) && end($firstElement) === $value) {
                // here we will get only when we the deepest array and it doesn't contain key that we need for sorting, 
                // in this case we need to delete all we keys from $sortPath[$sortKey]
                $sortPath[$sortKey] = null;
            }
        }
    }
}

$firstElement = $data[0];
$sortKeys = ['account_id', 'account_limit', 'gender'];
sortByKeys($sortKeys, $data, $firstElement, $sortPath);
print_r($data);
