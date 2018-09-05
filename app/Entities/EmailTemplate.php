<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmailTemplate
 *
 * @ORM\Table(name="email_template")
 * @ORM\Entity(repositoryClass="App\Repositories\EmailTemplateRepository")
 */
class EmailTemplate
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @var EmailAction
     *
     * @ORM\OneToOne(targetEntity="EmailAction")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="action_id", referencedColumnName="id")
     * })
     */
    private $action;

    /**
     * @var string
     *
     * @ORM\Column(name="header_image", type="text", length=65535, nullable=true)
     */
    private $headerImage;

    /**
     * @var string
     *
     * @ORM\Column(name="header_title", type="text", length=65535, nullable=true)
     */
    private $headerTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=true)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="footer", type="text", length=65535, nullable=true)
     */
    private $footer;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return EmailAction
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param int $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getHeaderImage()
    {
        return $this->headerImage;
    }

    /**
     * @param string $headerImage
     */
    public function setHeaderImage($headerImage)
    {
        $this->headerImage = $headerImage;
    }

    /**
     * @return string
     */
    public function getHeaderTitle()
    {
        return $this->headerTitle;
    }

    /**
     * @param string $headerTitle
     */
    public function setHeaderTitle($headerTitle)
    {
        $this->headerTitle = $headerTitle;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getFooter()
    {
        return $this->footer;
    }

    /**
     * @param string $footer
     */
    public function setFooter($footer)
    {
        $this->footer = $footer;
    }
}
