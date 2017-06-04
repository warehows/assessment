<?php
class Migration_Add_Uid extends CI_Migration {

    public function up()
    {
        $fields = array(
            'uid VARCHAR(50) DEFAULT NULL'
        );

        $this->dbforge->add_column('savsoft_quiz', $fields);

        $fields2 = array(
            'uid VARCHAR(50) DEFAULT NULL'
        );

        $this->dbforge->add_column('savsoft_qbank', $fields2);
    }

    public function down()
    {
        $this->dbforge->drop_column('savsoft_quiz', 'uid');
        $this->dbforge->drop_column('savsoft_qbank', 'uid');
    }

}
?>