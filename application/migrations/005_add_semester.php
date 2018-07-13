<?php
class Migration_Add_Semester extends CI_Migration {

    public function up()
    {
        $fields = array(
            'semester VARCHAR(5) DEFAULT NULL'
        );

        $this->dbforge->add_column('savsoft_quiz', $fields);

        $fields2 = array(
            'semester VARCHAR(5) DEFAULT NULL'
        );

        $this->dbforge->add_column('lessons', $fields2);
    }

    public function down()
    {
        $this->dbforge->drop_column('savsoft_quiz', 'semester');
        $this->dbforge->drop_column('lessons', 'semester');
    }

}
?>