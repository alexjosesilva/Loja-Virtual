<?php
/**
 * Arquivo de declara��o da classe Cliente
 * @package modelo
 * @author Jos� Berardo
 * @since 1.0
 */

/**
 * Clientes da Loja
 * 
 * @package modelo
 * @access public
 */
class Cliente extends Agente {
  // atributos de inst�ncia de Cliente
  /**
   * Cole��o de compras do Cliente
   * @access private
   * @var array
   */
  private $compras;
  // ------------ ### ------------- //

  // m�todos construtores e destrutores
  /**
   * Construtor do Cliente.
   * Par�metros s�o utilizados para carregar
   * todo o estado do Cliente no momento da inst�ncia.
   * Far� uma chamada expl�cita ao construtor de Agente
   * @access public
   * @param Pessoa $pessoa �nico campo obrigat�rio
   * @param int $dataCadastro Timestamp de cadastro
   * @param Compra $compra Uma primeira compra j� sugerida
   */
  public function __construct($pessoa, $dataCadastro = "", $compra = "") {
    parent::__construct($pessoa, $dataCadastro);

    $this->compra = array();
    if ($compra != "") {
      $this->adicionarCompra($compra);
    }
  }
  // ------------ ### ------------- //
  
  // demais m�todos de neg�cio
  /**
   * M�todo que adiciona compras ao Cliente.
   * Determina o objeto corrente ($this) como
   * Cliente da $compra passada.
   * @access public
   * @param Compra $compra Compra a ser adicionada
   * @see Compra::setCliente()
   */
  public function adicionarCompra(Compra $compra) {
    $compra->setCliente($this);
    $this->compras[] = $compra;
  }
  // ------------ ### ------------- //
  
  // m�todos getters e setters
  /**
   * Recupera o valor de <var>$this->compras</var>
   * 
   * @access public
   * @return array Lista de compras
   */
  public function getCompras() {
    return $this->compras;
  }
  /**
   * Define um valor para <var>$this->compras</var>
   * 
   * @access public
   * @param array $compras lista de compras
   * @see Compra
   */
  public function setCompras($compras) {
    $this->compras = $compras;
  }
  // ------------ ### ------------- //
}
?>