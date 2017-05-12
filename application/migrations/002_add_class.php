<?php
class Migration_Add_Class extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'class_id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'lid' => array(
                'type' => 'INT',
                'constraint' => 10,
            ),
            'gid' => array(
                'type' => 'INT',
                'constraint' => 10,
            ),
            'cid' => array(
                'type' => 'INT',
                'constraint' => 10,
            ),

            'class_code' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'teacher_id' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('class_id', TRUE);
        $this->dbforge->create_table('class');
    }

    public function down()
    {
        $this->dbforge->drop_table('class');
    }

}
?>