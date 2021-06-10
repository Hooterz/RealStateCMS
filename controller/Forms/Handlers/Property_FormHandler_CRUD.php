<?php
    namespace Handler;

    use \controller\Forms\BaseFormHandler;
    use controller\Forms\ICRUD_FormHandler;
    use \config\Autoloader;

require('./config/autoload.php;')
    (new Autoloader())->Load();

    class Property_FormHandler_CRUD extends BaseFormHandler implements ICRUD_FormHandler{
        
        public function Handle_GET($GET){
        }

        function Handle_POST($POST){
        }

        function Handle_CREATE(array $data){    
        }

        function Handle_READ(array $data){
        }

        function Handle_UPDATE(array $data){
        }

        function Handle_DELETE(array $data){
        }
    }
?>