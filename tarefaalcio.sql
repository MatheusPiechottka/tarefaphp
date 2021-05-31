-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31-Maio-2021 às 18:28
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tarefaalcio`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm`
--

CREATE TABLE `adm` (
  `Idadm` int(11) NOT NULL,
  `adm_user` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `adm`
--

INSERT INTO `adm` (`Idadm`, `adm_user`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra`
--

CREATE TABLE `compra` (
  `IdCompra` int(11) NOT NULL,
  `dataCompra` datetime DEFAULT current_timestamp(),
  `valorCompraTotal` float DEFAULT NULL,
  `fk_IdUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `compra`
--

INSERT INTO `compra` (`IdCompra`, `dataCompra`, `valorCompraTotal`, `fk_IdUser`) VALUES
(1, '2021-05-31 13:27:12', 216.5, 2),
(2, '2021-05-31 13:27:37', 3.9, 2),
(3, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra_produto`
--

CREATE TABLE `compra_produto` (
  `fkCompra` int(11) NOT NULL,
  `fkProduto` int(11) NOT NULL,
  `qtd_produto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `compra_produto`
--

INSERT INTO `compra_produto` (`fkCompra`, `fkProduto`, `qtd_produto`) VALUES
(2, 1, 1),
(3, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `log`
--

CREATE TABLE `log` (
  `logID` int(11) NOT NULL,
  `fk_logtipo` int(11) NOT NULL,
  `tempolog` datetime DEFAULT NULL,
  `fk_Idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `log`
--

INSERT INTO `log` (`logID`, `fk_logtipo`, `tempolog`, `fk_Idusuario`) VALUES
(1, 1, '2021-05-31 13:24:24', 2),
(2, 3, '2021-05-31 13:27:12', 2),
(3, 4, '2021-05-31 13:27:34', 2),
(4, 3, '2021-05-31 13:27:37', 2),
(5, 4, '2021-05-31 13:27:57', 2),
(6, 2, '2021-05-31 13:28:00', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `logtipo`
--

CREATE TABLE `logtipo` (
  `logtipoID` int(11) NOT NULL,
  `logtipotexto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `logtipo`
--

INSERT INTO `logtipo` (`logtipoID`, `logtipotexto`) VALUES
(1, 'Logou Em'),
(2, 'Saiu Em'),
(3, 'Comprou Em'),
(4, 'Adcionou Item Ao Carrinho Em'),
(5, 'Retirou Item Do Carrinho Em'),
(6, 'Alterou Quantidade De Um Produto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `IdProduto` int(11) NOT NULL,
  `nomeProduto` varchar(50) NOT NULL,
  `preco` float NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`IdProduto`, `nomeProduto`, `preco`, `img`) VALUES
(1, 'Biscoito', 3.9, 'imagens/biscoito.png'),
(2, 'Pão', 9.5, 'imagens/cacete_bonito.jpg'),
(3, 'Contra filé ', 39.5, 'imagens/Filecontraatacante.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `Iduser` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Senha` varchar(100) NOT NULL,
  `Email` varchar(80) NOT NULL,
  `fk_adm_Idadm` int(11) NOT NULL,
  `Img` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`Iduser`, `Nome`, `Username`, `Senha`, `Email`, `fk_adm_Idadm`, `Img`) VALUES
(2, 'Matheus', 'Mathe', '1234', 'math@mail.com', 1, 'imagens/Kanako.png');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `adm`
--
ALTER TABLE `adm`
  ADD PRIMARY KEY (`Idadm`);

--
-- Índices para tabela `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`IdCompra`),
  ADD KEY `fk_IdUser` (`fk_IdUser`);

--
-- Índices para tabela `compra_produto`
--
ALTER TABLE `compra_produto`
  ADD PRIMARY KEY (`fkCompra`,`fkProduto`),
  ADD KEY `fkProduto` (`fkProduto`);

--
-- Índices para tabela `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`logID`),
  ADD KEY `fk_logtipo` (`fk_logtipo`);

--
-- Índices para tabela `logtipo`
--
ALTER TABLE `logtipo`
  ADD PRIMARY KEY (`logtipoID`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`IdProduto`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Iduser`),
  ADD KEY `fk_adm_Idadm` (`fk_adm_Idadm`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adm`
--
ALTER TABLE `adm`
  MODIFY `Idadm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `compra`
--
ALTER TABLE `compra`
  MODIFY `IdCompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `log`
--
ALTER TABLE `log`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `logtipo`
--
ALTER TABLE `logtipo`
  MODIFY `logtipoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `IdProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `Iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`fk_IdUser`) REFERENCES `users` (`Iduser`);

--
-- Limitadores para a tabela `compra_produto`
--
ALTER TABLE `compra_produto`
  ADD CONSTRAINT `compra_produto_ibfk_1` FOREIGN KEY (`fkCompra`) REFERENCES `compra` (`IdCompra`),
  ADD CONSTRAINT `compra_produto_ibfk_2` FOREIGN KEY (`fkProduto`) REFERENCES `produto` (`IdProduto`);

--
-- Limitadores para a tabela `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`fk_logtipo`) REFERENCES `logtipo` (`logtipoID`);

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fk_adm_Idadm`) REFERENCES `adm` (`Idadm`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
