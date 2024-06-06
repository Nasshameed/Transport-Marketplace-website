<?php
require_once "header.php";
require_once "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $id = isset($_POST['id']) ? $_POST['id'] : null; // Retrieve the id from the form

    $name = trim($_POST["name"]);
    $phone = trim($_POST["phone"]);
    $city = trim($_POST["city"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $ab_company = trim($_POST["ab_company"]);

    function generateUniqueFilename($originalName) {
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        return uniqid() . '.' . $extension;
    }

    $image = $_FILES['image']['name'] ? 'uploads/' . generateUniqueFilename($_FILES['image']['name']) : null;
    $userimage = $_FILES['uimage']['name'] ? 'uploads/' . generateUniqueFilename($_FILES['uimage']['name']) : null;
    $company_logo = $_FILES['clogo']['name'] ? 'uploads/' . generateUniqueFilename($_FILES['clogo']['name']) : null;

    if ($image) move_uploaded_file($_FILES['image']['tmp_name'], $image);
    if ($userimage) move_uploaded_file($_FILES['uimage']['tmp_name'], $userimage);
    if ($company_logo) move_uploaded_file($_FILES['clogo']['tmp_name'], $company_logo);

    $sql = "UPDATE `user/company` SET name=?, phone=?, city=?, email=?, password=?, ab_company=?";
    if ($image) $sql .= ", image=?";
    if ($userimage) $sql .= ", userimage=?";
    if ($company_logo) $sql .= ", company_logo=?";
    $sql .= " WHERE id=?";

    if ($stmt = $conn->prepare($sql)) {
        if ($image && $userimage && $company_logo) {
            $stmt->bind_param("sssssssssi", $name, $phone, $city, $email, $password, $ab_company, $image, $userimage, $company_logo, $id);
        } elseif ($image && $userimage) {
            $stmt->bind_param("sssssssi", $name, $phone, $city, $email, $password, $ab_company, $image, $userimage, $id);
        } elseif ($image) {
            $stmt->bind_param("ssssssi", $name, $phone, $city, $email, $password, $ab_company, $image, $id);
        } elseif ($userimage && $company_logo) {
            $stmt->bind_param("sssssssi", $name, $phone, $city, $email, $password, $ab_company, $userimage, $company_logo, $id);
        } elseif ($userimage) {
            $stmt->bind_param("ssssssi", $name, $phone, $city, $email, $password, $ab_company, $userimage, $id);
        } elseif ($company_logo) {
            $stmt->bind_param("ssssssi", $name, $phone, $city, $email, $password, $ab_company, $company_logo, $id);
        } else {
            $stmt->bind_param("sssssi", $name, $phone, $city, $email, $password, $ab_company, $id);
        }

        if ($stmt->execute()) {
            echo "Record updated successfully.";
            header("Location: prifile.php");
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $conn->error;
    }

    $conn->close();
}
?>
