<?
/**
 * Arquivo de declara��o da classe Carrinho
 * @package modelo
 * @author Jos� Berardo
 * @since 1.0
 */

/**
 * Objeto facilitador do processo de escolha dos produtos para compras
 * 
 * Ser� manipulado durante toda a sess�o do usu�rio
 * 
 * @package modelo
 * @access public
 * @see Compra
 */
class Carrinho {
  // vari�veis de classe
  /**
   * Inst�ncia �nica do Carrinho.
   * Implementa��o do padr�o de projeto Singleton
   * @static
   * @access private
   * @var Carrinho
   */
  private static $instancia;
  // ------------ ### ------------- //

  // atributos de inst�ncia de Carrinho
  /**
   * Identificador manipulado pela SESSION.
   * Hash MD5 correspondente ao PHPSESSID
   * @access private
   * @var string
   */
  private $identificador;
  /**
   * Array de �tens adicionados ao Carrinho
   * @access private
   * @var array
   * @see Item
   */
  private $itens;
  // ------------ ### ------------- //

  // m�todos construtores e destrutores
  /**
   * M�todo de cria��o de objetos carrinho.
   * Estens�o do padr�o de projeto criacional 
   * [GoF] Singleton.
   * O Carrinho n�o ser� �nico por requisi��o do Cliente,
   * mas por sess�o, assim, se o carrinho n�o estiver
   * carregado, mas salvo na sess�o, este ser� retornado
   * no lugar da cria��o de um novo.
   * 
   * @access public
   * @static 
   * @see Carrinho::$instancia
   * @return Carrinho Carrinho �nico por toda sess�o do usu�rio
   */
  public static function getCarrinhoAtual() {
    if (!isset(Carrinho::$instancia)) {
      Carrinho::$instancia = (isset($_SESSION['carrinho'])) ?
                             $_SESSION['carrinho'] : new Carrinho();
    }
    return Carrinho::$instancia;
  }
  /**
   * Construtor privado do Carrinho.
   * Carrinhos s� s�o criados atrav�s de
   * <code>Carrinho::getCarrinhoAtual()</code>.
   * Inicia o <code>$this->identificador</code>
   * com a session_id() e <code>$this->itens</code>
   * com um novo array
   * @access private
   * @link http://www.php.net/manual/pt_BR/function.session-id.php
   */
  private function __construct() {
    $this->setIdentificador(session_id());
	$this->itens = array();
  }
  /**
   * Destrutor do Carrinho.
   * Ao final do script, antes da inst�ncia (�nica)
   * do carrinho ser apagada, ele ser� serializado
   * e salvo na sess�o.
   * @access public
   */
  public function __destruct() {
    $_SESSION['carrinho'] = Carrinho::$instancia;
  }
  // ------------ ### ------------- //
  
  // demais m�todos de neg�cio
  /**
   * M�todo que recupera o custo total do Carrinho.
   * Recupera e soma o resultado do calculo do 
   * custo de cada item do carrinho.
   * @access public
   * @see Item::calcularPreco()
   */
  public function calcularTotal() {
    $total = 0;
	foreach ($this->itens as $item) {
	  $total += $item->calcularPreco();
	}
    return $total;
  }
  /**
   * M�todo que adiciona itens ao Carrinho.
   * Se o item ainda n�o existir, ser� adicionado.
   * Se j� existir, sua quantidade ser� incrementada.
   *
   * @access public
   * @param Produto $produto
   */
  public function adicionarProduto(Produto $produto) {
    $item_encontrado = $this->pesquisarItem($produto->getId());
    // adicionar se ele n�o estiver adicionado
    if (!$item_encontrado) {
      $item = new Item($produto, 1, $produto->getPreco());
      $this->itens[] = $item;
    // somar a quantidade se o item j� estiver adicionado
    } else {
      $quantidade = $item_encontrado->getQuantidade();
      $item_encontrado->setQuantidade(++$quantidade);
    }
  }
  /**
   * M�todo privado para auxiliar na busca pelo item.
   * Retorna o Item ou false se n�o existir.
   *
   * @access private
   * @param int $id Identficador do Produto
   * @see Item
   * @return Item|boolean Item encontrado ou false
   */
  private function pesquisarItem($id) {
    foreach ($this->itens as $item) {
      if ($item->getProduto()->getId() == $id) {
        return $item;
      }
    }
    return false;
  }
  /**
   * M�todo para remover um item do Carrinho
   *
   * @access public
   * @param int $id Identificador do Produto
   * @link http://www.php.net/manual/pt_BR/function.array-splice.php
   */
  public function removerProduto($id) {
    for ($x = 0; $x < count($this->itens); $x++) {
      if ($this->itens[$x]->getProduto()->getId() == $id){
        break;
      }
    }
    array_splice($this->itens, $x, 1);
  }
  /**
   * M�todo para recalcular o conte�do do Carrinho.
   * Os �tens com $novaQuantidade zero,
   * ser�o exclu�dos.
   * 
   * @access public
   * @param array $itens array de Ids de Produto
   * @param array $novasQuantidades array de quantidades
   */
  public function recalcular($itens, $novasQuantidades) {
    for ($x = 0; $x < count($itens); $x++) {
      $item_encontrado = $this->pesquisarItem($itens[$x]);
	  if ($item_encontrado) {
        if ($novasQuantidades[$x] > 0) {
          $item_encontrado->setQuantidade($novasQuantidades[$x]);
        } else {
          $this->removerProduto($item_encontrado->getProduto()->getId());
        }
      }
    }
  }
  // ------------ ### ------------- //
  
  // m�todos getters e setters
  /**
   * Recupera o valor de <var>$this->identificador</var>
   * 
   * @access public
   * @return string Identificador do carrinho na sess�o
   */
  public function getIdentificador() {
    return $this->identificador;
  }

  /**
   * Define um valor para <var>$this->identificador</var>
   * 
   * @access public
   * @param string $identificador
   */
  public function setIdentificador($identificador) {
    $this->identificador = $identificador;
  }

  /**
   * Recupera o valor de <var>$this->itens</var>
   * 
   * @access public
   * @see Item
   * @return array Array de itens
   * @throws ListaVazia
   */
  public function getItens() {
    if (count($this->itens) == 0) {
      throw new ListaVazia(ListaVazia::ITENS);
    }
    return $this->itens;
        }

  /**
   * Define um valor para <var>$this->itens</var>
   * 
   * @access public
   * @param array $itens
   * @see Item
   */
  public function setItens($itens) {
    $this->itens = $itens;
  }
  // ------------ ### ------------- //
}
?>