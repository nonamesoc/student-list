<?php
/**
 * Created by PhpStorm.
 * User: Avatar
 * Date: 02.01.2019
 * Time: 18:25
 */
require_once ('Student.php');

class StudentsDataGateway
{
    public $db;

    public function __construct(PDO $pdo) {
        $this->db = $pdo;
    }

    public function findById($studentId) {
        $query = $this->db->prepare("SELECT name, surname, gender, group_number, email, points, birth_date, residence FROM students
        WHERE id = :id");
        $query->bindValue(':id',$studentId,PDO::PARAM_INT );
        $query->execute();
        $student = $query->fetch(PDO::FETCH_ASSOC);
        return $student;
    }

    public function updateStudent(Student $student, $studentId) {
        $query = $this->db->prepare("UPDATE students SET name =:name, surname =:surname, gender =:gender, group_number =:group_number,
          email =:email, points =:points, birth_date =:birth_date, residence =:residence WHERE id = :id");
        $query->bindValue(':id',$studentId,PDO::PARAM_INT );
        $query->bindValue(':name',$student->name,PDO::PARAM_STR );
        $query->bindValue(':surname',$student->surname,PDO::PARAM_STR );
        $query->bindValue(':gender',$student->gender,PDO::PARAM_STR );
        $query->bindValue(':group_number',$student->group_number,PDO::PARAM_STR );
        $query->bindValue(':email',$student->email,PDO::PARAM_STR );
        $query->bindValue(':points',$student->points,PDO::PARAM_INT );
        $query->bindValue(':birth_date',$student->birth_date,PDO::PARAM_STR );
        $query->bindValue(':residence',$student->residence,PDO::PARAM_STR );
        $query->execute();
        return true;
    }

    public function addStudent(Student $student) {
        $query = $this->db->prepare("INSERT INTO students( name, surname, gender, group_number, email, points, birth_date, residence ) 
        VALUES (:name, :surname, :gender, :group_number, :email, :points, :birth_date, :residence)");
        $query->bindValue(':name',$student->name,PDO::PARAM_STR );
        $query->bindValue(':surname',$student->surname,PDO::PARAM_STR );
        $query->bindValue(':gender',$student->gender,PDO::PARAM_STR );
        $query->bindValue(':group_number',$student->group_number,PDO::PARAM_STR );
        $query->bindValue(':email',$student->email,PDO::PARAM_STR );
        $query->bindValue(':points',$student->points,PDO::PARAM_INT );
        $query->bindValue(':birth_date',$student->birth_date,PDO::PARAM_STR );
        $query->bindValue(':residence',$student->residence,PDO::PARAM_STR );
        $query->execute();
        return $this->db->lastInsertId();
    }

    public function issetEmail($email) {
        $query = $this->db->prepare( "SELECT email FROM students WHERE email = :email");
        $query->bindValue(':email',$email,PDO::PARAM_STR );
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function issetEmailById($id) {
        $query = $this->db->prepare( "SELECT email FROM students WHERE id = :id");
        $query->bindValue(':id',$id,PDO::PARAM_INT );
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getStudentList($page) {
        if(isset($page)) {
            $query = $this->db->prepare("SELECT name, surname, gender, group_number, email, points, birth_date, residence 
            FROM students LIMIT 50 OFFSET :offset");
            $query->bindValue(':offset', ($page-1) * 50, PDO::PARAM_INT);
        } else{
            $query = $this->db->prepare("SELECT name, surname, gender, group_number, email, points, birth_date, residence 
            FROM students");
        }
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Student');
    }

    public function find(){
        $query = $this->db->query("SELECT COUNT(*) FROM students");
        $count = $query->fetch(PDO::FETCH_ASSOC);
        return (int)$count['COUNT(*)'];
    }

    public function get(){
        $query = $this->db->prepare("SELECT COUNT(*) FROM students");
        $count = $query->fetch(PDO::FETCH_ASSOC);
        return (int)$count['COUNT(*)'];
    }

}