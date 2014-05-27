<?php
    /*
        
    */
    class Address
    {
        //Declare variables
        public $addressID;
        public $unit;
        public $house;
        public $street;
        public $suburb;
        public $postcode;
        public $region;
        public $country;
        
        //Construct class.
        function __construct ($address = null)
        {
            $this->addressID = (isset($address['addressID']) ? $address['addressID'] : null);
            $this->unit = (isset($address['unit']) ? $address['unit'] : null);
            $this->house = (isset($address['house']) ? $address['house'] : null);
            $this->street = (isset($address['street']) ? $address['street'] : null);
            $this->suburb = (isset($address['suburb']) ? $address['suburb'] : null);
            $this->postcode = (isset($address['postcode']) ? $address['postcode'] : null);
            $this->region = (isset($address['region']) ? $address['region'] : null);
            $this->country = (isset($address['country']) ? $address['country'] : null);
        }
    }
    
    /*
        
    */
    class Connection
    {
        //Returns database resource identifier, used in connecting to database.
        public function Connect()
        {
            $dbHost = $_SERVER['SERVER_NAME'];
            $dbName = "inb201project";
            $dbUser = "teamtouch";
            $dbPassword = "JFQQ4v2rXs";
            
            $dbResource = mysql_connect($dbHost, $dbUser, $dbPassword);
            mysql_select_db($dbName, $dbResource);
        
            return $dbResource;
        }
    }
    
    /*
        
    */
    class Equipment
    {
        //Declare variables.
        public $equipmentID;
        public $roomNumber;
        public $code;
        public $duration;
        public $cost;
        public $description;
        
        //Construct class.
        function __construct ($equipment = null)
        {
            $this->equipmentID = (isset($equipment['equipmentID']) ? $equipment['equipmentID'] : null);
            $this->roomNumber = (isset($equipment['roomNumber']) ? $equipment['roomNumber'] : null);
            $this->code = (isset($equipment['code']) ? $equipment['code'] : null);
            $this->duration = (isset($equipment['duration']) ? new DateTime($equipment['duration']) : null);
            $this->cost = (isset($equipment['cost']) ? $equipment['cost'] : null);
            $this->description = (isset($equipment['description']) ? $equipment['description'] : null);
        }
    }
    
    /*
        
    */
    class File
    {
        //Declare variables.
        public $fileID;
        public $patient;
        public $admission;
        public $discharge;
        public $processed;
        public $state;
        public $doctor;
        public $room;
        public $bedNumber;
        public $balance;
        
        //Construct class.
        function __construct ($file = null)
        {
            $this->fileID = (isset($file['fileID']) ? $file['fileID'] : null);
            $this->patient = (isset($file['patient']) ? $file['patient'] : null);
            $this->admission = (isset($file['admission']) ? new DateTime($file['admission']) : null);
            $this->discharge = (isset($file['discharge']) ? new DateTime($file['discharge']) : null);
            $this->state = (isset($file['state']) ? $file['state'] : null);
            $this->doctor = (isset($file['doctor']) ? $file['doctor'] : null);
            $this->room = (isset($file['room']) ? $file['room'] : null);
            $this->bedNumber = (isset($file['bedNumber']) ? $file['bedNumber'] : null);
            $this->balance = (isset($file['balance']) ? $file['balance'] : 0);
        }
    }
    
    /*
        
    */
    class Insurance
    {
        //Declare variables.
        public $insuranceID;
        public $insurer;
        public $policy;
        public $rebate;
        public $maximum;
        
        //Construct class.
        function __construct ($insurance = null)
        {
            $this->insuranceID = (isset($insurance['insuranceID']) ? $insurance['insuranceID'] : null);
            $this->insurer = (isset($insurance['insurer']) ? $insurance['insurer'] : null);
            $this->policy = (isset($insurance['policy']) ? $insurance['policy'] : null);
            $this->rebate = (isset($insurance['rebate']) ? $insurance['rebate'] : null);
            $this->maximum = (isset($insurance['maximum']) ? $insurance['maximum'] : null);
        }
    }
    
    /*
        
    */
    class Note
    {
        //Declare variables.
        public $noteID;
        public $file;
        public $type;
        public $timestamp;
        public $staff;
        public $details;
        
        //Construct class.
        function __construct ($note = null)
        {
            $this->noteID = (isset($note['noteID']) ? $note['noteID'] : null);
            $this->file = (isset($note['file']) ? $note['file'] : null);
            $this->type = (isset($note['type']) ? $note['type'] : null);
            $this->timestamp = (isset($note['timestamp']) ? new DateTime($note['timestamp']) : null);
            $this->staff = (isset($note['staff']) ? $note['staff'] : null);
            $this->details = (isset($note['details']) ? $note['details'] : null);
        }
    }
    
    /*
        
    */
    class Guardian
    {
        //Declare variables.
        public $guardianID;
        public $firstName;
        public $surname;
        public $gender;
        public $mobilePhone;
        public $homePhone;
        public $address;
        
        //Construct class.
        function __construct ($guardian = null)
        {
            $this->guardianID = (isset($guardian['guardianID']) ? $guardian['guardianID'] : null);
            $this->firstName = (isset($guardian['firstName']) ? $guardian['firstName'] : null);
            $this->gender = (isset($guardian['gender']) ? $guardian['gender'] : null);
            $this->mobilePhone = (isset($guardian['mobilePhone']) ? $guardian['mobilePhone'] : null);
            $this->homePhone = (isset($guardian['homePhone']) ? $guardian['homePhone'] : null);
            $this->address = (isset($guardian['address']) ? $guardian['address'] : null);
        }
    }
    
    /*
        
    */
    class Patient
    {
        //Declare variables.
        public $patientID;
        public $file;
        public $identified;
        public $firstName;
        public $surname;
        public $gender;
        public $dateOfBirth;
        public $mobilePhone;
        public $homePhone;
        public $address;
        public $insurance;
        public $guardian;
        
        //Construct class.
        function __construct ($patient = null)
        {
            $this->patientID = (isset($patient['patientID']) ? $patient['patientID'] : null);
            $this->file = (isset($patient['file']) ? $patient['file'] : null);
            $this->identified = (isset($patient['identified']) ? true : false);
            $this->firstName = (isset($patient['firstName']) ? $patient['firstName'] : null);
            $this->surname = (isset($patient['surname']) ? $patient['surname'] : null);
            $this->gender = (isset($patient['gender']) ? $patient['gender'] : null);
            $this->dateOfBirth = (isset($patient['dateOfBirth']) ? new DateTime($patient['dateOfBirth']) : null);
            $this->mobilePhone = (isset($patient['mobilePhone']) ? $patient['mobilePhone'] : null);
            $this->homePhone = (isset($patient['homePhone']) ? $patient['homePhone'] : null);
            $this->address = (isset($patient['address']) ? $patient['address'] : null);
            $this->insurance = (isset($patient['insurance']) ? $patient['insurance'] : null);
            $this->guardian = (isset($patient['guardian']) ? $patient['guardian'] : null);
        }
    }
    
    /*
        
    */
    class Procedure
    {
        //Declare variables.
        public $procedureID;
        public $code;
        public $duration;
        public $surgeons;
        public $required;
        public $description;
        
        //Construct class.
        function __construct ($procedure = null)
        {
            $this->procedureID = (isset($procedure['procedureID']) ? $procedure['procedureID'] : null);
            $this->code = (isset($procedure['code']) ? $procedure['code'] : null);
            $this->duration = (isset($procedure['duration']) ? new DateTime($procedure['duration']) : null);
            $this->surgeons = (isset($procedure['surgeons']) ? $procedure['surgeons'] : null);
            $this->required = (isset($procedure['required']) ? $procedure['required'] : null);
            $this->description = (isset($procedure['description']) ? $procedure['description'] : null);
        }
    }
    
    /*
        
    */
    class Room
    {
        //Declare variables.
        public $roomID;
        public $roomNumber;
        public $ward;
        public $capacity;
        public $occupied;
        
        //Construct class.
        function __construct ($room = null)
        {
            $this->roomID = (isset($room['roomID']) ? $room['roomID'] : null);
            $this->roomNumber = (isset($room['roomNumber']) ? $room['roomNumber'] : null);
            $this->ward = (isset($room['ward']) ? $room['ward'] : null);
            $this->capacity = (isset($room['capacity']) ? $room['capacity'] : null);
            $this->occupied = (isset($room['occupied']) ? $room['occupied'] : null);
        }
    }
    
    /*
        
    */
    class Roster
    {
        //Declare variables.
        public $rosterID;
        public $start;
        public $finish;
        
        //Construct class.
        function __construct ($roster = null)
        {
            $this->rosterID = (isset($roster['rosterID']) ? $roster['rosterID'] : null);
            $this->start = (isset($roster['start']) ? $roster['start'] : null);
            $this->finish = (isset($roster['finish']) ? $roster['finish'] : null);
        }
    }
    
    /*
        
    */
    class Salary
    {
        //Declare variables.
        public $salaryID;
        public $payRate;
        public $nextDate;
        
        //Construct class.
        function __construct ($salary = null)
        {
            $this->salaryID = (isset($salary['salaryID']) ? $salary['salaryID'] : null);
            $this->payRate = (isset($salary['payRate']) ? $salary['payRate'] : null);
            $this->nextDate = (isset($salary['nextDate']) ? new DateTime($salary['nextDate']) : null);
        }
    }
    
    /*
        
    */
    class Staff
    {
        //Declare variables.
        public $staffID;
        public $username;
        public $firstName;
        public $surname;
        public $gender;
        public $dateOfBirth;
        public $mobilePhone;
        public $homePhone;
        public $address;
        public $roster;
        public $salary;
        public $position;
        public $ward;
        public $lastLogin;
        
        //Construct class.
        function __construct ($staff = null)
        {
            $this->staffID = (isset($staff['staffID']) ? $staff['staffID'] : null);
            $this->username = (isset($staff['username']) ? $staff['username'] : null);
            $this->firstName = (isset($staff['firstName']) ? $staff['firstName'] : null);
            $this->surname = (isset($staff['surname']) ? $staff['surname'] : null);
            $this->gender = (isset($staff['gender']) ? $staff['gender'] : null);
            $this->dateOfBirth = (isset($staff['dateOfBirth']) ? new DateTime($staff['dateOfBirth']) : null);
            $this->mobilePhone = (isset($staff['mobilePhone']) ? $staff['mobilePhone'] : null);
            $this->homePhone = (isset($staff['homePhone']) ? $staff['homePhone'] : null);
            $this->address = (isset($staff['address']) ? $staff['address'] : null);
            $this->roster = (isset($staff['roster']) ? $staff['roster'] : null);
            $this->salary = (isset($staff['salary']) ? $staff['salary'] : null);
            $this->position = (isset($staff['position']) ? $staff['position'] : null);
            $this->ward = (isset($staff['ward']) ? $staff['ward'] : null);
            $this->lastLogin = (isset($staff['lastLogin']) ? new DateTime($staff['lastLogin']) : null);
        }
    }
    
    /*
        
    */
    class Theater
    {
        //Declare variables.
        public $theaterID;
        public $roomNumber;
        
        //Construct class.
        function __construct ($theater = null)
        {
            $this->theaterID = (isset($theater['theaterID']) ? $theater['theaterID'] : null);
            $this->roomNumber = (isset($theater['roomNumber']) ? $theater['roomNumber'] : null);
        }
    }
?>