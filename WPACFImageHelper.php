<?php

/**
 * Created by PhpStorm.
 * User: bschultz
 * Date: 8/21/14
 * Time: 4:38 PM
 *
 *
 */

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

    public function __construct($fieldName = false, $type = false, $size = "full", $id = false){

        $this->type = $type;
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
        }else{
            $imgID = get_field($fieldName, 'options');
        }
        return $imgID;
    }
    public function getAlt(){
        $alt = get_post_meta($this->imgID, '_wp_attachment_image_alt', true);
        return $alt;
    }
    public function buildImgTag($classes){
        $tag = '<img src="'.$this->src.'" class="'.$classes.'" alt="'.$this->alt.'">';
        return $tag;
    }

}