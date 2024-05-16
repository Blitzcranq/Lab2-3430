<?php
class Contact
{
  // Properties
  private string $name;
  private string $email;
  private string $phoneType;
  private string $phone;
  private string $contactType;

  public function __construct(string $name = "test", string $email = "", string $phoneType = "", string $area = "", string $phone = "", string $ext = "", array $contactType = array())
  {
    #############################
    #Complete the contructor here
    #############################
    $this->name = $name;
    $this->email = $email;
    $this->phoneType = $phoneType;
    if (!empty($area) && !empty($phone)) {
      $this->phone = "($area) $phone";
    } else {
      $this->phone = "";
    }
    if (!empty($ext)) {
      $this->phone .= ",$ext";
    }
    $this->contactType = implode(",", $contactType);
    // foreach ($contactType as $type) {
    //   $this->contactType.=$type;
    // }
  }

  // Get Methods
  function get_name()
  {
    return $this->name;
  }
  function get_email()
  {
    return $this->email;
  }
  function get_phoneType()
  {
    return $this->phoneType;
  }
  function get_phone()
  {
    return $this->phone;
  }
  function get_contactType()
  {
    return $this->contactType;
  }
}
