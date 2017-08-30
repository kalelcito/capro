<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CoreBundle\Entity\PImagenes
 *
 * @ORM\Entity()
 * @ORM\Table(name="p_imagenes", indexes={@ORM\Index(name="fk_p_imagenes_proyectos_idx", columns={"proyectos_id"})})
 */
class PImagenes
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\File(mimeTypes={ "image/jpg" , "image/jpeg" , "image/gif" , "image/png"})
     *
     * @ORM\Column(type="string", length=300, nullable=true)
     */
    protected $imagen;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $color_avg;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $principal;

    /**
     * @Gedmo\Timestampable(on="create", field="creado")
     *
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @Gedmo\Timestampable(on="update", field="actualizado")
     *
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity="Proyectos", inversedBy="pImagenes")
     * @ORM\JoinColumn(name="proyectos_id", referencedColumnName="id", nullable=false)
     */
    protected $proyectos;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\PImagenes
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of imagen.
     *
     * @param string $imagen
     * @return \CoreBundle\Entity\PImagenes
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get the value of imagen.
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of color_avg.
     *
     * @param string $color_avg
     * @return \CoreBundle\Entity\PImagenes
     */
    public function setColorAvg($color_avg)
    {
        $this->color_avg = $color_avg;

        return $this;
    }

    /**
     * Get the value of color_avg.
     *
     * @return string
     */
    public function getColorAvg()
    {
        return $this->color_avg;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\PImagenes
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get the value of activo.
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set the value of principal.
     *
     * @param boolean $principal
     * @return \CoreBundle\Entity\PImagenes
     */
    public function setPrincipal($principal)
    {
        $this->principal = $principal;

        return $this;
    }

    /**
     * Get the value of principal.
     *
     * @return boolean
     */
    public function getPrincipal()
    {
        return $this->principal;
    }

    /**
     * Set the value of created_at.
     *
     * @param \DateTime $created_at
     * @return \CoreBundle\Entity\PImagenes
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of created_at.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of updated_at.
     *
     * @param \DateTime $updated_at
     * @return \CoreBundle\Entity\PImagenes
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get the value of updated_at.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set Proyectos entity (many to one).
     *
     * @param \CoreBundle\Entity\Proyectos $proyectos
     * @return \CoreBundle\Entity\PImagenes
     */
    public function setProyectos(Proyectos $proyectos = null)
    {
        $this->proyectos = $proyectos;

        return $this;
    }

    /**
     * Get Proyectos entity (many to one).
     *
     * @return \CoreBundle\Entity\Proyectos
     */
    public function getProyectos()
    {
        return $this->proyectos;
    }

    public function __sleep()
    {
        return array('id', 'proyectos_id', 'imagen', 'color_avg', 'activo', 'principal', 'created_at', 'updated_at');
    }
}