<?php
/**
 * Arquivo de declara��o da classe Item
 * @package modelo
 * @author Jos� Berardo
 * @since 1.0
 */

/**
 * Composi��o dos dados dos itens adicionados
 * aos carrinhos de compra
 * 
 * @package modelo
 * @access public
 */
class Item {
  // atributos de inst�ncia de Item
  /**
   * Produto adicionado
   * @access private
   * @var Produto
   */
  private $produto;
  /**
   * Quantidade adicionada
   * @access private
   * @var double
   */
  private $quantidade;
  /**
   * Preco unit�rio do item.
   * O item possui seu pre�o unit�rio independente
   * do pre�o definido no objeto Produto para possibilitar
   * descontos para determinados itens e registros
   * hist�ricos j� que um cliente comprar� um produto pelo
   * pre�o X, se o produto for remarcado para o pre�o Y,
   * fica registrado que quando ele foi item do carrinho
   * de compras do cliente Fulano, ele custou X.
   * @access private
   * @var double
   */
  private $precoUnitario;
  // ------------ ### ------------- //

  // m�todos construtores e destrutores
  /**
   * Construtor do Item.
   * Todos os par�metros s�o opcionais. S�o utilizados para
   * carregar todo o estado do Item no momento da inst�ncia.
   * @access public
   * @param Produto $produto
   * @param double $quantidade
   * @param double $precoUnitario
   */
  public function __construct($produto = "", $quantidade = "", $precoUnitario = "") {
    $this->quantidade    = $quantidade;
    $this->precoUnitario = $precoUnitario;
    if ($produto instanceof Produto) {
      $this->produto     = $produto;
      if ($quantidade == "") {
        $this->quantidade = 1;
      }
      if ($precoUnitario == "") {
        $this->precoUnitario = $produto->getPreco();
      }
    }
  }
  // ------------ ### ------------- //

  // demais m�todos de neg�cio
  /**
   * M�todo para calcular o pre�o do item.
   * Multiplicar� o pre�o unit�rio pela quantidade
   * @access public
   * @return double
   */
  public function calcularPreco() {
    return $this->getPrecoUnitario() * $this->getQuantidade();
  }
  // ------------ ### ------------- //

  // m�todos getters e setters
  /**
   * Recupera o valor de <var>$this->produto</var>
   * 
   * @access public
   * @return string
   */
  public function getProduto() {
    return $this->produto;
  }
  /**
   * Define um valor para <var>$this->produto</var>
   * 
   * @access public
   * @param Produto $produto
   */
  public function setProduto(Produto $produto) {
    $this->produto = $produto;
  }
  /**
   * Recupera o valor de <var>$this->quantidade</var>
   * 
   * @access public
   * @return double
   */
  public function getQuantidade() {
    return $this->quantidade;
  }
  /**
   * Define um valor para <var>$this->quantidade</var>
   * 
   * @access public
   * @param double $quantidade
   */
  public function setQuantidade($quantidade) {
    $this->quantidade = $quantidade;
  }
  /**
   * Recupera o valor de <var>$this->precoUnitario</var>
   * 
   * @access public
   * @return double
   */
  public function getPrecoUnitario() {
    return $this->precoUnitario;
  }
  /**
   * Define um valor para <var>$this->precoUnitario</var>
   * 
   * @access public
   * @param double $precoUnitario
   */
  public function setPrecoUnitario($precoUnitario) {
    $this->precoUnitario = $precoUnitario;
  }
  // ------------ ### ------------- //
}
?>