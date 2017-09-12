<?php


namespace ChatBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;



class User extends BaseUser
{
    /**
     * @var integer
     */

    protected $id;



    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $messages;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $contacts;


    /**
     * Add message
     *
     * @param \ChatBundle\Entity\Message $message
     *
     * @return User
     */
    public function addMessage(\ChatBundle\Entity\Message $message)
    {
        $this->messages[] = $message;

        return $this;
    }

    /**
     * Remove message
     *
     * @param \ChatBundle\Entity\Message $message
     */
    public function removeMessage(\ChatBundle\Entity\Message $message)
    {
        $this->messages->removeElement($message);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Add contact
     *
     * @param \ChatBundle\Entity\Contact $contact
     *
     * @return User
     */
    public function addContact(\ChatBundle\Entity\Contact $contact)
    {
        $this->contacts[] = $contact;

        return $this;
    }

    /**
     * Remove contact
     *
     * @param \ChatBundle\Entity\Contact $contact
     */
    public function removeContact(\ChatBundle\Entity\Contact $contact)
    {
        $this->contacts->removeElement($contact);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContacts()
    {
        return $this->contacts;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $channels;


    /**
     * Add channel
     *
     * @param \ChatBundle\Entity\Channel $channel
     *
     * @return User
     */
    public function addChannel(\ChatBundle\Entity\Channel $channel)
    {
        $this->channels[] = $channel;

        return $this;
    }

    /**
     * Remove channel
     *
     * @param \ChatBundle\Entity\Channel $channel
     */
    public function removeChannel(\ChatBundle\Entity\Channel $channel)
    {
        $this->channels->removeElement($channel);
    }

    /**
     * Get channels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChannels()
    {
        return $this->channels;
    }
}
