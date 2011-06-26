<?php

/*
 * This file is part of the Google APIs PHP Clients package.
 *
 * (c) Stephen Melrose <me@stephenmelrose.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Google\Api\Data\CustomSearch;

use Google\Api\Data\AbstractData;

use Google\Api\Data\CustomSearch\Promotion\Image as Image;

/**
 * Promotion is a single promotion (subscribed link) from the Google Custom Search API.
 *
 * @author Stephen Melrose <me@stephenmelrose.co.uk>
 */
class Promotion extends AbstractData
{
    /**
     * @var string
     */
    protected $title;
    
    /**
     * @var string
     */
    protected $link;
    
    /**
     * @var string
     */
    protected $displayLink;
    
    /**
     * @var array
     */
    protected $bodyLines = array();
    
    /**
     * @var Image
     */
    protected $image;
    
    /**
     * Gets the title of the subscribed link.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Gets the link of the subscribed link.
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }
    
    /**
     * Gets the abridged version of the subscribed link.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->displayLink;
    }
    
    /**
     * Determines if the subscribed link has block objects.
     * 
     * @return boolean 
     */
    public function hasBodyLines()
    {
        return count($this->getBodyLines()) > 0;
    }
    
    /**
     * Gets the block objects for the subscribed link.
     *
     * @return array
     * 
     * @link http://www.google.com/cse/docs/resultsxml.html
     */
    public function getBodyLines()
    {
        return $this->bodyLines;
    }
    
    /**
     * Gets the image associated with the subscribed link.
     *
     * @return Image
     */
    public function getImage()
    {
        return $this->image;
    }
}