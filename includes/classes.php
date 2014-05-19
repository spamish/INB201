<?php
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
        public $homePhone;
        
        //Construct class.
        function __construct ($address = null)
        {
            $this->addressID = isset($address['addressID']) ? $address['addressID'] : null;
            $this->unit = isset($address['unit']) ? $address['unit'] : null;
            $this->house = isset($address['house']) ? $address['house'] : null;
            $this->street = isset($address['street']) ? $address['street'] : null;
            $this->suburb = isset($address['suburb']) ? $address['suburb'] : null;
            $this->postcode = isset($address['postcode']) ? $address['postcode'] : null;
            $this->region = isset($address['region']) ? $address['region'] : null;
            $this->country = isset($address['country']) ? $address['country'] : null;
            $this->homePhone = isset($address['homePhone']) ? $address['homePhone'] : null;
        }
    }
    
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
    
    class Equipment
    {
        //Declare variables.
        public $equipmentID;
        public $roomNumber;
        public $code;
        public $duration;
        public $description;
        
        //Construct class.
        function __construct ($equipment = null)
        {
            $this->equipmentID = isset($equipment['equipmentID']) ? $equipment['equipmentID'] : null;
            $this->roomNumber = isset($equipment['roomNumber']) ? $equipment['roomNumber'] : null;
            $this->code = isset($equipment['code']) ? $equipment['code'] : null;
            $this->duration = isset($equipment['duration']) ? $equipment['duration'] : null;
            $this->description = isset($equipment['description']) ? $equipment['description'] : null;
        }
    }
    
    class File
    {
        //Declare variables.
        public $fileID;
        public $patient;
        public $admission;
        public $discharge;
        public $state;
        public $staff;
        public $roomNumber;
        public $bedNumber;
        
        //Construct class.
        function __construct ($file = null)
        {
            $this->fileID = isset($file['fileID']) ? $file['fileID'] : null;
            $this->patient = isset($file['patient']) ? $file['patient'] : null;
            $this->admission = isset($file['admission']) ? $file['admission'] : null;
            $this->discharge = isset($file['discharge']) ? $file['discharge'] : null;
            $this->state = isset($file['state']) ? $file['state'] : null;
            $this->staff = isset($file['staff']) ? $file['staff'] : null;
            $this->roomNumber = isset($file['roomNumber']) ? $file['roomNumber'] : null;
            $this->bedNumber = isset($file['bedNumber']) ? $file['bedNumber'] : null;
        }
    }
    
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
            $this->insuranceID = isset($insurance['insuranceID']) ? $insurance['insuranceID'] : null;
            $this->insurer = isset($insurance['insurer']) ? $insurance['insurer'] : null;
            $this->policy = isset($insurance['policy']) ? $insurance['policy'] : null;
            $this->rebate = isset($insurance['rebate']) ? $insurance['rebate'] : null;
            $this->maximum = isset($insurance['maximum']) ? $insurance['maximum'] : null;
        }
    }
    
    class Note
    {
        //Declare variables.
        public $noteID;
        public $fileID;
        public $type;
        public $timestamp;
        public $staff;
        public $details;
        
        //Construct class.
        function __construct ($note = null)
        {
            $this->noteId = isset($note['noteId']) ? $note['noteId'] : null;
            $this->fileID = isset($note['fileID']) ? $note['fileID'] : null;
            $this->type = isset($note['type']) ? $note['type'] : null;
            $this->timestamp = isset($note['timestamp']) ? $note['timestamp'] : null;
            $this->staff = isset($note['staff']) ? $note['staff'] : null;
            $this->details = isset($note['details']) ? $note['details'] : null;
        }
    }
    
    class ParentGuardian
    {
        //Declare variables.
        public $parentID;
        public $patient;
        public $firstName;
        public $surname;
        public $mobilePhone;
        public $homePhone;
        
        //Construct class.
        function __construct ($parentGuardian = null)
        {
            $this->parentID = isset($parentGuardian['parentID']) ? $parentGuardian['parentID'] : null;
            $this->patient = isset($parentGuardian['patient']) ? $parentGuardian['patient'] : null;
            $this->firstName = isset($parentGuardian['firstName']) ? $parentGuardian['firstName'] : null;
            $this->surname = isset($parentGuardian['surname']) ? $parentGuardian['surname'] : null;
            $this->mobilePhone = isset($parentGuardian['mobilePhone']) ? $parentGuardian['mobilePhone'] : null;
            $this->homePhone = isset($parentGuardian['homePhone']) ? $parentGuardian['homePhone'] : null;
        }
    }
    
    class Patient
    {
        //Declare variables.
        public $patientID;
        public $firstName;
        public $surname;
        public $gender;
        public $dateOfBirth;
        public $mobilePhone;
        public $address;
        public $insurance;
        
        //Construct class.
        function __construct ($patient = null)
        {
            $this->patientID = isset($patient['patientID']) ? $patient['patientID'] : null;
            $this->firstName = isset($patient['firstName']) ? $patient['firstName'] : null;
            $this->surname = isset($patient['surname']) ? $patient['surname'] : null;
            $this->gender = isset($patient['gender']) ? $patient['gender'] : null;
            $this->dateOfBirth = isset($patient['dateOfBirth']) ? $patient['dateOfBirth'] : null;
            $this->mobilePhone = isset($patient['mobilePhone']) ? $patient['mobilePhone'] : null;
            $this->address = isset($patient['address']) ? $patient['address'] : null;
            $this->insurance = isset($patient['insurance']) ? $patient['insurance'] : null;
        }
    }
    
    class Procedure
    {
        //Declare variables.
        public $procedureID;
        public $code;
        public $duration;
        public $capableSurgeons;
        public $surgeonsRequired;
        public $description;
        
        //Construct class.
        function __construct ($procedure = null)
        {
            $this->procedureID = isset($procedure['procedureID']) ? $procedure['procedureID'] : null;
            $this->code = isset($procedure['code']) ? $procedure['code'] : null;
            $this->duration = isset($procedure['duration']) ? $procedure['duration'] : null;
            $this->capableSurgeons = isset($procedure['capableSurgeons']) ? $procedure['capableSurgeons'] : null;
            $this->surgeonsRequired = isset($procedure['surgeonsRequired']) ? $procedure['surgeonsRequired'] : null;
            $this->description = isset($procedure['description']) ? $procedure['description'] : null;
        }
    }
    
    class Room
    {
        //Declare variables.
        public $roomID;
        public $roomNumber;
        public $ward;
        public $roomCapacity;
        public $occupiedBeds;
        
        //Construct class.
        function __construct ($room = null)
        {
            $this->roomID = isset($room['roomID']) ? $room['roomID'] : null;
            $this->roomNumber = isset($room['roomNumber']) ? $room['roomNumber'] : null;
            $this->ward = isset($room['ward']) ? $room['ward'] : null;
            $this->roomCapacity = isset($room['roomCapacity']) ? $room['roomCapacity'] : null;
            $this->occupiedBeds = isset($room['occupiedBeds']) ? $room['occupiedBeds'] : null;
        }
    }
    
    class Roster
    {
        //Declare variables.
        public $rosterID;
        public $start;
        public $finish;
        
        //Construct class.
        function __construct ($roster = null)
        {
            $this->rosterID = isset($roster['rosterID']) ? $roster['rosterID'] : null;
            $this->start = isset($roster['start']) ? $roster['start'] : null;
            $this->finish = isset($roster['finish']) ? $roster['finish'] : null;
        }
    }
    
    class Salary
    {
        //Declare variables.
        public $salaryID;
        public $payRate;
        public $nextDate;
        
        //Construct class.
        function __construct ($salary = null)
        {
            $this->salaryID = isset($salary['salaryID']) ? $salary['salaryID'] : null;
            $this->payRate = isset($salary['payRate']) ? $salary['payRate'] : null;
            $this->nextDate = isset($salary['nextDate']) ? $salary['nextDate'] : null;
        }
    }
    
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
        public $address;
        public $roster;
        public $salary;
        public $position;
        public $ward;
        public $lastLogin;
        
        //Construct class.
        function __construct ($staff = null)
        {
            $this->staffID = isset($staff['staffID']) ? $staff['staffID'] : null;
            $this->username = isset($staff['username']) ? $staff['username'] : null;
            $this->firstName = isset($staff['firstName']) ? $staff['firstName'] : null;
            $this->surname = isset($staff['surname']) ? $staff['surname'] : null;
            $this->gender = isset($staff['gender']) ? $staff['gender'] : null;
            $this->dateOfBirth = isset($staff['dateOfBirth']) ? $staff['dateOfBirth'] : null;
            $this->mobilePhone = isset($staff['mobilePhone']) ? $staff['mobilePhone'] : null;
            $this->address = isset($staff['address']) ? $staff['address'] : null;
            $this->roster = isset($staff['roster']) ? $staff['roster'] : null;
            $this->salary = isset($staff['salary']) ? $staff['salary'] : null;
            $this->position = isset($staff['position']) ? $staff['position'] : null;
            $this->ward = isset($staff['ward']) ? $staff['ward'] : null;
            $this->lastLogin = isset($staff['lastLogin']) ? $staff['lastLogin'] : null;
        }
    }
    
    class Theater
    {
        //Declare variables.
        public $theaterID;
        public $roomNumber;
        
        //Construct class.
        function __construct ($theater = null)
        {
            $this->theaterID = isset($theater['theaterID']) ? $theater['theaterID'] : null;
            $this->roomNumber = isset($theater['roomNumber']) ? $theater['roomNumber'] : null;
        }
    }
    
    class Unidentified
    {
        //Declare variables.
        public $caseID;
        public $firstName;
        public $surname;
        public $gender;
        
        //Construct class.
        function __construct ($unidentified = null)
        {
            $this->caseID = isset($unidentified['caseID']) ? $unidentified['caseID'] : null;
            $this->firstName = isset($unidentified['firstName']) ? $unidentified['firstName'] : null;
            $this->surname = isset($unidentified['surname']) ? $unidentified['surname'] : null;
            $this->gender = isset($unidentified['gender']) ? $unidentified['gender'] : null;
        }
    }
?>