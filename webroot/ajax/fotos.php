<?php
	$fotos = $_POST['fotos'];	
	
   echo '<div id="myCarousel" class="carousel slide" data-ride="carousel">';
    echo '<ol class="carousel-indicators">';
    foreach ($fotos as $key => $value) {
    		if($key==0){
    			 echo '<li data-target="#myCarousel" data-slide-to="'.$key.'" class="active"></li>';
    		}else{
    			 echo '<li data-target="#myCarousel" data-slide-to="'.$key.'"></li>';
    		}
    }
    
  echo '</ol>';

echo '<div class="carousel-inner">';

	foreach ($fotos as $key => $value) {

		if($key==0){

			echo '<div class="item active">';
		      echo '<IMG SRC="../uploads/'.$value['foto'].'" WIDTH=500>';
		    echo '</div>';

		}else{

			echo '<div class="item">';
		      echo '<IMG SRC="../uploads/'.$value['foto'].'" WIDTH=500>';
		    echo '</div>';
		}
		
	}
      
  echo '</div>';

     echo '<a class="left carousel-control" href="#myCarousel" data-slide="prev">';
    echo '<span class="glyphicon glyphicon-chevron-left"></span>';
    echo '<span class="sr-only">Previous</span>';
  echo '</a>';
  echo '<a class="right carousel-control" href="#myCarousel" data-slide="next">';
    echo '<span class="glyphicon glyphicon-chevron-right"></span>';
   echo ' <span class="sr-only">Next</span>';
  echo '</a>';
echo '</div>';

?>