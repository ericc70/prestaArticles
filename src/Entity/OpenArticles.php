<?php

declare(strict_types=1);

namespace Ericc70\Openarticles\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ericc70\Openarticles\Repository\ArticleRepository")
 */
class OpenArticles{

    /**
     * @ORM\Id() 
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     */
    private $id ;

    /**
     * @ORM\Column(name="position", type="integer")
     */
    private $position ;
    /**
     * @ORM\Column(name="product_id", type="integer")
     */
    private $productId ;

    /**
     * @ORM\Column(name="active", type="integer")
     */
    private $active ;

     /**
    * @ORM\OneToMany(targetEntity="OpenArticlesLang", cascade={"persist", "remove"}, mappedBy="article")
     */
    private $articleLangs ;


    public function __construct(){
        $this->articleLangs = new ArrayCollection();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * 
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of position
     */ 
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set the value of position
     *
     * @return  self
     */ 
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get the value of productId
     */ 
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set the value of productId
     *
     * @return  self
     */ 
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get the value of active
     */ 
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of active
     *
     * @return  self
     */ 
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get the value of articleLangs
     */ 
    public function getArticleLangs() :ArrayCollection
    {
        return $this->articleLangs;
    }

    /**
     * Set the value of articleLangs
     *
     * @return  self
     */ 
    public function addArticleLangs( OpenArticlesLang $articleLang) :OpenArticles
    {
        $this->articleLangs []= $articleLang;
        $articleLang->setArticle($this);

        return $this;
    }
}