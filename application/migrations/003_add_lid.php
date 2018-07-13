<?php
class Migration_Add_Lid extends CI_Migration {

    public function up()
    {
        $fields = array(
            'lid VARCHAR(50) DEFAULT NULL'
        );

        $this->dbforge->add_column('savsoft_group', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('savsoft_group', 'lid');
    }

}
?>