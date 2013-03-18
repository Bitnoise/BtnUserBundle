<?php
namespace Btn\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\MappedSuperclass
 */
class User extends BaseUser
{
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

    /**
     * Set agent
     *
     * @param string $agent
     * @return User
     */
    public function setAgent($agent)
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * Get agent
     *
     * @return string
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * Set browser
     *
     * @param string $browser
     * @return User
     */
    public function setBrowser($browser)
    {
        $this->browser = $browser;

        return $this;
    }

    /**
     * Get browser
     *
     * @return string
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return User
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }
}