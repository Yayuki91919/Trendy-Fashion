<?php

include_once __DIR__. '../../model/collaboration.php';

class CollaborationController extends Collaboration{
        public function getCollaboration(){
            return $this->getCollaborationInfo();
        }
        public function editCollaboration($id,$info)
        {
            return $this->updateCollaboration($id,$info);
        }


}
?>