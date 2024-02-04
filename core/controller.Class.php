<?php
class Connect extends PDO
{
    public function __construct()
    {
        parent::__construct(
            "mysql:host=localhost;dbname=google_login",
            'root',
            '',
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
}

class Controller
{
    //print DATA
    function printData($id)
    {
        $db = new Connect;
        $user = $db->prepare("SELECT * FROM users ORDER BY id");
        $user->execute();
        $content = '
        <table class="table">
            <thead class="thead-light">
                <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Avatar</th>
                <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>';
        while ($userInfo = $user->fetch(PDO::FETCH_ASSOC)) {
            $content .= '
            <tr>
                <td>' . $userInfo["f_name"] . '</td>
                <td>' . $userInfo["l_name"] . '</td>
                <td><img style="max-width: 50px;" src="' . $userInfo["avatar"] . '" alt="User Avatar"></td>
                <td>' . $userInfo["email"] . '</td>
            </tr>
            ';
        }
        $content .= '
        </tbody>
        </table>';
        return $content;
    }

    // print EMAIL only
    function printEmail($id)
    {
        $db = new Connect;

        // Fetch user email
        $user = $db->prepare("SELECT email FROM users WHERE id = :id");
        $user->execute([':id' => $id]);
        $userInfo = $user->fetch(PDO::FETCH_ASSOC);

        $content = $userInfo["email"];

        return $content;
    }

    function printName($id)
    {

        $db = new Connect;

        // Fetch user f_Name
        $user = $db->prepare("SELECT f_name FROM users WHERE id = :id");
        $user->execute([':id' => $id]);
        $userInfo = $user->fetch(PDO::FETCH_ASSOC);

        $content = '<div>YourName: ' . $userInfo["f_name"] . '</div>';
        return $content;
    }

    function printEvaluationForm()
    {
        header('Location: EvaluationForm.php');
        exit(); // Ensure that no further code is executed after the redirect

    }

    function EvaluationForm($id)
    {
        $db = new Connect;
        $user = $db->prepare("SELECT email FROM users WHERE id = :id");
        $user->execute([':id' => $id]);
        $content = '
            <style>
            .form-container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #f5f5f5;
                border: 1px solid #ddd;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
    
            .form-group {
                margin-bottom: 15px;
            }
    
            label {
                display: block;
                margin-bottom: 5px;
            }
    
            input,
            textarea {
                width: 100%;
                padding: 8px;
                box-sizing: border-box;
                margin-bottom: 10px;
            }
    
            button {
                background-color: #4caf50;
                color: #fff;
                padding: 10px 15px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
    
            button:hover {
                background-color: #45a049;
            }
    
            .btn-danger {
                background-color: #d9534f;
                color: #fff;
                padding: 10px 15px;
                text-decoration: none;
                border-radius: 5px;
            }
    
            .btn-danger:hover {
                background-color: #c9302c;
            }
    
            .top-right {
                position: absolute;
                top: 50px;
            }
    
            .btn-logout {
                background-color: #d9534f;
                color: #fff;
                padding: 5px;
                text-decoration: none;
                border-radius: 5px;
                border: none;
                cursor: pointer;
                transition: background-color 0.3s;
            }
    
            .btn-logout:hover {
                background-color: #c9302c;
            }
            </style>';
    
        $content .= '<div class="form-container">
            <h2>แบบประเมินการสอน</h2>
            <form action="evaluationFormEmail.php" method="post">
                <div class="form-group">
                    <label for="teacher_name">ชื่อครูผู้สอน:</label>
                    <input type="text" name="teacher_name" required>
                </div>
                <div class="form-group">
                    <label for="subject">วิชาที่สอน:</label>
                    <input type="text" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="rating">คะแนนการสอน (1-10):</label>
                    <input type="number" name="rating" min="1" max="10" required>
                </div>
                <div class="form-group">
                    <label for="comments">ความคิดเห็น:</label>
                    <textarea name="comments" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="email">อีเมล:</label>
                    <input type="email" name="email" value="';
    
        while ($userInfo = $user->fetch(PDO::FETCH_ASSOC)) {
            $content .= $userInfo["email"];
        }
    
        $content .= '" required>
                </div>
                <button type="submit">ส่งแบบประเมิน</button>
            </form>
        </div>';
    
        echo $content;
    }
    
    function checkUserStatus($id, $sess)
    {
        $db = new Connect;
        $user = $db->prepare("SELECT id FROM users WHERE id=:id AND session=:session");
        $user->execute([
            ':id'       => intval($id),
            ':session'  => $sess
        ]);
        $userInfo = $user->fetch(PDO::FETCH_ASSOC);

        if (!$userInfo || !isset($userInfo["id"])) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function checkUserExists($email)
    {
        $db = new Connect;
        $checkUser = $db->prepare("SELECT * FROM users WHERE email=:email");
        $checkUser->execute(['email' => $email]);
        $userInfo = $checkUser->fetch(PDO::FETCH_ASSOC);

        return !empty($userInfo); // Returns true if user exists, false otherwise
    }

    //genarate char
    function generateCode($lenght)
    {
        $chars = "vwyzABC01256";
        $code = "";
        $clean = strlen($chars) - 1;
        while (strlen($code) < $lenght) {
            $code .= $chars[mt_rand(0, $clean)];
        }
        return $code;
    }


    // ฟังก์ชันใหม่สำหรับแฮชรหัสผ่าน
    private function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    //insert data
    function insertData($data)
    {
        $db = new Connect;
        $checkUser = $db->prepare("SELECT * FROM users WHERE email=:email");
        $checkUser->execute(['email' => $data["email"]]);
        $info = $checkUser->fetch(PDO::FETCH_ASSOC);

        if (!$info["id"]) {
            $session = $this->generateCode(10);
            $insertUser = $db->prepare("INSERT INTO users (f_name, l_name, avatar, email, password,session) VALUES (:f_name, :l_name, :avatar, :email, :password, :session)");
            $insertUser->execute([
                ':f_name'   => $data["givenName"],
                ':l_name'   => $data["familyName"],
                ':avatar'   => $data["avatar"],
                ':email'    => $data["email"],
                ':password' => $this->hashPassword($this->generateCode(5)),
                ':session'  => $session
            ]);

            if ($insertUser) {
                setcookie("id", $db->lastInsertId(), time() + 60 * 60 * 24 * 30, "/", NULL);
                setcookie("sess", $session, time() + 60 * 60 * 24 * 30, "/", NULL);
                header('Location: HomePage.php');
                exit();
            } else {
                return "Error inserting user!";
            }
        } else {
            setcookie("id", $info['id'], time() + 60 * 60 * 24 * 30, "/", NULL);
            setcookie("sess", $info["session"], time() + 60 * 60 * 24 * 30, "/", NULL);
            header('Location: HomePage.php');
            exit();
        }
    }

    function loginWithSession($id, $session)
    {
        $Controller = new Controller;
        $db = new Connect;
        $checkUser = $db->prepare("SELECT * FROM users WHERE id=:id AND session=:session");
        $checkUser->execute([
            'id' => intval($id), 
            'session' => $session
        ]);
        $info = $checkUser->fetch(PDO::FETCH_ASSOC);
    
        if ($info) {
            setcookie("id", $info['id'], time() + 60 * 60 * 24 * 30, "/", NULL);
            setcookie("sess", $info["session"], time() + 60 * 60 * 24 * 30, "/", NULL);
            $Controller->EvaluationForm($id);
            exit();
        } else {
            // Redirect to login page or handle authentication failure
            header('Location: index.php');
            exit();
        }
    }


}
