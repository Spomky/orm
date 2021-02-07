<?php

declare(strict_types=1);

namespace Doctrine\Tests\Models\CMS;

/**
 * @Entity
 * @Table(name="cms_articles")
 */
class CmsArticle
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    public $id;
    /** @Column(type="string", length=255) */
    public $topic;

    /**
     * @var string
     * @Column(type="text")
     */
    public $text;
    /**
     * @ManyToOne(targetEntity="CmsUser", inversedBy="articles")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    public $user;
    /** @OneToMany(targetEntity="CmsComment", mappedBy="article") */
    public $comments;

    /** @Version @column(type="integer") */
    public $version;

    public function setAuthor(CmsUser $author): void
    {
        $this->user = $author;
    }

    public function addComment(CmsComment $comment): void
    {
        $this->comments[] = $comment;
        $comment->setArticle($this);
    }
}
