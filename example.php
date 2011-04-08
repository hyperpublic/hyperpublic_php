<?php 

error_reporting(E_ALL); 
ini_set("display_errors", 1); 

require_once("hyperpublic_php/hyperpublic.php");
require_once("config.php");

$hyperpublic = new Hyperpublic(CONSUMER_KEY,CONSUMER_SECRET);

?>

<!doctype html>
<html>
  <head>
    <title>Example Useage of the Hyperpublic API in PHP</title>
    <style>
      body {
        font-family: sans-serif;
      }
    </style>
  </head>
  <body>


<?php         
        /*
         * Look up a user by ID.
         */
         $me = $hyperpublic->people->show(4);
?>
    <!-- Get a user's name -->
      <h1>Hi. My Name is <?php echo $me->headline ?>.</h1>
      <!-- Get a user's picture -->
      <img src='<?php echo $me->image->src_large ?>' />
      <p>If you don't already know me, here are some words to describe me.</p>
      <!-- Get a list of tags associated with a user -->
      <ul>
        <?php           
          foreach($me->tags as $tag) {
            if(!empty($tag)) {
              echo "<li>{$tag}</li>";
            }
          }
      ?>
    </ul>
      <h1>I work at Hyperpublic. Check out a picture of our office.</h1>
      <?php
        /*
         * Look up a place by ID.
         */
         $myOffice = $hyperpublic->places->show(5092);
      ?>
      <!-- Get a picture of a place -->
      <img src=<?php echo "'{$myOffice->image->src_large}'" ?> />
      <h1>Lets see where its located.</h1>
      <!-- Get the lat/lon of a place and put it on a static Google Map -->
      <img src= <?php echo "'http://maps.google.com/maps/api/staticmap?center={$myOffice->locations[0]->lat},{$myOffice->locations[0]->lon}&zoom=14&size=400x400&sensor=false&markers=color:blue%7Clabel:H%7C{$myOffice->locations[0]->lat},{$myOffice->locations[0]->lon}'" ?> />
      <h1>That was easy. Let's see some developers.</h1>
      <!-- Get people tagged as 'developer' -->
      <?php         
       /*
        * Look up people who tagged themselves as a developer.
        */
        $developers = $hyperpublic->people->find(array('tags' => 'developer'));
        foreach($developers as $developer){
          if (!empty($developer->image->src_large)){
            echo "<img src='{$developer->image->src_large}'/>";
          }
        }   
      ?>
      <h1>Ok. Let's find 10 places near my house.</h1>      
      <!-- Get the lat/lon of 10 places in williamsburg, brooklyn and then put it on a static Google Map -->
      <?php                                                            
        $markers = array();
        $latLon = NULL;        


        /*
         * Look up places in my neighborhood.
         */
         $williamsburgPlaces = $hyperpublic->places->find(array('location[neighborhood]'=>'williamsburg','limit'=>'10'));

        foreach($williamsburgPlaces as $williamsburgPlace){
            if(!empty($williamsburgPlace->locations[0]->lat) && !empty($williamsburgPlace->locations[0]->lon)) {
              $latLon = $williamsburgPlace->locations[0]->lat . "," . $williamsburgPlace->locations[0]->lon;
              array_push($markers,$latLon);
              unset($latLon);
            }
          }
        $markers = implode('%7C',$markers);        
      ?>      
      <img src="http://maps.google.com/maps/api/staticmap?center=Williamsburg,Brooklyn,NY&zoom=12&size=400x400&sensor=false&markers=color:blue%7Clabel:H%7C<?php echo $markers; ?>" />

      <h1>My good friend Nick put his avocado tree on Hyperpublic. Let's see what it looks like.</h1>
      <!-- Get a photograph of a thing -->
    <?php 

    /*
     * Look up a thing by ID.
     */
     $avocadoTree = $hyperpublic->things->show(415);
    ?>

      <?php echo "<img src='{$avocadoTree->image->src_large}'>"?>
    <h1>Do want. I hope its not too far from my house.</h1>
    <!-- Get the lat/lon of a thing and put it on a Google Map -->
    <?php
    echo "<img src='http://maps.google.com/maps/api/staticmap?center={$avocadoTree->locations[0]->lat},{$avocadoTree->locations[0]->lon}&zoom=14&size=400x400&sensor=false&markers=color:blue%7Clabel:H%7C{$avocadoTree->locations[0]->lat},{$avocadoTree->locations[0]->lon}'/>" ?> 
    <h1>Oof. Marina Del Ray. I guess we can look up healthy restaurants near my house. I bet they have avocados.</h1>
    <!-- Get the lat/lon of an array of places tagged 'healthy' near the zipcode 11211. Put them on a static Google Map -->
    <?php                                                            
        unset($markers);
        $markers = array();
        $latLon = NULL;                     
        $count = 0;      
        /*
         * Look up things tagged fun
         */
         $healthy = $hyperpublic->places->find(array('tags'=>'healthy', 'location[zipcode]' => '11211'));
                 
        foreach($healthy as $place){
          if(!empty($place->locations[0]->lat) && !empty($place->locations[0]->lon)) {
            $latLon = $place->locations[0]->lat . "," . $place->locations[0]->lon;
            array_push($markers,$latLon);
            unset($latLon);            
            }
          }
        $markers = implode('%7C',$markers);                
        echo "<img src='http://maps.google.com/maps/api/staticmap?center=11211&zoom=14&size=400x400&sensor=false&markers=color:blue%7Clabel:H%7C{$markers}'/>"         
    ?> 
    <!-- Get the names of the healthy restaurants near 11211. -->
    <?php 
        $names = array();

        foreach($healthy as $restaurant){
          if(!empty($restaurant->name)){
            array_push($names,$restaurant->name);
            }
        }
    ?>
    <!-- get two at random from the array -->
    <?php $rand = array_rand($names, 2); ?>    
    <!-- print the names of two restaurants -->
    <h1>Great. I think it's going to be between <?php echo $names[$rand[0]] . ' or ' . $names[$rand[1]]; ?>.</h1>
        <p>This is a basic example of interaction with the Hyperpublic API. If you have futher questions, please feel free to join the Hyperpublic API mailing list at <a href="http://groups.google.com/group/hyperpublic-api-developers">http://groups.google.com/group/hyperpublic-api-developers</a>.</p>
  </body>
</html>