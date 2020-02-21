 <?php 
	if(!empty($res) && isset($res->main)){
 
 ?>
 <style>
 b, strong {
    font-weight: bolder;
    color: red;
}
 </style>
 <div>
	<h6> Weather IN  <strong> {{$res->name}}</strong></h6>
	<p> <strong>Status 		</strong> : {{$res->weather[0]->main}}</p>
	<p> <strong>temp 		</strong> : {{$res->main->temp}}</p>
	<p> <strong>min temp 	</strong> : {{$res->main->temp_min}}</p>
	<p> <strong>max temp 	</strong> : {{$res->main->temp_max}}</p>
	<p> <strong>pressure 	</strong> : {{$res->main->pressure}}</p>
	<p> <strong>wind speed 	</strong> : {{$res->wind->speed}}</p>
	<p> <strong>wind degree </strong> : {{$res->wind->deg}}</p>
	
 </div>
 
	<?php }else{ ?>
	<div> <h6> City Not Found</h6></div>
		
	<?php } ?>