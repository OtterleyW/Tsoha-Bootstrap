<?php

class TagController extends BaseController {


    public static function getTags($item_id) {
        $tags = Tag::getTagsForItem($item_id);
        
        return $tags;
    }

    public static function store($tags, $item_id) {
        self::check_logged_in();
        $tags = explode(",", $tags);
        
        foreach($tags as $tag_name){
            $tag = Tag::find($tag_name);
            
            if ($tag==null){
                $tag = Tag::save($tag_name);
            }
            
            $tag->saveTagToItem($item_id);
        }

    }
    
}
