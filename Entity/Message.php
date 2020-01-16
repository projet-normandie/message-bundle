<?php

namespace ProjetNormandie\MessageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="ProjetNormandie\MessageBundle\Repository\MessageRepository")
 * @ApiResource(attributes={"order"={"id": "DESC"}})
 */
class Message
{
    use Timestampable;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\Length(max="255")
     * @ORM\Column(name="object", type="string", nullable=false)
     */
    private $object;

    /**
     * @var string
     * @ORM\Column(name="message", type="text", nullable=true)
     */
    private $message;

    /**
     * @var string
     *
     * @Assert\Length(max="50")
     * @ORM\Column(name="type", type="string", nullable=false)
     */
    private $type = 'DEFAULT';

    /**
     * @var UserInterface
     *
     * @ORM\ManyToOne(targetEntity="ProjetNormandie\MessageBundle\Entity\UserInterface", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idSender", referencedColumnName="id", nullable=true)
     * })
     */
    private $sender;

    /**
     * @var UserInterface
     *
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="ProjetNormandie\MessageBundle\Entity\UserInterface", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idRecipient", referencedColumnName="id")
     * })
     */
    private $recipient;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isOpened", type="boolean", nullable=false, options={"default":0})
     */
    private $isOpened = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isDeletedSender", type="boolean", nullable=false, options={"default":0})
     */
    private $isDeletedSender = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isDeletedRecipient", type="boolean", nullable=false, options={"default":0})
     */
    private $isDeletedRecipient= false;


    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('Message [%s]', $this->id);
    }


    /**
     * Set id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set object
     *
     * @param string $object
     * @return $this
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return string
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Get sender
     * @return UserInterface
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set sender
     *
     * @param UserInterface $sender
     * @return $this
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * Get recipient
     * @return UserInterface
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * Set recipient
     *
     * @param UserInterface $recipient
     * @return $this
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * Set isOpened
     *
     * @param boolean $isOpened
     * @return $this
     */
    public function setIsOpened($isOpened)
    {
        $this->isOpened = $isOpened;

        return $this;
    }

    /**
     * Get isOpened
     *
     * @return boolean
     */
    public function getIsOpened()
    {
        return $this->isOpened;
    }

    /**
     * Set isDeletedSender
     *
     * @param boolean $isDeletedSender
     * @return $this
     */
    public function setIsDeletedSender($isDeletedSender)
    {
        $this->isDeletedSender = $isDeletedSender;

        return $this;
    }

    /**
     * Get isDeletedSender
     *
     * @return boolean
     */
    public function getIsDeletedSender()
    {
        return $this->isDeletedSender;
    }

    /**
     * Set isDeletedRecipient
     *
     * @param boolean $isDeletedRecipient
     * @return $this
     */
    public function setIsDeletedRecipient($isDeletedRecipient)
    {
        $this->isDeletedRecipient = $isDeletedRecipient;

        return $this;
    }

    /**
     * Get isDeletedRecipient
     *
     * @return boolean
     */
    public function getIsDeletedRecipient()
    {
        return $this->isDeletedRecipient;
    }
}
