<?php
class Report_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
           return $this->db->query("SELECT count(*) as Count , sum(nilai_project) as nilai ,project_status FROM project JOIN job
           ON job.job_name=project.project_status GROUP BY project_status ORDER BY job_id ASC")->result_array();
        }
        public function witel(){
            return $this->db->query("SELECT job_name , (SELECT COUNT(*) FROM project Where witel_id=6 and project_status=job_name) as jaktim , (SELECT COUNT(*) FROM project Where witel_id=7 and project_status=job_name) as jaksel , (SELECT COUNT(*) FROM project Where witel_id=8 and project_status=job_name) as jakbar , (SELECT COUNT(*) FROM project Where witel_id=9 and project_status=job_name) as jakpus , (SELECT COUNT(*) FROM project Where witel_id=10 and project_status=job_name) as jakut , (SELECT COUNT(*) FROM project Where witel_id=11 and project_status=job_name) as bogor , (SELECT COUNT(*) FROM project Where witel_id=12 and project_status=job_name) as tanggrang , (SELECT COUNT(*) FROM project Where witel_id=13 and project_status=job_name) as banten, (SELECT COUNT(*) FROM project Where witel_id=14 and project_status=job_name) as cirebon , (SELECT COUNT(*) FROM project Where witel_id=15 and project_status=job_name) as bandung , (SELECT COUNT(*) FROM project Where witel_id=16 and project_status=job_name) as bekasi FROM job;")->result_array();
        }
    }
    ?>