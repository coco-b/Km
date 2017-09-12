<?php

namespace ChatBundle\Entity;

/**
 * Message
 */
class Message
{


    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $content;

    /**
     * @var \DateTime
     */
    private $dateTime;

    /**
     * @var \ChatBundle\Entity\User
     */
    private $user;

    /**
     * @var \ChatBundle\Entity\Contact
     */
    private $contact;


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
     * Set content
     *
     * @param string $content
     *
     * @return Message
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set dateTime
     *
     * @param \DateTime $dateTime
     *
     * @return Message
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * Get dateTime
     *
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Set user
     *
     * @param \ChatBundle\Entity\User $user
     *
     * @return Message
     */
    public function setUser(\ChatBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \ChatBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set contact
     *
     * @param \ChatBundle\Entity\Contact $contact
     *
     * @return Message
     */
    public function setContact(\ChatBundle\Entity\Contact $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \ChatBundle\Entity\Contact
     */
    public function getContact()
    {
        return $this->contact;
    }
    /**
     * @var \ChatBundle\Entity\Channel
     */
    private $channel;


    /**
     * Set channel
     *
     * @param \ChatBundle\Entity\Channel $channel
     *
     * @return Message
     */
    public function setChannel(\ChatBundle\Entity\Channel $channel = null)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get channel
     *
     * @return \ChatBundle\Entity\Channel
     */
    public function getChannel()
    {
        return $this->channel;
    }
}
