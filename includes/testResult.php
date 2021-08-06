<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/22/2019
 * Time: 9:52 AM
 */

require_once("initialize.php");

class TestResult extends DatabaseObject
{

    protected static $table_name = "testResult";

    protected static $db_fields = array('id', 'result_id', 'sync' ,'auth_code', 'pcv', 'mch', 'mchc', 'mcv', 'retics', 'retics_index',
        'hb', 'wbc', 'platelet', 'hb_genotype', 'esr', 'finger_prick','clotted_blood', 'blood_cit', 'blood_seq', 'marrow',
        'spec_others', 'exam_req', 'haem_com', 'film_app', 'ani', 'poikil', 'poly','macro', 'micro', 'hypo', 'sickle_cells',
        'target_cells', 'spherocytes', 'nucleated', 'inclusion', 'film_others', 'blast', 'promyelocyre', 'myel', 'neutrophil',
        'eosinophil', 'basophil', 'lymphocyte', 'monocyte', 'diff_others', 'pt', 'inr', 'ptt', 'pt_control', 'ptt_control',


        'comment', 'sodium', 'potassium', 'bicarbonate', 'chloride', 'calcium', 'magnessium', 'phosphorus', 'urea',
        'creatinine', 'creatinine_clearance', 'uric_acid','fasting_glucose', 'hpp', 'random_glucose', 'ogtt', 'fasting',
        'thirty_min', 'ninety_min', 'one_hour', 'two_hours', 'three_hours', 'hbA', 'total_protein', 'albumin', 'total_bilirubin',
        'conj_bilirubin','ast', 'alt', 'alk_phosphate', 'urinary_protein', 'urinary_creatinine', 'urine_volume', 'albumin_ratio',
        'gamma_gt', 'acid_phosphate', 'total', 'prostatic', 'ck_mb', 'ldh', 'amylase', 'cholinesterase', 'total_cholesterol',
        'hdl_cholesterol', 'ldl_cholesterol', 'vldl_cholesterol', 'triglycerides', 'csf', 'csf_glucose', 'csf_protein', 'csf_chloride',
        'urine', 'electrolytes', 'protein',


        'macroscopy', 'blood', 'mucus', 'worms', 'pus_cells', 'red_blood_cells', 'starch_granules',
        'occult_blood_comment', 'ova', 'cysts', 'plasmodium', 'trypanosomes', 'skin_snip', 'blood_film', 'microfilaria',
        'tested_by', 'reviewed_by', 'para_density', 'species', 'stages', 'colour', 'ph', 'glucose', 'ketones', 'bilirubin', 'rbc',
        'crystals', 'haematobium', 'yeast', 'appearance', 'sg', 'protein_para', 'urobilinogen', 'wbc_para', 'epith_cells', 'casts', 'bacteria',
        't_vaginals','blood_urine', 'nitrite', 'leucocyte',


        'macroscopy_micro', 'colour_micro', 'albumin_micro', 'pus_cell', 'rbcs', 'epith_cell', 'yeast_cell', 'bacteria_micro',
        'xtals', 'hyaline', 'granular', 'cellular', 'parasites', 'wbc_micro', 'polymorphs', 'lymphoetes', 'culture_isolates_1', 'culture_isolates_2',
        'culture_isolates_3', 'culture_isolates_4', 'culture_isolates_5', 'amc', 'cro', 'caz', 'd', 'cpd', 'fep', 'mem', 'e', 'tzp', 'amp', 'le',
        'cn', 'cxm', 'cot', 'nitro', 'cip', 'ofl', 'az', 'cl', 'do','amc2', 'cro2', 'caz2', 'd2', 'cpd2', 'fep2', 'mem2', 'e2', 'tzp2',
        'amp2', 'le2', 'cn2', 'cxm2', 'cot2', 'nitro2', 'cip2', 'ofl2', 'az2', 'cl2', 'do2', 'amc3', 'cro3', 'caz3', 'd3', 'cpd3', 'fep3',
        'mem3', 'e3', 'tzp3', 'amp3', 'le3', 'cn3', 'cxm3', 'cot3', 'nitro3', 'cip3', 'ofl3', 'az3', 'cl3', 'do3',
        'amc4', 'cro4', 'caz4', 'd4', 'cpd4', 'fep4', 'mem4', 'e4', 'tzp4', 'amp4', 'le4', 'cn4', 'cxm4', 'cot4', 'nitro4', 'cip4', 'ofl4', 'az4',
        'cl4', 'do4', 'amc5', 'cro5', 'caz5', 'd5', 'cpd5', 'fep5', 'mem5', 'e5', 'tzp5', 'amp5', 'le5', 'cn5', 'cxm5', 'cot5', 'nitro5', 'cip5',
        'ofl5', 'az5', 'cl5', 'do5', 'address', 'samp_rec_by', 'other_spec', 'direct_gram', 'widal_kit_used', 'preg_kit_used','type_of_reagent',
        'vdrl_kit_used', 'mantoux_kit_used','days_of_ab', 'mode_of_prod', 'time_prod', 'time_rec', 'time_ex', 'volume', 'viscosity', 'liq', 'ph_micro',
        'pus_gel', 'rbc_micro', 'semen_colour', 'semen_epith_cell',  'motility', 'percent_motility', 'morphology', 'others_micro', 'sperm_conc', 'total_conc',
        'titre', 'sal_typh', 'sal_typh_a', 'sal_typh_b', 'sal_typh_c', 'widal_test', 'pregnancy_test', 'vdrl_test', 'mantoux_test', 'remark',
        'date_ex', 'date_admin','prog', 'non_prog', 'imm', 'igg' , 'igm' , 'salmo_d_o', 'salmo_d_h', 'salmo_a_o','salmo_a_h', 'salmo_b_o',
        'salmo_b_h', 'salmo_c_o', 'salmo_c_h', 'org_first_param', 'org_second_param', 'org_third_param', 'org_first','org_second', 'org_third',
        'org_first2','org_second2', 'org_third2' , 'org_first3','org_second3', 'org_third3' , 'org_first4','org_second4', 'org_third4' ,
        'org_first5','org_second5', 'org_third5',  'notes', 'date');



    public $id;
    public $result_id;
    public $sync;
    public $auth_code;
    public $pcv;
    public $mch;
    public $mchc;
    public $mcv;
    public $retics;
    public $retics_index;
    public $hb;
    public $wbc;
    public $platelet;
    public $hb_genotype;
    public $esr;
    public $finger_prick;
    public $clotted_blood;
    public $blood_cit;
    public $blood_seq;
    public $marrow;
    public $spec_others;
    public $exam_req;
    public $haem_com;
    public $film_app;
    public $ani;
    public $poikil;
    public $poly;
    public $macro;
    public $micro;
    public $hypo;
    public $sickle_cells;
    public $target_cells;
    public $spherocytes;
    public $nucleated;
    public $inclusion;
    public $film_others;
    public $blast;
    public $promyelocyre;
    public $myel;
    public $neutrophil;
    public $eosinophil;
    public $basophil;
    public $lymphocyte;
    public $monocyte;
    public $diff_others;
    public $pt;
    public $inr;
    public $ptt;
    public $pt_control;
    public $ptt_control;


    public $comment;
    public $sodium;
    public $potassium;
    public $bicarbonate;
    public $chloride;
    public $calcium;
    public $magnessium;
    public $phosphorus;
    public $urea;
    public $creatinine;
    public $creatinine_clearance;
    public $uric_acid;
    public $fasting_glucose;
    public $hpp;
    public $random_glucose;
    public $ogtt;
    public $fasting;
    public $thirty_min;
    public $ninety_min;
    public $one_hour;
    public $two_hours;
    public $three_hours;
    public $hbA;
    public $total_protein;
    public $albumin;
    public $total_bilirubin;
    public $conj_bilirubin;
    public $ast;
    public $alt;
    public $alk_phosphate;
    public $urinary_protein;
    public $urinary_creatinine;
    public $urine_volume;
    public $albumin_ratio;
    public $gamma_gt;
    public $acid_phosphate;
    public $total;
    public $prostatic;
    public $ck_mb;
    public $ldh;
    public $amylase;
    public $cholinesterase;
    public $total_cholesterol;
    public $hdl_cholesterol;
    public $ldl_cholesterol;
    public $vldl_cholesterol;
    public $triglycerides;
    public $csf;
    public $csf_glucose;
    public $csf_protein;
    public $csf_chloride;
    public $urine;
    public $electrolytes;
    public $protein;



    public $macroscopy;
    public $blood;
    public $mucus;
    public $worms;
    public $pus_cells;
    public $red_blood_cells;
    public $starch_granules;
    public $occult_blood_comment;
    public $ova;
    public $cysts;
    public $others;
    public $plasmodium;
    public $trypanosomes;
    public $skin_snip;
    public $blood_film;
    public $microfilaria;
    public $tested_by;
    public $reviewed_by;
    public $para_density;
    public $species;
    public $stages;
    public $colour;
    public $ph;
    public $glucose;
    public $ketones;
    public $bilirubin;
    public $rbc;
    public $crystals;
    public $haematobium;
    public $yeast;
    public $appearance;
    public $sg;
    public $protein_para;
    public $urobilinogen;
    public $wbc_para;
    public $epith_cells;
    public $casts;
    public $bacteria;
    public $t_vaginals;
    public $blood_urine;
    public $nitrite;
    public $leucocyte;




    public $macroscopy_micro;
    public $colour_micro;
    public $albumin_micro;
    public $pus_cell;
    public $rbcs;
    public $epith_cell;
    public $yeast_cell;
    public $bacteria_micro;
    public $xtals;
    public $hyaline;
    public $granular;
    public $cellular;
    public $parasites;
    public $wbc_micro;
    public $polymorphs;
    public $lymphoetes;
    public $culture_isolates_1;
    public $culture_isolates_2;
    public $culture_isolates_3;
    public $culture_isolates_4;
    public $culture_isolates_5;
    public $amc;
    public $cro;
    public $caz;
    public $d;
    public $cpd;
    public $fep;
    public $mem;
    public $e;
    public $tzp;
    public $amp;
    public $le;
    public $cn;
    public $cxm;
    public $cot;
    public $nitro;
    public $cip;
    public $ofl;
    public $az;
    public $cl;
    public $do;
    public $amc2;
    public $cro2;
    public $caz2;
    public $d2;
    public $cpd2;
    public $fep2;
    public $mem2;
    public $e2;
    public $tzp2;
    public $amp2;
    public $le2;
    public $cn2;
    public $cxm2;
    public $cot2;
    public $nitro2;
    public $cip2;
    public $ofl2;
    public $az2;
    public $cl2;
    public $do2;
    public $amc3;
    public $cro3;
    public $caz3;
    public $d3;
    public $cpd3;
    public $fep3;
    public $mem3;
    public $e3;
    public $tzp3;
    public $amp3;
    public $le3;
    public $cn3;
    public $cxm3;
    public $cot3;
    public $nitro3;
    public $cip3;
    public $ofl3;
    public $az3;
    public $cl3;
    public $do3;
    public $amc4;
    public $cro4;
    public $caz4;
    public $d4;
    public $cpd4;
    public $fep4;
    public $mem4;
    public $e4;
    public $tzp4;
    public $amp4;
    public $le4;
    public $cn4;
    public $cxm4;
    public $cot4;
    public $nitro4;
    public $cip4;
    public $ofl4;
    public $az4;
    public $cl4;
    public $do4;
    public $amc5;
    public $cro5;
    public $caz5;
    public $d5;
    public $cpd5;
    public $fep5;
    public $mem5;
    public $e5;
    public $tzp5;
    public $amp5;
    public $le5;
    public $cn5;
    public $cxm5;
    public $cot5;
    public $nitro5;
    public $cip5;
    public $ofl5;
    public $az5;
    public $cl5;
    public $do5;
    public $address;
    public $samp_rec_by;
    public $other_spec;
    public $direct_gram;
    public $days_of_ab;
    public $mode_of_prod;
    public $time_prod;
    public $time_rec;
    public $time_ex;
    public $volume;
    public $viscosity;
    public $semen_colour;
    public $semen_epith_cell;
    public $liq;
    public $ph_micro;
    public $motility;
    public $percent_motility;
    public $morphology;
    public $pus_gel;
    public $rbc_micro;
    public $others_micro;
    public $sperm_conc;
    public $total_conc;
    public $titre;
    public $sal_typh;
    public $sal_typh_a;
    public $sal_typh_b;
    public $sal_typh_c;
    public $widal_test;
    public $pregnancy_test;
    public $vdrl_test;
    public $mantoux_test;
    public $remark;
    public $date_ex;
    public $date_admin;
    public $widal_kit_used;
    public $preg_kit_used;
    public $type_of_reagent;
    public $vdrl_kit_used;
    public $mantoux_kit_used;
    public $prog;
    public $non_prog;
    public $imm;
    public $igg;
    public $igm;
    public $salmo_d_o;
    public $salmo_d_h;
    public $salmo_a_o;
    public $salmo_a_h;
    public $salmo_b_o;
    public $salmo_b_h;
    public $salmo_c_o;
    public $salmo_c_h;
    public $org_first_param;
    public $org_second_param;
    public $org_third_param;
    public $org_first;
    public $org_second;
    public $org_third;
    public $org_first2;
    public $org_second2;
    public $org_third2;
    public $org_first3;
    public $org_second3;
    public $org_third3;
    public $org_first4;
    public $org_second4;
    public $org_third4;
    public $org_first5;
    public $org_second5;
    public $org_third5;
    public $notes;
    public $date;


    public static function find_by_result_id($result_id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " .static::$table_name. " WHERE result_id=".$database->escape_value($result_id));
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }







    public static function create_table(){
        $sql = 'CREATE TABLE IF NOT EXISTS ' . TestResult::$table_name . '(' .
            'id INT NOT NULL AUTO_INCREMENT, ' .
            'result_id INT(11) NOT NULL, ' .
            'sync VARCHAR(50) NOT NULL, ' .
            'auth_code INT(11) NOT NULL, ' .
            'pcv VARCHAR(50) NOT NULL, ' .
            'mch VARCHAR(50) NOT NULL, ' .
            'mchc VARCHAR(50) NOT NULL, ' .
            'mcv VARCHAR(50) NOT NULL, ' .
            'retics VARCHAR(50) NOT NULL, ' .
            'retics_index VARCHAR(50) NOT NULL, ' .
            'hb VARCHAR(50) NOT NULL, ' .
            'wbc VARCHAR(50) NOT NULL, ' .
            'platelet VARCHAR(50) NOT NULL, ' .
            'hb_genotype VARCHAR(50) NOT NULL, ' .
            'esr VARCHAR(50) NOT NULL, ' .
            'finger_prick VARCHAR(50) NOT NULL, ' .
            'clotted_blood VARCHAR(50) NOT NULL, ' .
            'blood_cit VARCHAR(50) NOT NULL, ' .
            'blood_seq VARCHAR(50) NOT NULL, ' .
            'marrow VARCHAR(50) NOT NULL, ' .
            'spec_others VARCHAR(50) NOT NULL, ' .
            'exam_req VARCHAR(50) NOT NULL, ' .
            'haem_com VARCHAR(50) NOT NULL, ' .
            'film_app VARCHAR(50) NOT NULL, ' .
            'ani VARCHAR(50) NOT NULL, ' .
            'poikil VARCHAR(50) NOT NULL, ' .
            'poly VARCHAR(50) NOT NULL, ' .
            'macro VARCHAR(50) NOT NULL, ' .
            'micro VARCHAR(50) NOT NULL, ' .
            'hypo VARCHAR(50) NOT NULL, ' .
            'sickle_cells VARCHAR(50) NOT NULL, ' .
            'target_cells VARCHAR(50) NOT NULL, ' .
            'spherocytes VARCHAR(50) NOT NULL, ' .
            'nucleated VARCHAR(50) NOT NULL, ' .
            'inclusion VARCHAR(50) NOT NULL, ' .
            'film_others VARCHAR(50) NOT NULL, ' .
            'blast VARCHAR(50) NOT NULL, ' .
            'others VARCHAR(50) NOT NULL, ' .
            'promyelocyre VARCHAR(50) NOT NULL, ' .
            'myel VARCHAR(50) NOT NULL, ' .
            'neutrophil VARCHAR(50) NOT NULL, ' .
            'eosinophil VARCHAR(50) NOT NULL, ' .
            'basophil VARCHAR(50) NOT NULL, ' .
            'lymphocyte VARCHAR(50) NOT NULL, ' .
            'monocyte VARCHAR(50) NOT NULL, ' .
            'diff_others VARCHAR(50) NOT NULL, ' .
            'pt VARCHAR(50) NOT NULL, ' .
            'inr VARCHAR(50) NOT NULL, ' .
            'ptt VARCHAR(50) NOT NULL, ' .
            'pt_control VARCHAR(50) NOT NULL, ' .
            'ptt_control VARCHAR(50) NOT NULL, ' .

            'comment TEXT NOT NULL, ' .
            'sodium VARCHAR(50) NOT NULL, ' .
            'potassium VARCHAR(50) NOT NULL, ' .
            'bicarbonate VARCHAR(50) NOT NULL, ' .
            'chloride VARCHAR(50) NOT NULL, ' .
            'calcium VARCHAR(50) NOT NULL, ' .
            'magnessium VARCHAR(50) NOT NULL, ' .
            'phosphorus VARCHAR(50) NOT NULL, ' .
            'urea VARCHAR(50) NOT NULL, ' .
            'creatinine VARCHAR(50) NOT NULL, ' .
            'creatinine_clearance VARCHAR(50) NOT NULL, ' .
            'uric_acid VARCHAR(50) NOT NULL, ' .
            'fasting_glucose VARCHAR(50) NOT NULL, ' .
            'hpp VARCHAR(50) NOT NULL, ' .
            'random_glucose VARCHAR(50) NOT NULL, ' .
            'ogtt VARCHAR(50) NOT NULL, ' .
            'fasting VARCHAR(50) NOT NULL, ' .
            'thirty_min VARCHAR(50) NOT NULL, ' .
            'ninety_min VARCHAR(50) NOT NULL, ' .
            'one_hour VARCHAR(50) NOT NULL, ' .
            'two_hours VARCHAR(50) NOT NULL, ' .
            'three_hours VARCHAR(50) NOT NULL, ' .
            'hbA VARCHAR(50) NOT NULL, ' .
            'total_protein VARCHAR(50) NOT NULL, ' .
            'albumin VARCHAR(50) NOT NULL, ' .
            'total_bilirubin VARCHAR(50) NOT NULL, ' .
            'conj_bilirubin VARCHAR(50) NOT NULL, ' .
            'ast VARCHAR(50) NOT NULL, ' .
            'alt VARCHAR(50) NOT NULL, ' .
            'alk_phosphate VARCHAR(50) NOT NULL, ' .
            'urinary_protein VARCHAR(50) NOT NULL, ' .
            'urinary_creatinine VARCHAR(50) NOT NULL, ' .
            'urine_volume VARCHAR(50) NOT NULL, ' .
            'albumin_ratio VARCHAR(50) NOT NULL, ' .
            'gamma_gt VARCHAR(50) NOT NULL, ' .
            'acid_phosphate VARCHAR(50) NOT NULL, ' .
            'total VARCHAR(50) NOT NULL, ' .
            'prostatic VARCHAR(50) NOT NULL, ' .
            'ck_mb VARCHAR(50) NOT NULL, ' .
            'ldh VARCHAR(50) NOT NULL, ' .
            'amylase VARCHAR(50) NOT NULL, ' .
            'cholinesterase VARCHAR(50) NOT NULL, ' .
            'total_cholesterol VARCHAR(50) NOT NULL, ' .
            'hdl_cholesterol VARCHAR(50) NOT NULL, ' .
            'ldl_cholesterol VARCHAR(50) NOT NULL, ' .
            'vldl_cholesterol VARCHAR(50) NOT NULL, ' .
            'triglycerides VARCHAR(50) NOT NULL, ' .
            'csf VARCHAR(50) NOT NULL, ' .
            'csf_glucose VARCHAR(50) NOT NULL, ' .
            'csf_protein VARCHAR(50) NOT NULL, ' .
            'csf_chloride VARCHAR(50) NOT NULL, ' .
            'urine VARCHAR(50) NOT NULL, ' .
            'electrolytes VARCHAR(50) NOT NULL, ' .
            'protein VARCHAR(50) NOT NULL, ' .

            'macroscopy VARCHAR(50) NOT NULL, ' .
            'blood VARCHAR(50) NOT NULL, ' .
            'mucus VARCHAR(50) NOT NULL, ' .
            'worms VARCHAR(50) NOT NULL, ' .
            'pus_cells VARCHAR(50) NOT NULL, ' .
            'red_blood_cells VARCHAR(50) NOT NULL, ' .
            'starch_granules VARCHAR(50) NOT NULL, ' .
            'occult_blood_comment VARCHAR(100) NOT NULL, ' .
            'ova VARCHAR(50) NOT NULL, ' .
            'cysts VARCHAR(50) NOT NULL, ' .
            'plasmodium VARCHAR(50) NOT NULL, ' .
            'trypanosomes VARCHAR(50) NOT NULL, ' .
            'skin_snip VARCHAR(50) NOT NULL, ' .
            'blood_film VARCHAR(50) NOT NULL, ' .
            'microfilaria VARCHAR(50) NOT NULL, ' .
            'tested_by VARCHAR(50) NOT NULL, ' .
            'reviewed_by VARCHAR(50) NOT NULL, ' .
            'para_density VARCHAR(50) NOT NULL, ' .
            'species VARCHAR(50) NOT NULL, ' .
            'stages VARCHAR(50) NOT NULL, ' .
            'colour VARCHAR(50) NOT NULL, ' .
            'ph VARCHAR(50) NOT NULL, ' .
            'glucose VARCHAR(50) NOT NULL, ' .
            'ketones VARCHAR(50) NOT NULL, ' .
            'bilirubin VARCHAR(50) NOT NULL, ' .
            'rbc VARCHAR(50) NOT NULL, ' .
            'crystals VARCHAR(50) NOT NULL, ' .
            'haematobium VARCHAR(50) NOT NULL, ' .
            'yeast VARCHAR(50) NOT NULL, ' .
            'appearance VARCHAR(50) NOT NULL, ' .
            'sg VARCHAR(50) NOT NULL, ' .
            'protein_para VARCHAR(50) NOT NULL, ' .
            'urobilinogen VARCHAR(50) NOT NULL, ' .
            'wbc_para VARCHAR(50) NOT NULL, ' .
            'epith_cells VARCHAR(50) NOT NULL, ' .
            'casts VARCHAR(50) NOT NULL, ' .
            'bacteria VARCHAR(50) NOT NULL, ' .
            't_vaginals VARCHAR(50) NOT NULL, ' .
            'blood_urine VARCHAR(50) NOT NULL, ' .
            'nitrite VARCHAR(50) NOT NULL, ' .
            'leucocyte VARCHAR(50) NOT NULL, ' .

            'macroscopy_micro VARCHAR(180) NOT NULL, ' .
            'colour_micro VARCHAR(180) NOT NULL, ' .
            'albumin_micro VARCHAR(180) NOT NULL, ' .
            'pus_cell VARCHAR(180) NOT NULL, ' .
            'rbcs VARCHAR(50) NOT NULL, ' .
            'epith_cell VARCHAR(50) NOT NULL, ' .
            'yeast_cell VARCHAR(50) NOT NULL, ' .
            'bacteria_micro VARCHAR(50) NOT NULL, ' .
            'xtals VARCHAR(50) NOT NULL, ' .
            'hyaline VARCHAR(50) NOT NULL, ' .
            'granular VARCHAR(50) NOT NULL, ' .
            'cellular VARCHAR(50) NOT NULL, ' .
            'parasites VARCHAR(180) NOT NULL, ' .
            'wbc_micro VARCHAR(50) NOT NULL, ' .
            'polymorphs VARCHAR(50) NOT NULL, ' .
            'lymphoetes VARCHAR(50) NOT NULL, ' .
            'culture_isolates_1 VARCHAR(180) NOT NULL, ' .
            'culture_isolates_2 VARCHAR(180) NOT NULL, ' .
            'culture_isolates_3 VARCHAR(180) NOT NULL, ' .
            'culture_isolates_4 VARCHAR(180) NOT NULL, ' .
            'culture_isolates_5 VARCHAR(180) NOT NULL, ' .
            'amc VARCHAR(50) NOT NULL, ' .
            'cro VARCHAR(50) NOT NULL, ' .
            'caz VARCHAR(50) NOT NULL, ' .
            'd VARCHAR(50) NOT NULL, ' .
            'cpd VARCHAR(50) NOT NULL, ' .
            'fep VARCHAR(50) NOT NULL, ' .
            'mem VARCHAR(50) NOT NULL, ' .
            'e VARCHAR(50) NOT NULL, ' .
            'tzp VARCHAR(50) NOT NULL, ' .
            'amp VARCHAR(50) NOT NULL, ' .
            'le VARCHAR(50) NOT NULL, ' .
            'cn VARCHAR(50) NOT NULL, ' .
            'cxm VARCHAR(50) NOT NULL, ' .
            'cot VARCHAR(50) NOT NULL, ' .
            'nitro VARCHAR(50) NOT NULL, ' .
            'cip VARCHAR(50) NOT NULL, ' .
            'ofl VARCHAR(50) NOT NULL, ' .
            'az VARCHAR(50) NOT NULL, ' .
            'cl VARCHAR(50) NOT NULL, ' .
            'do VARCHAR(50) NOT NULL, ' .
            'amc2 VARCHAR(50) NOT NULL, ' .
            'cro2 VARCHAR(50) NOT NULL, ' .
            'caz2 VARCHAR(50) NOT NULL, ' .
            'd2 VARCHAR(50) NOT NULL, ' .
            'cpd2 VARCHAR(50) NOT NULL, ' .
            'fep2 VARCHAR(50) NOT NULL, ' .
            'mem2 VARCHAR(50) NOT NULL, ' .
            'e2 VARCHAR(50) NOT NULL, ' .
            'tzp2 VARCHAR(50) NOT NULL, ' .
            'amp2 VARCHAR(50) NOT NULL, ' .
            'le2 VARCHAR(50) NOT NULL, ' .
            'cn2 VARCHAR(50) NOT NULL, ' .
            'cxm2 VARCHAR(50) NOT NULL, ' .
            'cot2 VARCHAR(50) NOT NULL, ' .
            'nitro2 VARCHAR(50) NOT NULL, ' .
            'cip2 VARCHAR(50) NOT NULL, ' .
            'ofl2 VARCHAR(50) NOT NULL, ' .
            'az2 VARCHAR(50) NOT NULL, ' .
            'cl2 VARCHAR(50) NOT NULL, ' .
            'do2 VARCHAR(50) NOT NULL, ' .
            'amc3 VARCHAR(50) NOT NULL, ' .
            'cro3 VARCHAR(50) NOT NULL, ' .
            'caz3 VARCHAR(50) NOT NULL, ' .
            'd3 VARCHAR(50) NOT NULL, ' .
            'cpd3 VARCHAR(50) NOT NULL, ' .
            'fep3 VARCHAR(50) NOT NULL, ' .
            'mem3 VARCHAR(50) NOT NULL, ' .
            'e3 VARCHAR(50) NOT NULL, ' .
            'tzp3 VARCHAR(50) NOT NULL, ' .
            'amp3 VARCHAR(50) NOT NULL, ' .
            'le3 VARCHAR(50) NOT NULL, ' .
            'cn3 VARCHAR(50) NOT NULL, ' .
            'cxm3 VARCHAR(50) NOT NULL, ' .
            'cot3 VARCHAR(50) NOT NULL, ' .
            'nitro3 VARCHAR(50) NOT NULL, ' .
            'cip3 VARCHAR(50) NOT NULL, ' .
            'ofl3 VARCHAR(50) NOT NULL, ' .
            'az3 VARCHAR(50) NOT NULL, ' .
            'cl3 VARCHAR(50) NOT NULL, ' .
            'do3 VARCHAR(50) NOT NULL, ' .
            'amc4 VARCHAR(50) NOT NULL, ' .
            'cro4 VARCHAR(50) NOT NULL, ' .
            'caz4 VARCHAR(50) NOT NULL, ' .
            'd4 VARCHAR(50) NOT NULL, ' .
            'cpd4 VARCHAR(50) NOT NULL, ' .
            'fep4 VARCHAR(50) NOT NULL, ' .
            'mem4 VARCHAR(50) NOT NULL, ' .
            'e4 VARCHAR(50) NOT NULL, ' .
            'tzp4 VARCHAR(50) NOT NULL, ' .
            'amp4 VARCHAR(50) NOT NULL, ' .
            'le4 VARCHAR(50) NOT NULL, ' .
            'cn4 VARCHAR(50) NOT NULL, ' .
            'cxm4 VARCHAR(50) NOT NULL, ' .
            'cot4 VARCHAR(50) NOT NULL, ' .
            'nitro4 VARCHAR(50) NOT NULL, ' .
            'cip4 VARCHAR(50) NOT NULL, ' .
            'ofl4 VARCHAR(50) NOT NULL, ' .
            'az4 VARCHAR(50) NOT NULL, ' .
            'cl4 VARCHAR(50) NOT NULL, ' .
            'do4 VARCHAR(50) NOT NULL, ' .
            'amc5 VARCHAR(50) NOT NULL, ' .
            'cro5 VARCHAR(50) NOT NULL, ' .
            'caz5 VARCHAR(50) NOT NULL, ' .
            'd5 VARCHAR(50) NOT NULL, ' .
            'cpd5 VARCHAR(50) NOT NULL, ' .
            'fep5 VARCHAR(50) NOT NULL, ' .
            'mem5 VARCHAR(50) NOT NULL, ' .
            'e5 VARCHAR(50) NOT NULL, ' .
            'tzp5 VARCHAR(50) NOT NULL, ' .
            'amp5 VARCHAR(50) NOT NULL, ' .
            'le5 VARCHAR(50) NOT NULL, ' .
            'cn5 VARCHAR(50) NOT NULL, ' .
            'cxm5 VARCHAR(50) NOT NULL, ' .
            'cot5 VARCHAR(50) NOT NULL, ' .
            'nitro5 VARCHAR(50) NOT NULL, ' .
            'cip5 VARCHAR(50) NOT NULL, ' .
            'ofl5 VARCHAR(50) NOT NULL, ' .
            'az5 VARCHAR(50) NOT NULL, ' .
            'cl5 VARCHAR(50) NOT NULL, ' .
            'do5 VARCHAR(50) NOT NULL, ' .
            'address VARCHAR(100) NOT NULL, ' .
            'samp_rec_by VARCHAR(50), ' .
            'other_spec VARCHAR(50), ' .
            'direct_gram VARCHAR(180), ' .
            'days_of_ab VARCHAR(50) NOT NULL, ' .
            'mode_of_prod VARCHAR(50) NOT NULL, ' .
            'time_prod TIME NOT NULL, ' .
            'time_rec TIME NOT NULL, ' .
            'time_ex TIME NOT NULL, ' .
            'volume VARCHAR(50) NOT NULL, ' .
            'semen_colour VARCHAR(50) NOT NULL, ' .
            'viscosity VARCHAR(50) NOT NULL, ' .
            'liq VARCHAR(50) NOT NULL, ' .
            'ph_micro VARCHAR(50) NOT NULL, ' .
            'motility VARCHAR(50) NOT NULL, ' .
            'percent_motility VARCHAR(50) NOT NULL, ' .
            'morphology VARCHAR(50) NOT NULL, ' .
            'pus_gel VARCHAR(50) NOT NULL, ' .
            'semen_epith_cell VARCHAR(50) NOT NULL, ' .
            'rbc_micro VARCHAR(50) NOT NULL, ' .
            'others_micro VARCHAR(50) NOT NULL, ' .
            'sperm_conc VARCHAR(50) NOT NULL, ' .
            'total_conc VARCHAR(50) NOT NULL, ' .
            'titre VARCHAR(50) NOT NULL, ' .
            'sal_typh VARCHAR(50) NOT NULL, ' .
            'sal_typh_a VARCHAR(50) NOT NULL, ' .
            'sal_typh_b VARCHAR(50) NOT NULL, ' .
            'sal_typh_c VARCHAR(50) NOT NULL, ' .
            'widal_test VARCHAR(50) NOT NULL, ' .
            'pregnancy_test VARCHAR(50) NOT NULL, ' .
            'vdrl_test VARCHAR(50) NOT NULL, ' .
            'mantoux_test VARCHAR(50) NOT NULL, ' .
            'remark VARCHAR(50) NOT NULL, ' .
            'date_ex DATETIME NOT NULL, ' .
            'date_admin DATETIME NOT NULL, ' .
            'widal_kit_used VARCHAR(50) NOT NULL, ' .
            'preg_kit_used VARCHAR(50) NOT NULL, ' .
            'type_of_reagent VARCHAR(50) NOT NULL, ' .
            'vdrl_kit_used VARCHAR(50) NOT NULL, ' .
            'mantoux_kit_used VARCHAR(50) NOT NULL, ' .
            'prog VARCHAR(50) NOT NULL, ' .
            'non_prog VARCHAR(50) NOT NULL, ' .
            'imm VARCHAR(50) NOT NULL, ' .
            'igg VARCHAR(50) NOT NULL, ' .
            'igm VARCHAR(50) NOT NULL, ' .
            'salmo_d_o VARCHAR(50) NOT NULL, ' .
            'salmo_d_h VARCHAR(50) NOT NULL, ' .
            'salmo_a_o VARCHAR(50) NOT NULL, ' .
            'salmo_a_h VARCHAR(50) NOT NULL, ' .
            'salmo_b_o VARCHAR(50) NOT NULL, ' .
            'salmo_b_h VARCHAR(180) NOT NULL, ' .
            'salmo_c_o VARCHAR(50) NOT NULL, ' .
            'salmo_c_h VARCHAR(50) NOT NULL, ' .
            'org_first_param VARCHAR(50) NOT NULL, ' .
            'org_second_param VARCHAR(50) NOT NULL, ' .
            'org_third_param VARCHAR(50) NOT NULL, ' .
            'org_first VARCHAR(50) NOT NULL, ' .
            'org_second VARCHAR(50) NOT NULL, ' .
            'org_third VARCHAR(50) NOT NULL, ' .
            'org_first2 VARCHAR(50) NOT NULL, ' .
            'org_second2 VARCHAR(50) NOT NULL, ' .
            'org_third2 VARCHAR(50) NOT NULL, ' .
            'org_first3 VARCHAR(50) NOT NULL, ' .
            'org_second3 VARCHAR(50) NOT NULL, ' .
            'org_third3 VARCHAR(50) NOT NULL, ' .
            'org_first4 VARCHAR(50) NOT NULL, ' .
            'org_second4 VARCHAR(50) NOT NULL, ' .
            'org_third4 VARCHAR(50) NOT NULL, ' .
            'org_first5 VARCHAR(50) NOT NULL, ' .
            'org_second5 VARCHAR(50) NOT NULL, ' .
            'org_third5 VARCHAR(50) NOT NULL, ' .

            'notes TEXT NOT NULL, ' .
            'date DATETIME NOT NULL, ' .
            'PRIMARY KEY(id))';
        TestResult::run_script($sql);
    }


}




TestResult::create_table();