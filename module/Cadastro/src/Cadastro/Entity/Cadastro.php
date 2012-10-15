<?php
namespace Cadastro\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* Entity Class representing an Cadastro
*
* @ORM\Entity
* @ORM\Table(name="users")
* @property int $id
* @property string $name
* @property string $motto
*/
class Cadastro
{
  /**
* Primary Identifier
*
* @ORM\Id
* @ORM\Column(type="integer")
* @ORM\GeneratedValue(strategy="AUTO")
* @var integer
* @access protected
*/
  protected $id;

  /**
* Name of Cadastro
*
* @ORM\Column(type="string")
* @var string
* @access protected
*/
  protected $name;

  /**
* Motto of Cadastro
*
* @ORM\Column(type="text")
* @var string
* @access protected
*/
  protected $motto;

  /**
* Sets the Identifier
*
* @param int $id
* @access public
* @return Cadastro
*/
  public function setId($id)
  {
    $this->id = $id;
    return $this;
  }

  /**
* Returns the Identifier
*
* @access public
* @return int
*/
  public function getId()
  {
    return $this->id;
  }

  /**
* Sets Name
*
* @param string $name
* @access public
* @return Cadastro
*/
  public function setName($name)
  {
    $this->name = $name;
    return $this;
  }

  /**
* Returns Name
*
* @access public
* @return string
*/
  public function getName()
  {
    return $this->name;
  }

  /**
* Sets the Motto
*
* @param string $motto
* @access public
* @return Cadastro
*/
  public function setMotto($motto)
  {
    $this->motto = $motto;
    return $this;
  }

  /**
* Returns the Motto
*
* @access public
* @return string
*/
  public function getMotto()
  {
    return $this->motto;
  }
}