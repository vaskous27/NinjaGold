<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <link type="text/css" rel="stylesheet" href="/assets/stylesheets/ninjagold.css"> 
   <title>Ninja Gold</title>

   <body>
      <div id="container">

<?php
		echo $this->session->userdata('welcome');
?>

      	<span class="scoreText">Your Gold: <?php echo $this->session->userdata('gold'); ?> </span>

        <div class="row">
          <div class="actions">
	          <h3>Farm</h3>
	          <p>(earns 10-20 gold)</p>
	          <form action='/process' method='post'>
	            <input type="hidden" name="action" value="farm">
	            <input type="submit" value="Find Gold!">
	          </form>
          </div>

          <div class="actions">
	          <h3>Cave</h3>
	          <p>(earns 5-10 gold)</p>
	          <form action='/process' method='post'>
	            <input type="hidden"  name="action" value="cave">
	            <input type="submit" value="Find Gold!">
	          </form>
          </div>

          <div class="actions">
	          <h3>House</h3>
	          <p>(earns 2-5 gold)</p>
	          <form action='/process' method='post'>
	            <input type="hidden" name="action" value="house">
	            <input type="submit" value="Find Gold!">
	           </form>
          </div>

          <div class="actions">
	          <h3>Casino</h3>
	          <p>(earns/takes 0-50 gold)</p>
	          <form action='/process' method='post'>
	            <input type="hidden"  name="action" value="casino">
	            <input type="submit" value="Find Gold!">
	          </form>
          </div> 
        </div>

        <p>Activities:</p>
        <div id="textlog">
<?php 

		foreach($this->session->userdata('activities') as $activity) {
        		echo $activity;
        } 
?>
        </div>

        <span class=button> <a href='/NinjaGold/reset'><button>Reset!</button></a></span>
         <span class=button> <a href='/NinjaGold/logout'><button>Logout!</button></a></span>

      </div>
  </body>
</html>