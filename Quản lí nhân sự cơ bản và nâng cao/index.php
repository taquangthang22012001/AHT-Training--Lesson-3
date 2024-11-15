<?php
 class Person {
    private $firstName;
    private $lastName;
    private $dateOfBirth;
    private $address;

    public function __construct($firstName,$lastName,$dateOfBirth, $address){
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dateOfBirth = $dateOfBirth;
        $this->address = $address;

    }
    
    public function getFirstName(){
        return $this->firstName;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function getDateOfBirth() {
        return $this->dateOfBirth;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function setDateOfBirth($dateOfBirth) {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function setAddress($address) {
        $this->address = $address;
    }
}

class Employee extends Person {
    private $jobPosition;
    protected $salary;

    public function __construct($firstName, $lastName, $dateOfBirth, $address, $jobPosition, $salary) {
        parent::__construct($firstName, $lastName, $dateOfBirth, $address);
        $this->jobPosition = $jobPosition;
        $this->salary = $salary;
    }

    public function getJobPosition($jobPosition) {
        $this->jobPosition = $jobPosition;
    }

    public function getSalary($salary) {
        $this->salary = $salary;
    }

    public function toArray() {
        return [
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'dateOfBirth' => $this->getDateOfBirth(),
            'address' => $this->getAddress(),
            'jobPosition' => $this->jobPosition,
            'salary' => $this->salary
        ];
    }

    public static function fromArray($data) {
        return new Employee(
            $data['firstName'],
            $data['lastName'],
            $data['dateOfBirth'],
            $data['address'],
            $data['jobPosition'],
            $data['salary']
        );
    }
}

class EmployeeManager {
    private $employees = [];

    public function addEmployee($employee) {

        if ($employee instanceof Employee || $employee instanceof Manager || $employee instanceof Contractor) {
            $this->employees[] = $employee;
            $this->saveToFile('employees.json'); // Lưu dữ liệu sau thay đổi
        } else {
            throw new Exception("Thêm không hợp lệ: Phải là một đối tượng Employee, Manager hoặc Contractor.");
        }
    }

    public function displayEmployeeList() {
        foreach ($this->employees as $index => $employee) {
            echo "Employee #" . ($index + 1) . ": " . $employee->getFirstName() . " " . $employee->getLastName();
            // Hiển thị loại đối tượng
            if ($employee instanceof Manager) {
                echo " (Manager)";
            } elseif ($employee instanceof Contractor) {
                echo " (Contractor)";
            } else {
                echo " (Employee)";
            }
            echo "\n";
        }
    }

    public function getEmployeeDetails($index) {
        if (isset($this->employees[$index])) {
            $employee = $this->employees[$index];
            return $employee->toArray();
        } else {
            return null;
        }
    }

    // Lưu dữ liệu vào file JSON
    public function saveToFile($filename) {
        $data = array_map(function($employee) {
            return $employee->toArray();
        }, $this->employees);

        file_put_contents($filename, json_encode($data,JSON_PRETTY_PRINT));
    }

    // Tải dữ liệu từ file JSON
    public function removeEmployee($index) {
        if (isset($this->employees[$index])) {
            unset($this->employees[$index]);
            $this->employees = array_values($this->employees);
            $this->saveToFile('employees.json'); // Lưu dữ liệu sau khi thay đổi
        } else {
            echo "Nhân viên không tồn tại.\n";
        }
    }
}

class Manager extends Employee {
    private $team = [];
    public function __construct($firstName, $lastName, $dateOfBirth, $address, $jobPosition, $salary)
    {
        parent::__construct($firstName, $lastName, $dateOfBirth, $address, $jobPosition, $salary);
    }

    public function addTeamMember($employee) {
        if ($employee instanceof Employee) {
            $this->team[] = $employee;
        } else {
            throw new Exception("Thành viên nhóm phải là một trường hợp của Nhân viên.");
        }
    }

     public function removeTeamMember($index) {
        if (isset($this->team[$index])) {
            unset($this->team[$index]);
            $this->team = array_values($this->team);
        } else {
            echo "Team member not found.\n";
        }
    }

     public function displayTeam() {
        foreach ($this->team as $index => $member) {
            echo ($index + 1) . ". " . $member->getFirstName() . " " . $member->getLastName() . "\n";
        }
    }

    public function toArray() {
        $parentArray = parent::toArray();
        $parentArray['team'] = array_map(function ($member) {
            return $member->toArray();
        }, $this->team);
        return $parentArray;
    }

    public static function fromArray($data) {
        $manager = new self(
            $data['firstName'],
            $data['lastName'],
            $data['dateOfBirth'],
            $data['address'],
            $data['jobPosition'],
            $data['salary']
        );

        foreach ($data['team'] as $memberData) {
            $manager->addTeamMember(Employee::fromArray($memberData));
        }

        return $manager;
    }
}

class Contractor extends Person {
    private $contractPeriod;
    private $hourlyRate;

    public function __construct($firstName, $lastName, $dateOfBirth, $address, $contractPeriod, $hourlyRate) {
        parent::__construct($firstName, $lastName, $dateOfBirth, $address);
        $this->contractPeriod = $contractPeriod;
        $this->hourlyRate = $hourlyRate;
    }

    public function getContractPeriod() {
        return $this->contractPeriod;
    }

    public function setContractPeriod($contractPeriod) {
        $this->contractPeriod = $contractPeriod;
    }

    public function getHourlyRate() {
        return $this->hourlyRate;
    }

    public function setHourlyRate($hourlyRate) {
        $this->hourlyRate = $hourlyRate;
    }

}










