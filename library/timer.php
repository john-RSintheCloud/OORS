<?php
/**
 * timer class
 * for timing things - trivially 
 *
 * @author John Brookes <john@RSintheCloud.com>
 * @package RSintheClouds
 * @subpackage Library
*/

/**
 * Trivial timer class - set it and show it!
 * 
 * Allows 2 usages; as a multiple timer, eg through the dic
 * $container['timer']->start('bob');
 * ...
 * echo $container['timer']->show('bob');
 *
 * or as a one-shot timer
 * $timer = new timer();
 * ...
 * echo $timer->show()
 * 
 * the start method returns an id if none is supplied
 * $timerId = $container['timer']->start();
 * echo $container['timer']->show($timerId);
 * 
 * NB  if not supplied, the id returned is an integer 
 * so do not supply integer ids and blank ids to the same timer.
 * 
 * @author John
 */
class timer {


    /**
     *
     * @var array of start times
     */
    protected $start;
    
    /**
     * 
     * @param string $id
     * @return \timer
     */
    public function __construct($id = '')
    {
        $this->start($id);
        return $this;
    }

    /**
     * 
     * @param string $id
     * @return type
     */
    public function start($id='') {
        if (! $id ){
            $id = count($this->start) + 1;
        }
        $this->start[$id] = microtime(true);
        return $id ;
    }
    
    /**
     * 
     * @param string || integer $id
     * @return float
     */
    public function show($id = '') {
        if (! $id ){
            if (count($this->start) == 1){
                $start = reset($this->start);
            } else {
                return 0;
            }
        } else {
            $start = $this->start[$id];
        }
        $time = microtime(true);
        $total_time = round(($time - $start), 4);
        return $total_time ;
    }
}
