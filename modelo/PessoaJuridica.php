<?php
/**
 * Arquivo de declara��o de PessoaJuridica
 * @package modelo
 * @author Jos� Berardo
 * @since 1.0
 */
 /**
  * Pessoas Jur�dicas da Loja
  * 
  * @package modelo
  * @access public
  */
class PessoaJuridica extends Pessoa {
  // atributos de inst�ncia de Pessoa Jur�dica
  /**
   * N�mero do CNPJ
   * @access private
   * @var string
   */
  private $cnpj;
  /**
   * N�mero da inscri��o estadual
   * @access private
   * @var string
   */
  private $inscricaoEstadual;
  /**
   * N�mero da inscri��o municipal
   * @access private
   * @var string
   */
  private $inscricaoMunicipal;
  /**
   * Pessoa F�sica para contato
   * @access private
   * @var PessoaFisica $contato
   */
  private $contato;
  // ------------ ### ------------- //

  // m�todos construtores e destrutores
  /**
   * Construtor da Pessoa Jur�dica
   * 
   * Todos os par�metros s�o opcionais.
   * Far� uma chamada expl�cita ao construtor de Pessoa
   * 
   * @access public
   * @param int $id Identificador da Pessoa
   * @param string $nome Nome da Pessoa
   * @param string $email Email da Pessoa
   * @param string $telefone Telefone da Pessoa
   * @param string $login login da Pessoa
   * @param string $senha senha da Pessoa
   * @param Endereco $endereco Endere�o inicial a adicionar � Pessoa
   * @param string $cnpj N�mero do CNPJ da Pessoa Jur�dica
   * @param string $inscricaoEstadual Inscri��o estadual da Pessoa Jur�dica
   * @param string $inscricaoMunicipal Inscri��o municipal da Pessoa Jur�dica
   * @param PessoaFisica $contato Pessoa F�sica para contato
   */
  public function __construct($id = "", $nome = "", $email = "", 
                              $telefone = "", $login = "", 
                              $senha = "", $endereco = "",
                              $cnpj = "", $inscricaoEstadual = "", 
                              $inscricaoMunicipal = "", $contato = "") {
    parent::__construct($id, $nome, $email, $telefone, $login, $senha, $endereco);

    $this->setCnpj($cnpj);
    $this->setInscricaoEstadual($inscricaoEstadual);
    $this->setInscricaoMunicipal($inscricaoMunicipal);
    $this->setContato($contato);
  }
  // ------------ ### ------------- //
  // demais m�todos de neg�cio
  /**
   * Implementa��o do m�todo abstrato em Pessoa.
   * Validar� os campos b�sicos e o CNPJ
   * 
   * @access public
   * @return boolean Verdadeiro se os campos forem v�lidos
   * @see Pessoa::validarCampos()
   * @see Pessoa::validarCamposBasicos()
   * @todo Implementa��o da valida��o do CNPJ
   */
  public function validarCampos() {
    // conferindo m�todos comuns de Pessoa
    if (!$this->validarCamposBasicos()) return false;

    // conferindo m�todos particulares de PessoaJuridica
    if ($this->validarCnpj()) return true;

    return false;
  }
  /**
   * M�todo utilit�rio privado para valida��o do CNPJ
   *
   * @access private
   * @return boolean Verdadeiro se o CNPJ for v�lido
   * @todo N�o implementado
   */
  public function validarCnpj() {
    // m�todo n�o implementado
	return $this->cnpj != '';
  }
  // ------------ ### ------------- //
  
  // m�todos getters e setters
  /**
   * Recupera o valor de <var>$this->cnpj</var>
   * 
   * @access public
   * @return string
   */
  public function getCnpj() {
	  return $this->cnpj;
  }
  /**
   * Define um valor para <var>$this->cnpj</var>
   * 
   * @access public
   * @param string $cnpj
   */
  public function setCnpj($cnpj) {
    $this->cnpj = $cnpj;
  }
  /**
   * Recupera o valor de <var>$this->inscricaoEstadual</var>
   * 
   * @access public
   * @return string
   */
  public function getInscricaoEstadual() {
	  return $this->inscricaoEstadual;
  }
  /**
   * Define um valor para <var>$this->inscricaoEstadual</var>
   * 
   * @access public
   * @param string $inscricaoEstadual
   */
  public function setInscricaoEstadual($inscricaoEstadual) {
    $this->inscricaoEstadual = $inscricaoEstadual;
  }
  /**
   * Recupera o valor de <var>$this->inscricaoMunicipal</var>
   * 
   * @access public
   * @return string
   */
  public function getInscricaoMunicipal() {
    return $this->inscricaoMunicipal;
  }
  /**
   * Define um valor para <var>$this->inscricaoMunicipal</var>
   * 
   * @access public
   * @param string $inscricaoMunicipal
   */
  public function setInscricaoMunicipal($inscricaoMunicipal) {
	   $this->inscricaoMunicipal = $inscricaoMunicipal;
  }
  /**
   * Recupera o valor de <var>$this->contato</var>
   * 
   * @access public
   * @return PessoaFisica
   */
  public function getContato() {
    return $this->contato;
  }
  /**
   * Define um valor para <var>$this->contato</var>
   * 
   * @access public
   * @param PessoaFisica $contato
   */
    public function setContato(PessoaFisica $contato) {
    $this->contato = $contato;
  }
  // ------------ ### ------------- //
}
?>