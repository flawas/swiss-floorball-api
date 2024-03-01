<?php

    /**
	 * Retrieve the all teams of the club (Admin)
	 *
	 * @since     1.0.0
	 * @return    html table
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

            <table class="table">
                    <thead>
                        <tr>
                            <th>team_id</th>
                            <th>Team Name</th>
                            <th>Meisterschaft</th>
                            <th>Cup<th>
                        </tr>
                    </thead>
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
    
    /**
	 * Retrieve the all teams of the club (Public)
	 *
	 * @since     1.0.0
	 * @return    html table
	 */
	function get_club_teams_pub($swissfloorball_club_number) {
        # Nur ausführen, wenn $swissfloorball_club_number gesetzt ist
        if($swissfloorball_club_number > 0 || $swissfloorball_club_number > "") {
            $response = wp_remote_get( 'https://api-v2.swissunihockey.ch/api/clubs/'.$swissfloorball_club_number.'/statistics' );
            $api_response = json_decode( wp_remote_retrieve_body( $response ), true );
            
            $team_count = count($api_response["data"]["regions"]["0"]["rows"]);
            
            ?>
            <h5><?php echo $api_response["data"]["title"];?></h5>
            <table class="table">
                    <thead>
                        <tr>
                            <th>Team Name</th>
                            <th>Meisterschaft Platzierung</th>
                        </tr>
                    </thead>
                    <?php 
                    for ($i = 0; $i < $team_count; $i++) {
                        ?>
                        <tr>        
						    <td><?php echo $api_response["data"]["regions"]["0"]["rows"][$i]["cells"]["0"]["text"]["0"];?></td>
                            <td><?php echo $api_response["data"]["regions"]["0"]["rows"][$i]["cells"]["1"]["text"]["0"];?></td>
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
        <h5><?php echo $api_response["data"]["title"];?></h5>

        <table class="table">
                <thead>
                    <tr>
                        <th>Datum / Zeit</th>
                        <th>Liga / Gruppe</th>
                        <th>Heimteam</th>
                        <th>Gastteam</th>
                        <th>Ort</th>
                        <th>Resultat</th>
                    </tr>
                </thead>
                <tbody>
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
                        <td><?php echo $place_location; echo $place_name;?></td>
                        <td><?php echo $result;?></td>
                    </tr>
                    <?php 
                }
                ?>
                </tbody>
            </table>
        <?php
    }

    function get_team_games($swissfloorball_team_number, $season){
        $response = wp_remote_get( 'https://api-v2.swissunihockey.ch/api/games?mode=team&team_id='.$swissfloorball_team_number.'&season='.$season.'');
        $api_response = json_decode( wp_remote_retrieve_body( $response ), true );
        $calendar_count = count($api_response["data"]["regions"]["0"]["rows"]);
        ?>
        <h2><?php echo $api_response["data"]["title"];?></h2>

        <table class="table">
                <tr>
                    <th>Datum / Zeit</th>
                    <th>Heimteam</th>
                    <th>Gastteam</th>
                    <th>Ort</th>
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

        <table class="table">
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

    function get_seasons() {
        $response = wp_remote_get( 'https://api-v2.swissunihockey.ch/api/seasons');
        $api_response = json_decode( wp_remote_retrieve_body( $response ), true );
        $club_count = count($api_response["entries"]);
        $seasons_count = count($api_response["entries"]);
        ?>
        <h2><?php echo $api_response["text"];?></h2>

        <table class="table">
                <tr>
                    <th>Club Name</th>
                    <th>Season_id</th>
                </tr>
                <?php 
                for ($i = 0; $i < $club_count; $i++) {
                    $name           = $api_response["entries"][$i]["text"];
                    $club_id         = $api_response["entries"][$i]["set_in_context"]["season"];
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

    function get_teams(){
        $response = wp_remote_get( 'https://api-v2.swissunihockey.ch/api/clubs');
        $api_response = json_decode( wp_remote_retrieve_body( $response ), true );
        $club_count = count($api_response["entries"]);
        ?>
        <h2><?php echo $api_response["text"];?></h2>

        <table class="table">
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

    function get_club_games_callout($swissfloorball_club_number, $season) {
        $response = wp_remote_get( 'https://api-v2.swissunihockey.ch/api/games?mode=club&club_id='.$swissfloorball_club_number.'&season='.$season.'');
        $api_response = json_decode( wp_remote_retrieve_body( $response ), true );
        $calendar_count = count($api_response["data"]["regions"]["0"]["rows"]);

        for ($i = 0; $i < ($calendar_count-3); $i++) {
        
        $game_id = $api_response["data"]["regions"]["0"]["rows"][$i]["link"]["ids"]["0"];
        $game_details = get_gamedetails($game_id);
        $result = explode(":", $game_details[6]);
        
        ?>
        <div class="card">
                <div class="row card-body">
                    <div class="col">
                        <?php echo "<img src=".$game_details[3]." alt='Vereinslogo' class='img-fluid rounded-start'>";?>
                        <h5 class="card-title text-center"><?php echo $result[0];?></h5>
                    </div>
                    <div class="col-6">
                    <div class="card-body text-center">                            
                            <p class="card-text"><?php echo $game_details[1];?></p>
                            <p class="card-text"><?php echo $game_details[9];?></p>
                            <p class="card-text"><?php echo $game_details[7];?>, <?php echo $game_details[8];?></p>
                        </div>
                    </div>
                    <div class="col">
                        <?php echo "<img src=".$game_details[5]." alt='Vereinslogo' class='img-fluid rounded-start'>";?>
                        <h5 class="card-title text-center"><?php echo $result[1];?></h5>
                    </div>
                </div>
        </div>
        <?php 
        }
    }

    function get_club_games_table($swissfloorball_club_number, $season) {
        $response = wp_remote_get( 'https://api-v2.swissunihockey.ch/api/games?mode=club&club_id='.$swissfloorball_club_number.'&season='.$season.'');
        $api_response = json_decode( wp_remote_retrieve_body( $response ), true );
        $calendar_count = count($api_response["data"]["regions"]["0"]["rows"]);


        ?>
        <div class="container">
            <div class="row">
        <?php

        for ($i = 2; $i < ($calendar_count-2); $i++) {
        
        $game_id = $api_response["data"]["regions"]["0"]["rows"][$i]["link"]["ids"]["0"];
        $game_details = get_gamedetails($game_id);
        
        ?>
        <div class="col-sm-6 md-4 mb-3">
            <div class="card">
                <div class="col">
                    <div class="text-center">
                        <h5><?php echo $game_details[0];?></h5>                        
                        <table class="table">
                                <tr>
                                    <th><h5></th>
                                    <td><?php echo "<img src=".$game_details[3]." alt='Vereinslogo' class='img-fluid rounded-start' style='max-height: 75px'>";?></td>
                                    <td><?php echo $game_details[6];?><br><p><?php echo $game_details[7];?>, <?php echo $game_details[8];?></p>
                                    <td><?php echo "<img src=".$game_details[5]." alt='Vereinslogo' class='img-fluid rounded-start' style='max-height: 75px'>";?></td>
                                </tr>
                        </table>
                        <p><?php echo $game_details[1];?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        }
        ?>
            </div>
        </div>
        <?php 
    }

    function get_teamdetails_image($team_id) {
        $response = wp_remote_get( 'https://api-v2.swissunihockey.ch/api/teams/'.$team_id.'');
        $api_response = json_decode( wp_remote_retrieve_body( $response ), true );
        $image_url = $api_response["data"]["regions"]["0"]["rows"]["0"]["cells"]["1"]["image"]["url"];
        return $image_url;
    }

    function get_gamedetails($game_id) {
        $response = wp_remote_get( 'https://api-v2.swissunihockey.ch/api/games/'.$game_id.'');
        $api_response = json_decode( wp_remote_retrieve_body( $response ), true );

        $gamedetails_team_home_image    = $api_response["data"]["regions"]["0"]["rows"]["0"]["cells"]["0"]["image"]["url"];
        $gamedetails_team_home_teamname = $api_response["data"]["regions"]["0"]["rows"]["0"]["cells"]["1"]["text"]["0"];

        $gamedetails_team_away_image    = $api_response["data"]["regions"]["0"]["rows"]["0"]["cells"]["2"]["image"]["url"];
        $gamedetails_team_away_teamname = $api_response["data"]["regions"]["0"]["rows"]["0"]["cells"]["3"]["text"]["0"];

        $gamedetails_title              = $api_response["data"]["title"];
        $gamedetails_subtitle           = $api_response["data"]["subtitle"];
        $gamedetails_result             = $api_response["data"]["regions"]["0"]["rows"]["0"]["cells"]["4"]["text"]["0"];

        $gamedetails_playdate           = $api_response["data"]["regions"]["0"]["rows"]["0"]["cells"]["5"]["text"]["0"];
        $gamedetails_playtime           = $api_response["data"]["regions"]["0"]["rows"]["0"]["cells"]["6"]["text"]["0"];
        $gamedetails_venue              = $api_response["data"]["regions"]["0"]["rows"]["0"]["cells"]["7"]["text"]["0"];

        $return_array = array($gamedetails_title, $gamedetails_subtitle, $gamedetails_team_home_teamname, $gamedetails_team_home_image, $gamedetails_team_away_teamname,
            $gamedetails_team_away_image, $gamedetails_result, $gamedetails_playdate, $gamedetails_playtime, $gamedetails_venue);

        return $return_array;
    }

    #ToDo Check Parameters


    function get_team_ranking($season, $league, $game_class, $group) {

    }

    # ToDo Rankings
    # https://api-v2.swissunihockey.ch/api/rankings?season=2023&league=5&game_class=11&group=415793

?>