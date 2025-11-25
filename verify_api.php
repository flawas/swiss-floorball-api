<?php
// Mock WordPress functions
function wp_remote_get($url) {
    echo "Fetching URL: " . $url . "\n";
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => 'User-Agent: SwissFloorballApiVerification/1.0'
        ]
    ]);
    $response = @file_get_contents($url, false, $context);
    
    if ($response === false) {
        return new WP_Error('http_request_failed', 'Request failed');
    }
    
    return [
        'response' => ['code' => 200],
        'body' => $response
    ];
}

function is_wp_error($thing) {
    return $thing instanceof WP_Error;
}

function wp_remote_retrieve_response_code($response) {
    return $response['response']['code'];
}

function wp_remote_retrieve_body($response) {
    return $response['body'];
}

function __($text, $domain) {
    return $text;
}

function _e($text, $domain) {
    echo $text;
}

function get_option($option) {
    // Return dummy values for options
    if ($option === 'swissfloorball_club_number') return '415793'; // Example club ID
    if ($option === 'swissfloorball_actual_season') return '2023';
    return '';
}

class WP_Error {
    public function __construct($code, $message) {}
}

// Include the functions file
require_once 'includes/functions.php';

// Test functions
echo "Testing get_clubs()...\n";
ob_start();
get_clubs();
$output = ob_get_contents();
ob_end_clean();
echo "Length of output: " . strlen($output) . "\n";
if (strpos($output, 'Club Name') !== false) echo "SUCCESS: get_clubs returned table.\n";
else echo "FAILURE: get_clubs did not return expected table.\n";

echo "\nTesting get_calendars(club_id=415793)...\n";
ob_start();
get_calendars(null, '415793');
$output = ob_get_contents();
ob_end_clean();
echo "Length of output: " . strlen($output) . "\n";
if (strpos($output, 'Kalender abonnieren') !== false) echo "SUCCESS: get_calendars returned link.\n";
else echo "FAILURE: get_calendars did not return expected link.\n";

echo "\nTesting get_cups()...\n";
ob_start();
get_cups();
$output = ob_get_contents();
ob_end_clean();
echo "Length of output: " . strlen($output) . "\n";
if (strpos($output, 'Runde') !== false) echo "SUCCESS: get_cups returned table.\n";
else echo "FAILURE: get_cups did not return expected table.\n";

echo "\nTesting get_groups(2023, 1, 11)...\n";
ob_start();
get_groups('2023', '1', '11');
$output = ob_get_contents();
ob_end_clean();
echo "Length of output: " . strlen($output) . "\n";
if (strpos($output, 'Gruppe') !== false) echo "SUCCESS: get_groups returned table.\n";
else echo "FAILURE: get_groups did not return expected table.\n";

echo "\nTesting get_teams()...\n";
ob_start();
get_teams();
$output = ob_get_contents();
ob_end_clean();
echo "Length of output: " . strlen($output) . "\n";
if (strpos($output, 'Website') !== false) echo "SUCCESS: get_teams returned table.\n";
else echo "FAILURE: get_teams did not return expected table.\n";

echo "\nTesting get_rankings(2023, 1, 11, 415793)...\n"; // Example params
ob_start();
get_rankings('2023', '1', '11', '415793');
$output = ob_get_contents();
ob_end_clean();
echo "Length of output: " . strlen($output) . "\n";

echo "\nTesting get_player(464591)...\n"; // Example player ID from national players list
ob_start();
get_player('464591');
$output = ob_get_contents();
ob_end_clean();
echo "Length of output: " . strlen($output) . "\n";
// We expect some output, maybe not specific text as we just dump print_r

echo "\nTesting get_national_players()...\n";
ob_start();
get_national_players();
$output = ob_get_contents();
ob_end_clean();
echo "Length of output: " . strlen($output) . "\n";
if (strpos($output, 'Name') !== false) echo "SUCCESS: get_national_players returned table.\n";
else echo "FAILURE: get_national_players did not return expected table.\n";

echo "\nTesting get_topscorers(2023, 1, 11, 415793)...\n";
ob_start();
get_topscorers('2023', '1', '11', '415793');
$output = ob_get_contents();
ob_end_clean();
echo "Length of output: " . strlen($output) . "\n";

echo "\nTesting get_game_events(123456)...\n"; // Dummy game ID
ob_start();
get_game_events('123456');
$output = ob_get_contents();
ob_end_clean();
echo "Length of output: " . strlen($output) . "\n";

?>
