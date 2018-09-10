<?php 
class FebTimeHelper extends AppHelper  {

    public $helpers = array('Time');
	

    function niceShort($dateString = null, $userOffset = null, $options = array()) {
        setlocale(LC_ALL, 'pl-PL.utf8', 'pl_PL.UTF8', 'pl_PL.utf8', 'pl_PL.UTF-8', 'pl_PL.utf-8', 'polish_POLISH.UTF8', 'polish_POLISH.utf8', 'pl.UTF8', 'polish.UTF8', 'polish-pl.UTF8', 'PL.UTF8', 'polish.utf8', 'polish-pl.utf8', 'PL.utf8','polish');
        //setlocale(LC_TIME, 'pl_PL.UTF-8', 'polish', 'pl.UTF-8', 'pol.UTF-8');
        
        $timeFalse = (isset($options['time']) and !$options['time']); 
        
        $HM = $timeFalse?'':'%H:%M,';
        
        
		$date = $dateString ? $this->Time->fromString($dateString, $userOffset) : time();

		$y = $this->Time->isThisYear($date) ? '' : ' %Y r.';

		if ($this->Time->isToday($date)) {
			$ret = __('dzisiaj, %s', strftime("%H:%M", $date));
		} elseif ($this->Time->wasYesterday($date)) {
			$ret = __('wczoraj, %s', strftime("%H:%M", $date));
		} else {
			$format = $this->Time->convertSpecifiers("{$HM} %d %b {$y}", $date);
			$ret = strftime($format, $date);
		}

		return $ret;
	}
    
}
?>