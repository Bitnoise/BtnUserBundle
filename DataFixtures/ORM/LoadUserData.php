<?php
namespace Btn\UserBundle\DataFixtures\ORM;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Btn\UserBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
  private $container;

  public function setContainer(ContainerInterface $container = null)
  {
      $this->container = $container;
  }

  public function load(ObjectManager $manager)
  {
    //create users using fos_user manager
    $manipulator = $this->container->get('fos_user.util.user_manipulator');

    $user  = $manipulator->create('user',  'user',  'user@app.dev',  true, false);
    $admin = $manipulator->create('admin', 'admin', 'admin@app.dev', true, true);

    $this->addReference('user',  $user);
    $this->addReference('admin', $admin);
  }

  public function getOrder()
  {
    return 1; // the order in which fixtures will be loaded
  }
}