<?php
namespace User\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="User\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;  
	 
	/**
	* @ORM\Column(name="name", type="string", length=256, nullable=false)
	*/
	protected $name;

	/**
	* @ORM\Column(name="firstName", type="string", length=256, nullable=false)
	*/
	protected $firstName;
	   
	/**
	* @ORM\Column(name="address", type="string", length=1024, nullable=false)
	*/
	protected $address;
	/**
	* @ORM\Column(name="areaCode", type="string", length=5, nullable=false)
	*/
	protected $areaCode;

	/**
	* @ORM\Column(name="city", type="string", length=256, nullable=false)
	*/
	protected $city;

    /**
    * @ORM\Column(name="country", type="string", length=256, nullable=false)
    */
    protected $country;
    
	/**
	* @ORM\Column(name="phone", type="string", length=10, nullable=false)
	*/
	protected $phone;

    /**
     * @ORM\OneToMany(targetEntity="Core\CoreBundle\Entity\Folder", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $documents;

	public function __construct()
	{
		parent::__construct();
        $this->documents = new \Doctrine\Common\Collections\ArrayCollection();
	}

	public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getAreaCode()
    {
        return $this->areaCode;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getCountry()
    {
    	return $this->country;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setFisrtName($firstName)
    {
        $this->fisrtName = $fisrtName;

        return $this;
    }

    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    public function setAreaCode($areaCode)
    {
        $this->areaCode = $areaCode;

        return $this;
    }

    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Add doc
     *
     * @param \Core\CoreBundle\Entity\Folder $doc
     * @return User
     */
    public function addDocuments(\Core\CoreBundle\Entity\Folder $doc)
    {
        $this->documents[] = $doc;

        return $this;
    }

    /**
     * Remove doc
     *
     * @param \Core\CoreBundle\Entity\Folder $doc
     */
    public function removeDocuments(\Core\CoreBundle\Entity\Folder $doc)
    {
        $this->documents->removeElement($doc);
    }

    /**
     * Get documents
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * Add documents
     *
     * @param \Core\CoreBundle\Entity\Folder $documents
     * @return User
     */
    public function addDocument(\Core\CoreBundle\Entity\Folder $documents)
    {
        $this->documents[] = $documents;

        return $this;
    }

    /**
     * Remove documents
     *
     * @param \Core\CoreBundle\Entity\Folder $documents
     */
    public function removeDocument(\Core\CoreBundle\Entity\Folder $documents)
    {
        $this->documents->removeElement($documents);
    }
}
