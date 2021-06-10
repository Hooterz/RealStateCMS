<?php
    declare(strict_types=1);
    namespace controller\Forms;

    interface IFormHandler
    {
        public function Handle_POST(array $POST);
        public function Handle_GET(array $GET);
    }

    interface ICRUD_FormHandler extends IFormHandler{
        public function Handle_CREATE(array $data);
        public function Handle_READ(array $data);
        public function Handle_UPDATE(array $data);
        public function Handle_DELETE(array $data);
    }

?>