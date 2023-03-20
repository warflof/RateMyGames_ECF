<?php

function addUser(PDO $pdo, string $email, string $password, string $pseudo): bool
{

    $sql = "INSERT INTO utilisateur (email, password, role_id, pseudo) VALUES (:email, :password, :role_id, :pseudo)";

    $query = $pdo->prepare($sql);

    $query->bindValue(':email', $email, PDO::PARAM_STR);

    $query->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);

    $query->bindValue(':role_id', 6, PDO::PARAM_INT);

    $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);

    return $query->execute();
};

function verifyUser(PDO $pdo, string $email, string $password)
{
    $query = $pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
    $query->bindParam(":email", $email, PDO::PARAM_STR);
    $query->execute();
    $users = $query->fetch();



    if ($users && password_verify($password, $users['password'])) {
       // Récupère le rôle de l'utilisateur depuis la base de données
       $query = $pdo->prepare("SELECT * FROM utilisateur_role_vw WHERE email = :email");
       $query->bindParam(":email", $users['email'], PDO::PARAM_INT);
       $query->execute();
       $role = $query->fetch();

       // Stocke le rôle de l'utilisateur dans la session
       session_start();
       $_SESSION['role'] = $role;
       
        return $users;
    } else {
        return false;
    }
}


