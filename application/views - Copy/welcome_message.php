<?php $CI =& get_instance(); ?>
	<div id="body">
		<p>
        	<a href="<?php echo $CI->router->class."/change/thailand"; ?>">TH</a> | 
        	<a href="<?php echo $CI->router->class."/change/english"; ?>">EN</a>
        </p>
		<?php
			foreach($blog as $row){
				$content = $row['topic_'.$suffix]; // มี suffix ต่อท้ายฟิลด์เสมอ
			}
		?>
		<p><?=$content; ?></p>
	</div>