<?php

/**
 * OPTIONS AND POST ASSUME USE OF ADVANCED CUSTOM FIELDS
 **/

class WPACFImageHelperFactory{
    public static function createFromOptions($fieldName, $size){
        return new WPACFImageHelper($fieldName, 'options', $size);
    }
    public static function createFromPost($fieldName, $size){
        return new WPACFImageHelper($fieldName, 'post', $size);
    }
    public static function createFromID($id, $size){
        return new WPACFImageHelper(false, false, $size, $id);
    }
    public static function createFromPostID($postID, $size, $fieldName){
        return new DegImageHelper($fieldName, 'fromID', $size, false, $postID);
    }
}
class WPACFImageHelper
{
    public $src;
    public $alt;
    public $imgTag;
    public $type;
    public $size;
    public $fieldName;
    public $postID;
    public $imgID;

    public function __construct($fieldName = false, $type = false, $size = "full", $id = false, $postID = false){

        $this->type = $type;
        $this->postID = $postID;
        $this->size = $size;
        $this->fieldName = $fieldName;
        $id ? $this->imgID = $id : $this->imgID = $this->getID($this->fieldName, $this->type);
        $this->src = $this->getSrc($this->size);
        $this->alt = $this->getAlt();

    }

    public function getSrc(){
        $src = wp_get_attachment_image_src($this->imgID, $this->size);
        $src = $src[0];
        return $src;
    }

    public function getID($fieldName, $type){
        if($type === 'post'){
            $imgID = get_field($fieldName);
        }elseif($type === 'options'){
            $imgID = get_field($fieldName, 'options');
        }elseif($type === 'fromID'){
            $imgID = get_field($fieldName, $this->postID);
        }
        else{

        }
        return $imgID;
    }

    public function getAlt(){
        $alt = get_post_meta($this->imgID, '_wp_attachment_image_alt', true);
        return $alt;
    }

    public function buildImgTag($classes){
        $tag = '<img src="'.$this->src.'" class="'.$classes.'">';
        return $tag;
    }

}