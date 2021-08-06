<?php 

if (isset($_GET['ids'])) {
    $findById = QuestionTable::find_by_id($_GET['ids']);
    pre_d($findById);
    $f = "";
    foreach (json_decode($findById->answer_lable) as $d) {
        $f .= "<div>
        <label>".$d."</label></br>
    </div>";
    }
    echo $f;
    exit();

}

?>