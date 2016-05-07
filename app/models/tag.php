<?php

class Tag extends BaseModel {

    public $id, $tag;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function getTagsForItem($item_id) {
        $query = DB::connection()->prepare('SELECT Tunniste.tag FROM Tunniste_kohde INNER JOIN Kohde ON Kohde.id = Tunniste_Kohde.item_id INNER JOIN Tunniste ON Tunniste.id = Tunniste_kohde.tag_id WHERE Kohde.id = :id');
        $query->execute(array('id' => $item_id));
        $rows = $query->fetchAll();
        $tags = $rows;

        return $tags;
    }

    public function save($tag) {
        $query = DB::connection()->prepare('INSERT INTO Tunniste (tag) VALUES (:tag)');
        $query->execute(array('tag' => $tag));
    }
    
    public function find($newTag) {
        $query = DB::connection()->prepare('SELECT * FROM Tunniste');
        $query->execute();
        $rows = $query->fetchAll();
        
       
        foreach ($rows as $row){
            if($row['tag'] == $newTag){
                $tag = new Tag(array(
                'id' => $row['id'],
                'tag' => $row['tag']
                ));
                
              return $tag;
            }
        }
        
        return null; 
    }
    
        public function saveTagToItem($item_id) {
        $query = DB::connection()->prepare('INSERT INTO Tunniste_kohde (item_id, tag_id) VALUES (:item_id, :tag_id)');
        $query->execute(array('item_id' => $item_id, 'tag_id' => $this->id));
    }

}
