<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MatchSoccer
 *
 * @ORM\Table(name="match_soccer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MatchSoccerRepository")
 */
class MatchSoccer
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\Column(name="datetime", type="datetime", nullable=true)
     * */
    private $datetime;

    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="home_id", referencedColumnName="id")
     */
    private $home;

    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="visitor_id", referencedColumnName="id")
     */

    private $visitor;
    /**
     *
     * @ORM\Column(name="homegoals", type="integer", nullable=true)
     */

    private $homegoals;
    /**
     *
     * @ORM\Column(name="visitorgoals", type="integer", nullable=true)
     */
    private $visitorgoals;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return MatchSoccer
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set homegoals
     *
     * @param integer $homegoals
     *
     * @return MatchSoccer
     */
    public function setHomegoals($homegoals)
    {
        $this->homegoals = $homegoals;

        return $this;
    }

    /**
     * Get homegoals
     *
     * @return integer
     */
    public function getHomegoals()
    {
        return $this->homegoals;
    }

    /**
     * Set visitorgoals
     *
     * @param integer $visitorgoals
     *
     * @return MatchSoccer
     */
    public function setVisitorgoals($visitorgoals)
    {
        $this->visitorgoals = $visitorgoals;

        return $this;
    }

    /**
     * Get visitorgoals
     *
     * @return integer
     */
    public function getVisitorgoals()
    {
        return $this->visitorgoals;
    }

    /**
     * Set home
     *
     * @param \AppBundle\Entity\Team $home
     *
     * @return MatchSoccer
     */
    public function setHome(\AppBundle\Entity\Team $home = null)
    {
        $this->home = $home;

        return $this;
    }

    /**
     * Get home
     *
     * @return \AppBundle\Entity\Team
     */
    public function getHome()
    {
        return $this->home;
    }

    /**
     * Set visitor
     *
     * @param \AppBundle\Entity\Team $visitor
     *
     * @return MatchSoccer
     */
    public function setVisitor(\AppBundle\Entity\Team $visitor = null)
    {
        $this->visitor = $visitor;

        return $this;
    }

    /**
     * Get visitor
     *
     * @return \AppBundle\Entity\Team
     */
    public function getVisitor()
    {
        return $this->visitor;
    }
}
