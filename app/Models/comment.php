<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $table = 'comments';

    public function getAllComments(){
        $arrayComments = array();
        $firstLevelComments = $this->where('idParent',0)->orderBy('date', 'DESC')->get();
        foreach ($firstLevelComments as $firstLevelComment){
            $arrayComments[] = array('level'=>'firstLevel', 'comment'=>$firstLevelComment);
            $secondLevelComments = $this->where('idParent',$firstLevelComment->id)->orderBy('date', 'DESC')->get();
            foreach ($secondLevelComments as $secondLevelComment){
                $arrayComments[] = array('level'=>'secondLevel', 'comment'=>$secondLevelComment);
                $thirdLevelComments = $this->where('idParent',$secondLevelComment->id)->orderBy('date', 'DESC')->get();
                foreach ($thirdLevelComments as $thirdLevelComment){
                    $arrayComments[] = array('level'=>'thirdLevel', 'comment'=>$thirdLevelComment);
                }
            }
        }

        return $arrayComments;
    }

    public function insertComment($dataComment, $idCommentParent){
        $this->insert(
            //date field is current timestamp
            ['name' => $dataComment->name, 'comment' => $dataComment->comment, 'idParent'=>$idCommentParent]
        );
    }

}



