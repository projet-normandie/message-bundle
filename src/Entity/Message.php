<?php
namespace ProjetNormandie\MessageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;

/**
 * Message
 *
 * @ORM\Table(
 *     name="message",
 *     indexes={
 *         @ORM\Index(name="idx_inbox", columns={"idRecipient","isDeletedRecipient"}),
 *         @ORM\Index(name="idx_outbox", columns={"idSender","isDeletedSender"}),
 *         @ORM\Index(name="idx_newMessage", columns={"idRecipient","isOpened"}),
 *         @ORM\Index(name="idx_type", columns={"idRecipient","type"}),
 *         @ORM\Index(name="idx_object", columns={"idRecipient","object"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="ProjetNormandie\MessageBundle\Repository\MessageRepository")
 * @ApiResource(attributes={"order"={"id": "DESC"}})
 * @ApiFilter(
 *     SearchFilter::class,
 *     properties={
 *          "sender": "exact",
 *          "recipient": "exact",
 *          "type": "exact",
 *          "object": "partial",
 *     }
 * )
  * @ApiFilter(
 *     BooleanFilter::class,
 *     properties={
 *          "isDeletedSender",
 *          "isDeletedRecipient",
 *          "isOpened",
 *     }
 * )
 */
class Message implements TimestampableInterface
{
    use TimestampableTrait;

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private ?int $id = null;

    /**
     * @Assert\Length(max="255")
     * @ORM\Column(name="object", type="string", nullable=false)
     */
    private ?string $object;

    /**
     * @ORM\Column(name="message", type="text", nullable=true)
     */
    private ?string $message;

    /**
     * @Assert\Length(max="50")
     * @ORM\Column(name="type", type="string", nullable=false)
     */
    private ?string $type = 'DEFAULT';

    /**
     * @ORM\ManyToOne(targetEntity="ProjetNormandie\MessageBundle\Entity\UserInterface", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idSender", referencedColumnName="id", nullable=true)
     * })
     */
    private $sender;

    /**
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="ProjetNormandie\MessageBundle\Entity\UserInterface", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idRecipient", referencedColumnName="id")
     * })
     */
    private $recipient;

    /**
     * @ORM\Column(name="isOpened", type="boolean", nullable=false, options={"default":false})
     */
    private bool $isOpened = false;

    /**
     * @ORM\Column(name="isDeletedSender", type="boolean", nullable=false, options={"default":false})
     */
    private bool $isDeletedSender = false;

    /**
     * @ORM\Column(name="isDeletedRecipient", type="boolean", nullable=false, options={"default":0})
     */
    private bool $isDeletedRecipient = false;


    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('Message [%s]', $this->id);
    }


    /**
     * Set id
     * @param integer $id
     * @return $this
     */
    public function setId(int $id): Self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get id
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set object
     * @param string $object
     * @return $this
     */
    public function setObject(string $object): Self
    {
        $this->object = $object;
        return $this;
    }

    /**
     * Get object
     * @return string
     */
    public function getObject(): ?string
    {
        return $this->object;
    }

    /**
     * Set type
     * @param string $type
     * @return $this
     */
    public function setType(string $type): Self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * Set message
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message): Self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Get message
     * @return string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * Get sender
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set sender
     * @param $sender
     * @return $this
     */
    public function setSender($sender): Self
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * Get recipient
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * Set recipient
     *
     * @param $recipient
     * @return $this
     */
    public function setRecipient($recipient): Self
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * Set isOpened
     * @param boolean $isOpened
     * @return $this
     */
    public function setIsOpened(bool $isOpened): Self
    {
        $this->isOpened = $isOpened;
        return $this;
    }

    /**
     * Get isOpened
     * @return boolean
     */
    public function getIsOpened(): bool
    {
        return $this->isOpened;
    }

    /**
     * Set isDeletedSender
     * @param boolean $isDeletedSender
     * @return $this
     */
    public function setIsDeletedSender(bool $isDeletedSender): Self
    {
        $this->isDeletedSender = $isDeletedSender;
        return $this;
    }

    /**
     * Get isDeletedSender
     * @return boolean
     */
    public function getIsDeletedSender(): bool
    {
        return $this->isDeletedSender;
    }

    /**
     * Set isDeletedRecipient
     * @param boolean $isDeletedRecipient
     * @return $this
     */
    public function setIsDeletedRecipient(bool $isDeletedRecipient): Self
    {
        $this->isDeletedRecipient = $isDeletedRecipient;
        return $this;
    }

    /**
     * Get isDeletedRecipient
     * @return boolean
     */
    public function getIsDeletedRecipient(): bool
    {
        return $this->isDeletedRecipient;
    }
}
