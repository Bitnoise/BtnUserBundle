<?php
namespace Btn\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var text
     *
     * Short info from $_SERVER['HTTP_USER_AGENT']
     *
     * @ORM\Column(name="http_user_agent", type="text", nullable=true)
     */
    private $agent = null;

    /**
     * @var text
     *
     * used get_browser
     *
     * Attempts to determine the capabilities of the user's browser,
     * by looking up the browser's information in the browscap.ini file.
     *
     * @ORM\Column(name="browser", type="text", nullable=true)
     */
    private $browser = null;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ip", type="string", nullable=true)
     */
    private $ip = null;
}