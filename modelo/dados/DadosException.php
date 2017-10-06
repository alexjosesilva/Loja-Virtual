<?php
/**
 * Arquivo PHP que declara a exce��o DadosException
 * @package modelo
 * @subpackage dados
 * @author Jos� Berardo
 * @since 1.0
 */

/**
 * Classe de exce��o DadosException.
 * Utilizada sempre que houver problemas no
 * acesso ao mecanismo de persist�ncia de dados.
 * @package modelo
 * @subpackage dados
 * @access public
 */
class DadosException extends Exception {
  
  /**
   * Exce��o que foi causa do problema no acesso aos dados
   *
   * @var Exception
   */
  private $causa;
  
  /**
   * Construtor da exce��o.
   * Invocar� o construtor de Exception
   * @param Exception $causa
   * @access public
   */
  public function __construct(Exception $causa) {
    $this->causa = $causa;
    parent::__construct("Problemas no acesso aos dados!",
                        $causa->getCode());
  }
  
  public function getCausa() {
  	return $this->causa;
  }
}

?>