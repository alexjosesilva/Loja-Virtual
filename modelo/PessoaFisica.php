<?php
/**
 * Arquivo de declara��o de PessoaFisica
 * @package modelo
 * @author Jos� Berardo
 * @since 1.0
 */
 /**
  * Pessoas F�sicas da Loja
  * 
  * @package modelo
  * @access public
  */
class PessoaFisica extends Pessoa {
  // atributos de inst�ncia de Pessoa F�sica
  /**
   * N�mero do CPF
   * @access private
   * @var string
   */
  private $cpf;
  /**
   * N�mero da identidade
   * @access private
   * @var string
   */
  private $rg;
  /**
   * Timestamp da data de nascimento
   * @access private
   * @var int
   */
  private $dataNascimento;
  // ------------ ### ------------- //

  // m�todos construtores e destrutores
  /**
   * Construtor da Pessoa F�sica
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
   * @param string $cpf N�mero do CPF da Pessoa F�sica
   * @param string $rg N�mero da identidade da Pessoa F�sica
   * @param int $dataNascimento Timestamp da data de nascimento
   */
  public function __construct($id = "", $nome = "", $email = "", 
                              $telefone = "", $login = "", 
                              $senha = "", $endereco = "",
                              $cpf = "", $rg = "", $dataNascimento = "") {
    parent::__construct($id, $nome, $email, $telefone, $login, $senha, $endereco);
    $this->setCpf($cpf);
    $this->setRg($rg);
    $this->setDataNascimento($dataNascimento);
  }
  // ------------ ### ------------- //
  // demais m�todos de neg�cio
  /**
   * Implementa��o do m�todo abstrato em Pessoa.
   * Validar� os campos b�sicos e o CPF
   * 
   * @access public
   * @return boolean Verdadeiro se os campos forem v�lidos
   * @see Pessoa::validarCampos()
   * @see Pessoa::validarCamposBasicos()
   * @see PessoaFisica::validarCpf()
   */
  public function validarCampos() {
    // conferindo m�todos comuns de Pessoa
    if (!$this->validarCamposBasicos()) return false;

    // conferindo m�todos particulares de PessoaFisica
    if ($this->validarCpf()) return true;

    return false;
  }

  /**
   * M�todo utilit�rio privado para valida��o do CPF
   *
   * @access private
   * @return boolean Verdadeiro se o CPF for v�lido
   */
  private function validarCpf() {
    // recuperando o CPF sem d�gitos e hifen
    $cpf = str_replace(array(".", "-"), "", $this->getCpf());
    if (strlen($cpf) < 11) return false;

    // invalidando CPFs como 11111111111
    for ($x = 0; $x <= 9; $x++) {
      if ($cpf == str_repeat($x,11)) return false;
    }

    // recuperando o d�gito verificador
    $dvInformado = substr($cpf, 9);

    // verificando os valores para o primeiro d�gito verificador
    $valor = 10;
    $soma = 0;
    for ($x = 0; $x < 9; $x++) {
      $soma += $cpf{$x} * $valor--;
    }
    $dv1 = $soma % 11;
    $dv1 = ($dv1 < 2) ? 0 : 11 - $dv1;

    // verificando os valores para o segundo d�gito verificador
    $valor = 11;
    $soma = 0;
    for ($x = 0; $x < 10; $x++) {
      $soma += $cpf{$x} * $valor--;
    }

    $dv2 = $soma % 11;
    $dv2 = ($dv2 < 2) ? 0 : 11 - $dv2;
    if ($dvInformado{1} != $dv2) return false;

    // conferindo o d�gito verificador final
    $dvFinal = $dv1 * 10 + $dv2;
    if ($dvFinal != $dvInformado) return false;

    return true;
  }
  // ------------ ### ------------- //
  
  // m�todos getters e setters
  /**
   * Recupera o valor de <var>$this->cpf</var>
   * 
   * @access public
   * @return string
   */
  public function getCpf() {
	  return $this->cpf;
  }
  /**
   * Define um valor para <var>$this->cpf</var>
   * 
   * @access public
   * @param string $cpf
   */
  public function setCpf($cpf) {
    $this->cpf = $cpf;
  }
  /**
   * Recupera o valor de <var>$this->rg</var>
   * 
   * @access public
   * @return string
   */
  public function getRg() {
	  return $this->rg;
  }
  /**
   * Define um valor para <var>$this->rg</var>
   * 
   * @access public
   * @param string $rg
   */
  public function setRg($rg) {
    $this->rg = $rg;
  }
  /**
   * Recupera o valor de <var>$this->dataNascimento</var>
   * 
   * @access public
   * @return int
   */
  public function getDataNascimento() {
    return $this->dataNascimento;
  }
  /**
   * Define um valor para <var>$this->dataNascimento</var>
   * 
   * @access public
   * @param int $dataNascimento
   */
  public function setDataNascimento($dataNascimento) {
	   $this->dataNascimento = $dataNascimento;
  }
  // ------------ ### ------------- //
}
?>
