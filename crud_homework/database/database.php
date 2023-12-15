<?php

/**
 * Connect to database
 */
function db()
{
    $host     = 'localhost';
    $database = 'web_a';
    $user     = 'root';
    $password = '';

    try {
        $db = new PDO("mysql:host=$host;dbname=$database", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
        return $db;
    } catch (PDOException $e) {
        // echo "Failed " . $e->getMessage();
        return null;
    }
}

/**
 * Create new student record
 */
function createStudent($name, $age, $email, $image_url)
{
    $db = db();
    $stmt = $db->prepare("INSERT INTO student (name, age, email, profile) 
                          VALUES (:name, :age, :email, :profile)");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':profile', $image_url);

    $stmt->execute();
    return $db->lastInsertId();
}

/**
 * Get all data from table student
 */
function selectAllStudents()
{
    $db = db();
    $stmt = $db->prepare("SELECT * FROM student");
    $stmt->execute();

    $db = null;
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Get only one record by id 
 */
function selectOneStudent($id)
{

    $db = db();
    $stmt = $db->prepare("SELECT * FROM student WHERE id=:id");
    $stmt->execute([
        ":id" => $id
    ]);

    $student = $stmt->fetch(PDO::FETCH_ASSOC);


    $db = null;

    return $student;
}


/**
 * Delete student by id
 */
function deleteStudent($id)
{
    $db = db();
    $stmt = $db->prepare("DELETE FROM student WHERE id=:id");
    $stmt->execute([
        ":id" => $id
    ]);
    return $stmt->rowCount();
}

/**
 * Update student
 */
function updateStudent($id, $name, $age, $email, $image_url)
{
    $db = db();
    $sql = "UPDATE student SET name = :name, age = :age, email = :email, profile = :profile  WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':profile', $image_url);
    $stmt->bindParam(':id', $id);

    $stmt->execute();
    return $stmt->rowCount();
}
