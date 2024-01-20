<?php

declare(strict_types=1);

namespace Ericc70\Openarticles\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ericc70\Openarticles\Repository\ArticleRepository")
 */
class OpenArticlesLang {


       /**
     * @ORM\Id() 
     * @ORM\ManyToOne(targetEntity="Ericc70\Openarticles\Entity\OpenArticles" , inversedBy="articleLangs")
     * @ORM\JoinColumn(name="open_article_id", referencedColumnName="id", nullable=false)
     * 
     */
    private $article;
     /**
     * @ORM\Id() 
     * @ORM\ManyToOne(targetEntity="PrestaShopBundle\Entity\Lang"  )
     * @ORM\JoinColumn(name="lang_id", referencedColumnName="id_lang", nullable=false, onDelete="CASCADE" )
     * 
     */
    private $lang;

    /**
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;
    
    /**
     * @ORM\Column(name="resume", type="string" )
     */
    private $resume;
    
    /**
     * @ORM\Column(name="description", type="string")
     */
    private $description;


    /**
     * Get the value of article
     */ 
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set the value of article
     *
     * @return  self
     */ 
    public function setArticle($article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get the value of lang
     */ 
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set the value of lang
     *
     * @return  self
     */ 
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of resume
     */ 
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set the value of resume
     *
     * @return  self
     */ 
    public function setResume(string $resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }
}