<?php
/**
 * Arquivo de declara��o da classe Compra
 * @package modelo
 * @author Jos� Berardo
 * @since 1.0
 */

/**
 * Compras dos clientes
 * 
 * @package modelo
 * @access public
 */
class Compra {
  // atributos de inst�ncia de Compra
  /**
   * Identificador da compra
   * @access private
   * @var int
   */
  private $id;
  /**
   * Cliente que comprou
   * @access private
   * @var Cliente
   */
  private $cliente;
  /**
   * Carrinho utilizado na compra
   * @access private
   * @var Carrinho
   */
  private $carrinho;
  /**
   * Endere�o do cliente definido para entrega
   * @access private
   * @var Endereco
   */
  private $enderecoEntrega;
  /**
   * Timestamp do momento da compra
   * @access private
   * @var int
   */
  private $data;
  // ------------ ### ------------- //

  // m�todos construtores e destrutores
  /**
   * Construtor da Compra.
   * Par�metros s�o utilizados para carregar
   * todo o estado da Compra no momento da inst�ncia.
   * @access public
   * @param Carrinho $carrinho �nico campo obrigat�rio
   * @param int $id Identificador da compra
   * @param Cliente $cliente Cliente que comprou
   * @param Endereco $enderecoEntrega Endere�o de entrega
   * @param int $data Timestamp do momento da compra
   */
  public function __construct($carrinho, $id = "", $cliente = "",
                              $enderecoEntrega = "", $data = "") {
    $this->carrinho        = $carrinho;

    $this->id              = $id;
    $this->cliente         = $cliente;
    $this->enderecoEntrega = $enderecoEntrega;
    $this->data            = $data;
  }
  // ------------ ### ------------- //
  
  // demais m�todos de neg�cio
  /**
   * M�todo que delega ao objeto carrinho
   * @access public
   * @see Carrinho::calcularTotal()
   */
  public function calcularTotal() {
    return $this->carrinho->calcularTotal();
  }
  // ------------ ### ------------- //
  
  // m�todos getters e setters
  /**
   * Recupera o valor de <var>$this->id</var>
   * 
   * @access public
   * @return int
   */
  public function getId() {
    return $this->id;
  }
  /**
   * Define um valor para <var>$this->id</var>
   * 
   * @access public
   * @param int $id
   */
  public function setId($id) {
    $this->id = $id;
  }
  /**
   * Recupera o valor de <var>$this->cliente</var>
   * 
   * @access public
   * @return Cliente
   */
  public function getCliente() {
    return $this->cliente;
  }
  /**
   * Define um valor para <var>$this->cliente</var>
   * 
   * @access public
   * @param Cliente $cliente
   */
  public function setCliente(Cliente $cliente) {
    $this->cliente = $cliente;
  }
  /**
   * Recupera o valor de <var>$this->carrinho</var>
   * 
   * @access public
   * @return Carrinho
   */
  public function getCarrinho() {
    return $this->carrinho;
  }
  /**
   * Define um valor para <var>$this->carrinho</var>
   * 
   * @access public
   * @param Carrinho $carrinho
   */
  public function setCarrinho($carrinho) {
    $this->carrinho = $carrinho;
  }
  /**
   * Recupera o valor de <var>$this->enderecoEntrega</var>
   * 
   * @access public
   * @return Endereco
   */
  public function getEnderecoEntrega() {
    return $this->enderecoEntrega;
  }
  /**
   * Define um valor para <var>$this->enderecoEntrega</var>
   * 
   * @access public
   * @param Endereco $enderecoEntrega
   */
  public function setEnderecoEntrega($enderecoEntrega) {
    $this->enderecoEntrega = $enderecoEntrega;
  }
  /**
   * Recupera o valor de <var>$this->data</var>
   * 
   * @access public
   * @return int Timestamp
   */
  public function getData() {
    return $this->data;
  }
  /**
   * Define um valor para <var>$this->data</var>
   * 
   * @access public
   * @param int $data timestamp
   */
  public function setData($data) {
    $this->data = $data;
  }
  // ------------ ### ------------- //
}
?>