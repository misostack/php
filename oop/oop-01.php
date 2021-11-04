<?php

class Date
{
    const LONG_FORMAT = 'Y-m-d H:i:s';
    private string $_date;
    public function __construct($dateString = null)
    {
        $this->_date = $dateString == null ? date(self::LONG_FORMAT) : $dateString;
    }

    public function toString(): string {
        return $this->_date;
    }
}

class User
{
    // it must not be changed - auto creation by DBMS - primary key(cluster index) - surrogate key
    private int $_id;
    // login id for a user - unique value - non-cluster index
    private string $_login;
    // the manual user's password will be encrypted before storing in database
    private string $_hashedPassword;
    // user's email - unique value - can not be update directly - and may trigger another flow of verification
    private string $_email;
    // possible to change when user his/her update profile
    private string $_first_name;
    private string $_last_name;
    private string $_gender; // possible values: 'F': female, 'M': male
    // user's type must not be modified, and the value must be one of those possible values: "admin", "member"
    private string $_type;
    // possible to change via some process: creation, confirmation, active/deactive user's account (admin)
    private string $_status;
    // can not be changed
    private Date $_created_at;
    // possible to change everytime user's properties has been updated
    private Date $_updated_at;
    // is_super_admin
    private bool $_is_super_admin;

    /**
     * User constructor.
     */
    public function __construct(
        int $id,
        string $login,
        string $hashedPassword,
        string $email,
        string $first_name,
        string $last_name,
        string $type,
        string $status,
        string $gender,
        bool $is_super_admin,
        Date $created_at,
        Date $updated_at
    )
    {
        $this->_id = $id;
        $this->_login = $login;
        $this->_email = $email;
        $this->_hashedPassword = $hashedPassword;
        $this->_first_name = $first_name;
        $this->_last_name = $last_name;
        $this->_type = $type;
        $this->_status = $status;
        $this->_is_super_admin = $is_super_admin;
        $this->_created_at = $created_at;
        $this->_updated_at = $updated_at;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->_id;
    }

    /**
     * @param  string  $id
     */
    public function setId(string $id): void
    {
        $this->_id = $id;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->_login;
    }

    /**
     * @param  string  $login
     */
    public function setLogin(string $login): void
    {
        $this->_login = $login;
    }

    /**
     * @return string
     */
    public function getHashedPassword(): string
    {
        return $this->_hashedPassword;
    }

    /**
     * @param  string  $hashedPassword
     */
    public function setHashedPassword(string $hashedPassword): void
    {
        $this->_hashedPassword = $hashedPassword;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->_email;
    }

    /**
     * @param  string  $email
     */
    public function setEmail(string $email): void
    {
        $this->_email = $email;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->_first_name;
    }

    /**
     * @param  string  $first_name
     */
    public function setFirstName(string $first_name): void
    {
        $this->_first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->_last_name;
    }

    /**
     * @param  string  $last_name
     */
    public function setLastName(string $last_name): void
    {
        $this->_last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->_gender;
    }

    /**
     * @param  string  $gender
     */
    public function setGender(string $gender): void
    {
        $this->_gender = $gender;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->_type;
    }

    /**
     * @param  string  $type
     */
    public function setType(string $type): void
    {
        $this->_type = $type;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->_status;
    }

    /**
     * @param  string  $status
     */
    public function setStatus(string $status): void
    {
        $this->_status = $status;
    }

    /**
     * @return Date
     */
    public function getCreatedAt(): Date
    {
        return $this->_created_at;
    }

    /**
     * @param  Date  $created_at
     */
    public function setCreatedAt(Date $created_at): void
    {
        $this->_created_at = $created_at;
    }

    /**
     * @return Date
     */
    public function getUpdatedAt(): Date
    {
        return $this->_updated_at;
    }

    /**
     * @param  Date  $updated_at
     */
    public function setUpdatedAt(Date $updated_at): void
    {
        $this->_updated_at = $updated_at;
    }

    /**
     * @return bool
     */
    public function isIsSuperAdmin(): bool
    {
        return $this->_is_super_admin;
    }

    /**
     * @param  bool  $is_super_admin
     */
    public function setIsSuperAdmin(bool $is_super_admin): void
    {
        $this->_is_super_admin = $is_super_admin;
    }
}

function oop001_main()
{
    $user = new User(
        0,
        'test.user.1',
        '123456',
        'test.user.1@yopmail.com',
        'user.1',
        'test',
        'member',
        'pending',
        'M',
        false,
        new Date(),
        new Date()
    );
    /*
    $user->setLogin('test.user.1');
    $user->setEmail('test.user.1@yopmail.com');
    $user->setHashedPassword('123456');
    $user->setFirstName('user.1');
    $user->setLastName('test');
    $user->setType('member');
    $user->setStatus('pending');
    $user->setCreatedAt(new Date());
    $user->setUpdatedAt(new Date());
    $user->setGender('F');
    $user->setIsSuperAdmin(false);
    */
    var_dump($user);
}
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    oop001_main();
}
