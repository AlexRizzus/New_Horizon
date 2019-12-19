<?php
    class DBAccess{
        const HOST_DB = 'localhost';
        const USERNAME = 'meowhorizon'
        const PASSWORD = ''
        const DATABASE_NAME = 'my_meowhorizon'
    
        public $connection = null;
    
        public function openDBconnection() {
            $this->connection = mysqli_connect(static::HOST_DB, static::USERNAME, static::PASSWORD, static::DATABASE_NAME);
            if(!$this->connection){
                return false;
            }
            else{
                return true;
            }
        }
?>