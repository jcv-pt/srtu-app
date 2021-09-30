<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class ScopePuppetComponent extends Component
{
    
    public function run($id, $function, $arguments)
    {
            
        if(!is_array($arguments))
            $arguments = [$arguments];

        return 'scopePuppet.run(\''.$id.'\',\''.$function.'\',\''. urlencode(json_encode($arguments)).'\')';
        
    }
    
    public function execute($command)
    {
        
        return 'scopePuppet.execute(\''.urlencode($command).'\')';

    }
    
}
