<?php
/**
 * Created by PhpStorm.
 * User: Steve
 * Date: 27-2-2019
 * Time: 15:22
 */
App::uses('Component', 'Controller');

class MathComponent extends Component
{
    public function convertTimeNotationToValues($hours, $direction) {
        if ($direction){
            $hoursArr = explode(':', $hours);
            if (!isset($hoursArr[1])) {
                return (int) $hours;
            }
            return (int) $hoursArr[0] + ((1 / 0.6) * ($hoursArr[1] / 100));
        } else {
            $whole = floor($hours);
            $float = $hours - $whole;
            if ($float > 0) {
                $float = $float * 60;
                if ($float < 10) {
                    $float = '0' . $float;
                }
                return (string) $whole . ':' . $float;
            }
            return (int) $hours;
        }

    }
}

