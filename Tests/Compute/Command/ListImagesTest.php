<?php

namespace Guzzle\Openstack\Tests\Compute\Command;

use Guzzle\Openstack\Tests\Compute\Common\ComputeTestCase;
use Guzzle\Openstack\Compute\ComputeConstants;

/**
 * ListImages Tests
 */
class ListImagesTest extends ComputeTestCase
{
    
    public function testListImages()
    {
        $this->setMockResponse($this->client, 'compute/ListServersDetail');
        $command = $this->client->getCommand(ComputeConstants::LIST_IMAGES);
        $command->setServer('serverRef');
        $command->setName('imageName');
        $command->setStatus('imageStatus');
        $command->setChangesSince('dateTime');
        $command->setType('type');
        $command->setMarker('markerID');
        $command->setLimit('int');        
        
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:8774/v1.1/tenantid/images?server=serverRef&name=imageName&status=imageStatus&changes-since=dateTime&type=type&marker=markerID&limit=int', $command->getRequest()->getUrl());
        $this->assertEquals('GET', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
                
        //Check parameters

        $this->client->execute($command);
      
        $result = $command->getResult();
        $this->assertTrue(is_array($result));
        
        //$this->assertTrue(array_key_exists('servers', $result));
        
    }
}

?>
