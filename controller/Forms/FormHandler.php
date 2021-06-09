<?php
    namespace controller\Forms;

    interface IFormHandler
    {
        public function Handle_POST();
        public function Handle_GET();
    }

    interface ICRUD_FormHandler extends IFormHandler{
        public function Handle_CREATE();
        public function Handle_READ();
        public function Handle_UPDATE();
        public function Handle_DELETE();
    }

?>