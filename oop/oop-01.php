<?php

class Date {

}

class User {
	// it must not be changed - auto creation by DBMS - primary key(cluster index) - surrogate key
	private String $_id;
	// login id for a user - unique value - non-cluster index
	private String $_login;
    // the manual user's password will be encrypted before storing in database
    private String $_hashedPassword;
	// user's email - unique value - can not be update directly - and may trigger another flow of verification
	private String $_email;
	// possible to change when user his/her update profile
	private String $_first_name;
	private String $_last_name;
	private String $_gender; // possible values: 'F': female, 'M': male
	// user's type must not be modified, and the value must be one of those possible values: "admin", "member"
	private String $_type;
	// possible to change via some process: creation, confirmation, active/deactive user's account (admin)
	private String $_status;
	// can not be changed
	private Date $_created_at;
	// possible to change everytime user's properties has been updated
	private Date $_updated_at;

    /**
     * User constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return String
     */
    public function getId(): string
    {
        return $this->_id;
    }

    /**
     * @param  String  $id
     */
    public function setId(string $id): void
    {
        $this->_id = $id;
    }

    /**
     * @return String
     */
    public function getLogin(): string
    {
        return $this->_login;
    }

    /**
     * @param  String  $login
     */
    public function setLogin(string $login): void
    {
        $this->_login = $login;
    }

    /**
     * @return String
     */
    public function getHashedPassword(): string
    {
        return $this->_hashedPassword;
    }

    /**
     * @param  String  $hashedPassword
     */
    public function setHashedPassword(string $hashedPassword): void
    {
        $this->_hashedPassword = $hashedPassword;
    }

    /**
     * @return String
     */
    public function getEmail(): string
    {
        return $this->_email;
    }

    /**
     * @param  String  $email
     */
    public function setEmail(string $email): void
    {
        $this->_email = $email;
    }

    /**
     * @return String
     */
    public function getFirstName(): string
    {
        return $this->_first_name;
    }

    /**
     * @param  String  $first_name
     */
    public function setFirstName(string $first_name): void
    {
        $this->_first_name = $first_name;
    }

    /**
     * @return String
     */
    public function getLastName(): string
    {
        return $this->_last_name;
    }

    /**
     * @param  String  $last_name
     */
    public function setLastName(string $last_name): void
    {
        $this->_last_name = $last_name;
    }

    /**
     * @return String
     */
    public function getGender(): string
    {
        return $this->_gender;
    }

    /**
     * @param  String  $gender
     */
    public function setGender(string $gender): void
    {
        $this->_gender = $gender;
    }

    /**
     * @return String
     */
    public function getType(): string
    {
        return $this->_type;
    }

    /**
     * @param  String  $type
     */
    public function setType(string $type): void
    {
        $this->_type = $type;
    }

    /**
     * @return String
     */
    public function getStatus(): string
    {
        return $this->_status;
    }

    /**
     * @param  String  $status
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


}

function oop001_main(){
    $user = new User();
    var_dump($user);
}