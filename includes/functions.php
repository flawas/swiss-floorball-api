<?php
/**
	 * Retrieve the all teams of the club
	 *
	 * @since     1.0.0
	 * @return    string    JSON string
	 */
	function get_club_teams($swissfloorball_club_number) {
        # Nur ausführen, wenn $swissfloorball_club_number gesetzt ist
        if($swissfloorball_club_number > 0 || $swissfloorball_club_number > "") {
            $response = wp_remote_get( 'https://api-v2.swissunihockey.ch/api/clubs/'.$swissfloorball_club_number.'/statistics' );
            $api_response = json_decode( wp_remote_retrieve_body( $response ), true );
            
            $team_count = count($api_response["data"]["regions"]["0"]["rows"]);
            
            ?>
            <h2><?php echo $api_response["data"]["title"];?></h2>
            <p>Teams bei Swiss Unihockey angemeldet: <?php echo $team_count;?></p>

            <table>
					<tr>
						<th>team_id</th>
						<th>Team Name</th>
                        <th>Meisterschaft</th>
                        <th>Cup<th>
					</tr>
                    <?php 
                    for ($i = 0; $i < $team_count; $i++) {
                        ?>
                        <tr>        
						    <td><?php echo $api_response["data"]["regions"]["0"]["rows"][$i]["team_id"];?></td>
						    <td><?php echo $api_response["data"]["regions"]["0"]["rows"][$i]["cells"]["0"]["text"]["0"];?></td>
                            <td><?php echo $api_response["data"]["regions"]["0"]["rows"][$i]["cells"]["1"]["text"]["0"];?></td>
                            <td><?php echo $api_response["data"]["regions"]["0"]["rows"][$i]["cells"]["2"]["text"]["0"];?></td>
					    </tr>
                        <?php 
                    }
                    ?>
				</table>
            <?php
        }
	}

    function get_club_games($swissfloorball_club_number, $season) {
        $response = wp_remote_get( 'https://api-v2.swissunihockey.ch/api/games?mode=club&club_id='.$swissfloorball_club_number.'&season='.$season.'');
        $api_response = json_decode( wp_remote_retrieve_body( $response ), true );
        $calendar_count = count($api_response["data"]["regions"]["0"]["rows"]);
        ?>
        <h2><?php echo $api_response["data"]["title"];?></h2>

        <table>
                <tr>
                    <th>Datum / Zeit</th>
                    <th>Liga / Gruppe</th>
                    <th>Heimteam</th>
                    <th>Gastteam</th>
                    <th>Ort<th>
                    <th>Resultat</th>
                </tr>
                <?php 
                for ($i = 0; $i < $calendar_count; $i++) {

                    $date           = $api_response["data"]["regions"]["0"]["rows"][$i]["cells"]["0"]["text"]["0"];
                    $time           = $api_response["data"]["regions"]["0"]["rows"][$i]["cells"]["0"]["text"]["1"];
                    $place_location = $api_response["data"]["regions"]["0"]["rows"][$i]["cells"]["1"]["text"]["0"];
                    $place_name     = $api_response["data"]["regions"]["0"]["rows"][$i]["cells"]["1"]["text"]["1"];
                    $league         = $api_response["data"]["regions"]["0"]["rows"][$i]["cells"]["2"]["text"]["0"];
                    $team_home      = $api_response["data"]["regions"]["0"]["rows"][$i]["cells"]["3"]["text"]["0"];
                    $team_away      = $api_response["data"]["regions"]["0"]["rows"][$i]["cells"]["4"]["text"]["0"];
                    $result         = $api_response["data"]["regions"]["0"]["rows"][$i]["cells"]["5"]["text"]["0"];


                    ?>
                    <tr>        
                        <td><?php echo $date;?> <?php echo $time; ?></td>
                        <td><?php echo $league;?></td>
                        <td><?php echo $team_home;?></td>
                        <td><?php echo $team_away;?></td>
                        <td><?php echo $place_location;?>, <?php echo $place_name;?></td>
                        <td><?php echo $result;?></td>
                    </tr>
                    <?php 
                }
                ?>
            </table>
        <?php
    }

    function get_team_games($swissfloorball_team_number, $season){
        $response = wp_remote_get( 'https://api-v2.swissunihockey.ch/api/games?mode=team&team_id='.$swissfloorball_team_number.'&season='.$season.'');
        $api_response = json_decode( wp_remote_retrieve_body( $response ), true );
        $calendar_count = count($api_response["data"]["regions"]["0"]["rows"]);
        ?>
        <h2><?php echo $api_response["data"]["title"];?></h2>

        <table>
                <tr>
                    <th>Datum / Zeit</th>
                    <th>Heimteam</th>
                    <th>Gastteam</th>
                    <th>Ort<th>
                    <th>Resultat</th>
                </tr>
                <?php 
                for ($i = 0; $i < $calendar_count; $i++) {

                    $date           = $api_response["data"]["regions"]["0"]["rows"][$i]["cells"]["0"]["text"]["0"];
                    $time           = $api_response["data"]["regions"]["0"]["rows"][$i]["cells"]["0"]["text"]["1"];
                    $place_location = $api_response["data"]["regions"]["0"]["rows"][$i]["cells"]["1"]["text"]["0"];
                    $place_name     = $api_response["data"]["regions"]["0"]["rows"][$i]["cells"]["1"]["text"]["1"];
                    $team_home      = $api_response["data"]["regions"]["0"]["rows"][$i]["cells"]["2"]["text"]["0"];
                    $team_away      = $api_response["data"]["regions"]["0"]["rows"][$i]["cells"]["3"]["text"]["0"];
                    $result         = $api_response["data"]["regions"]["0"]["rows"][$i]["cells"]["4"]["text"]["0"];

                    ?>
                    <tr>        
                        <td><?php echo $date;?> <?php echo $time; ?></td>
                        <td><?php echo $team_home;?></td>
                        <td><?php echo $team_away;?></td>
                        <td><?php echo $place_location;?>, <?php echo $place_name;?></td>
                        <td><?php echo $result;?></td>
                    </tr>
                    <?php 
                }
                ?>
            </table>
        <?php
    }

    function get_leagues(){
        $response = wp_remote_get( 'https://api-v2.swissunihockey.ch/api/leagues');
        $api_response = json_decode( wp_remote_retrieve_body( $response ), true );
        $leagues_count = count($api_response["entries"]);
        ?>
        <h2><?php echo $api_response["text"];?></h2>

        <table>
                <tr>
                    <th>Name</th>
                    <th>League Nummer</th>
                    <th>Game_class</th>
                </tr>
                <?php 
                for ($i = 0; $i < $leagues_count; $i++) {

                    $name           = $api_response["entries"][$i]["text"];
                    $league         = $api_response["entries"][$i]["set_in_context"]["league"];
                    $game_class     = $api_response["entries"][$i]["set_in_context"]["game_class"];

                    ?>
                    <tr>        
                        <td><?php echo $name;?></td>
                        <td><?php echo $league;?></td>
                        <td><?php echo $game_class;?></td>
                    </tr>
                    <?php 
                }
                ?>
            </table>
        <?php
    }

    function get_teams(){
        $response = wp_remote_get( 'https://api-v2.swissunihockey.ch/api/clubs');
        $api_response = json_decode( wp_remote_retrieve_body( $response ), true );
        $club_count = count($api_response["entries"]);
        ?>
        <h2><?php echo $api_response["text"];?></h2>

        <table>
                <tr>
                    <th>Club Name</th>
                    <th>Club_id</th>
                </tr>
                <?php 
                for ($i = 0; $i < $club_count; $i++) {
                    $name           = $api_response["entries"][$i]["text"];
                    $club_id         = $api_response["entries"][$i]["set_in_context"]["club_id"];
                    ?>
                    <tr>        
                        <td><?php echo $name;?></td>
                        <td><?php echo $club_id;?></td>
                    </tr>
                    <?php 
                }
                ?>
            </table>
        <?php
    }

    # ToDo Rankings
    # https://api-v2.swissunihockey.ch/api/rankings?season=2023&league=5&game_class=11&group=415793

?>