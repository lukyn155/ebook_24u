<?php
use Doctrine\ORM\Query\ResultSetMapping;

class LoginModel {

    private $entityManager;

    public function __construct() {
        $this->entityManager = DbModel::getConnection();
    }

    // Tato funkce provede ověření uživatele na základě zadaných přihlašovacích údajů a vrátí potvrzení jako boolean
    public function authenticate(string $login, string $pass): bool {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['login' => $login]);

        if ($user === null || $user->getPassword() !== md5($pass)) {
            return false;
        } else {
            session_start();
            $_SESSION['user_fullname'] = $user->getFullName();
            $_SESSION['user_id'] = $user->getId();
            session_write_close();
            return true;
        }
    }

    // Tato funkce zruší webovou session a tím odhlásí uživatele.
    // Následně přesměruje na přihlašovací stránku.
    public function logOut($controller): void {
        session_start();
        session_destroy();
        $controller->redirect('library');
    }

    public function register($login) {
        $rsm = new ResultSetMapping();
        $query = $this->entityManager->createNativeQuery('INSERT INTO users (firstname, lastname, email, login, password) VALUES (?, ?, ?, ?, ?);', $rsm);
        $query->setParameter(1, $login['regName']);
        $query->setParameter(2, $login['regSurname']);
        $query->setParameter(3, $login['regEmail']);
        $query->setParameter(4, $login['regLogin']);
        $query->setParameter(5, md5($login['regPass']));

        return $users = $query->getResult();
    }

}
