<?php
class AnoBissexto{
	
	public function ehBissexto($ano){
		$bissexto = false;		
		if ( (($ano%4) == 0 && ($ano%100) != 0) || ($ano%400) == 0 ) {
			$bissexto = true;
		}	
		return $bissexto;
	}
	
}

?>