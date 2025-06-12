<?php
class Persona {
    private $nombre, $email, $empleo, $titulacion, $comentario, $imagen;

    public function __construct($nombre, $email, $empleo, $titulacion, $comentario, $imagen) {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->empleo = $empleo;
        $this->titulacion = $titulacion;
        $this->comentario = $comentario;
        $this->imagen = $imagen;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getEmpleo() {
        return $this->empleo;
    }

    public function getTitulacion() {
        return $this->titulacion;
    }

    public function getComentario() {
        return $this->comentario;
    }

    public function getImagen() {
        return $this->imagen;
    }
}
?>
