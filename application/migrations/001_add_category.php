<?php
class Migration_Add_Category extends CI_Migration {

    public function up()
    {
        $fields = array(
            'cid VARCHAR(50) DEFAULT NULL'
        );

        $this->dbforge->add_column('savsoft_quiz', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('savsoft_quiz', 'cid');
    }

}
?>