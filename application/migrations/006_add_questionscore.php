<?php
class Migration_Add_Questionscore extends CI_Migration {

    public function up()
    {
        $fields = array(
            'per_question_score VARCHAR(5) DEFAULT NULL'
        );

        $this->dbforge->add_column('savsoft_qbank', $fields);

        $fields2 = array(
            'per_question_score int(5) DEFAULT 0'
        );

        $this->dbforge->add_column('savsoft_quiz', $fields2);
    }

    public function down()
    {
        $this->dbforge->drop_column('savsoft_qbank', 'per_question_score');
        $this->dbforge->drop_column('savsoft_quiz', 'per_question_score');
    }

}
?>