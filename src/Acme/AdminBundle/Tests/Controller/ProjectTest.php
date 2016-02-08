<?php
/**
 * Created by PhpStorm.
 * User: noureddine
 * Date: 29/01/16
 * Time: 20:40
 */

namespace Acme\AdminBundle\Tests\Controller;


use Acme\AdminBundle\Model\ProjectModel;

require '/var/www/html/vendor/autoload.php';

class ProjectTest extends PHPUnit_Framework_TestCase
{
    public  function testSomme(){

        $model= new ProjectModel();
        $somme = $model->somme(1,3);

        $this->assertEquals(42, $somme);
    }


}
